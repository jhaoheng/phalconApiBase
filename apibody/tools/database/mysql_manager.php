<?php  
/**
* 
*/
use Phalcon\Db\Adapter\Pdo\Mysql;


// INSERT INTO "表格名" ("欄位1", "欄位2", ...) VALUES ("值1", "值2", ...);
// UPDATE "表格" SET "欄位1" = [值1], "欄位2" = [值2] WHERE "條件";
// DELETE FROM "表格名" WHERE "條件";

class Mysql_Manager
{
    public $errLog;
    public $connection;

    function __construct() {
    }

    // insert could use
    public function getInsertId(){
        return $this->connection->lastInsertId();
    }

    // update, insert, delete could use
    public function getAffectedRows(){
        return $this->connection->affectedRows();
    }

    public function fetchOne($phql, $parameters){
        $connection = $this->db_connect();
        $result = $connection->fetchOne(
            $phql,
            \Phalcon\Db::FETCH_ASSOC,
            $parameters
        );
        return $result;
    }

    public function fetchAll($phql, $parameters){
        $connection = $this->db_connect();
        $result = $connection->fetchAll(
            $phql,
            \Phalcon\Db::FETCH_ASSOC,
            $parameters
        );
        return $result;
    }

    public function query($phql, $parameters){
        $connection = $this->db_connect();
        $r = $connection->query($phql, $parameters);
        return $r;
    }

    public function execute($phql, $parameters){
        $connection = $this->db_connect();
        $is_success = $connection->execute($phql, $parameters);
        return $is_success;
    }

    public function dbClose(){
        $this->connection->close();
    }

    private function db_connect(){

        // if (!empty($this->connection)) {
        //     $this->dbClose();
        // }
        $dbconfig = $this->config()->database;
        $connection = new Mysql(
            array(
                "host"      => $dbconfig->host,
                "username"  => $dbconfig->username,
                "password"  => $dbconfig->password,
                "dbname"    => $dbconfig->dbname,
                "port"      => $dbconfig->port
            )
        );
        $connection->connect();
        $this->connection = $connection;
        return $connection;
    }

    public function config(){
        $config = include BASE_PATH."/app/config/config.php";
        return $config;
    }
}
?>