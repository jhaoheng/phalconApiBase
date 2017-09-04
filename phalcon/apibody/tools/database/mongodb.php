<?php  

require_once BASE_PATH .'/php-composer/vendor/autoload.php';

/**
* 
*/
class MongoDB_Client
{
    public $is_success;
    public $error;

    public $username;
    public $password;
    public $host;
    public $port;
    public $dbname;

    function __construct()
    {
        # code...
        $this->connectDB();
    }

    private function setResponse($is_success, $error=''){
        $this->is_success = $is_success;
        $this->error = $error;
    }

    public function insertOne($collection, $data){

        if (!is_array($data)) {
            $this->setResponse(false, "data error");
            return;
        }

        $client = new MongoDB\Client;
        $collection = $client->selectCollection($this->dbname, $collection);

        try {
            $insertOneResult = $collection->insertOne($data);
        } catch (Exception $e) {
            $this->setResponse(false, "mongo operation fail");
            return;
        }

        $this->setResponse(true);
        return $insertOneResult->getInsertedId();
    }

    public function insertMulti($collection, $datas){

        if (!is_array($datas)) {
            $this->setResponse(false, "data error");
            return;
        }

        $client = new MongoDB\Client;
        $collection = $client->selectCollection($this->dbname, $collection);

        try {
            $insertOneResult = $collection->insertMany($datas);
        } catch (Exception $e) {
            $this->setResponse(false, "mongo operation fail");
            return;
        }

        $this->setResponse(true);
        return $insertOneResult->getInsertedId();
        $db->inventory->insertMany;
    }

    public function fetchAll($collection){
        $client = new MongoDB\Client;
        $collection = $client->selectCollection($this->dbname, $collection);

        $cursor = $collection->find();

        foreach ($cursor as $restaurant) {
           var_dump($restaurant);
        };
    }

    public function fetchOne($collection, $data){

        $client = new MongoDB\Client;
        $collection = $client->selectCollection($this->dbname, $collection);
        $cursor = $collection->find($data);

        foreach ($cursor as $restaurant) {
           var_dump($restaurant);
        };
    }

    public function connectDB(){

        $dbconfig = $this->config()->database->mongodb;
        $this->host = $dbconfig->host;
        $this->port = $dbconfig->port;
        $this->dbname = $dbconfig->dbname;
        $this->username = $dbconfig->username;
        $this->password = $dbconfig->password;
    }

    public function config(){
        $config = include BASE_PATH."/app/config/config.php";
        return $config;
    }

}
?>