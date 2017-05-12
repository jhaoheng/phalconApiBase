<?php  

include_once BASE_PATH ."/apibody/tools/database/mysql_manager.php";

/**
* 使用前請先確定 email / token 在 table 中存在
*/
class Auth
{
    public $table;
    
    function __construct($table)
    {
        $this->table = $table;
    }

    public function verifyEmail($email){

        $parameters = [
            "email" => $email
        ];
        $phql = "select * from ".$this->table." where email=:email";

        $mysql = new Mysql_Manager;
        $r = $mysql->fetchOne($phql, $parameters);

        return $r;
    }

    public function verifyToken($token){

        $parameters = [
            "token" => $token
        ];
        $phql = "select * from ".$this->table." where token=:token";

        $mysql = new Mysql_Manager;
        $r = $mysql->fetchOne($phql, $parameters);

        return $r;
    }

}

?>