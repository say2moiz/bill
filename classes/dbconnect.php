<?php
class dbconnect{
    private $serverAddress = '127.0.0.1';
    private $username = 'root';
    private $password = '';
    private $dbname = 'billing';
    private  $conn;
    function __construct(){
        $this->connect();
    }
    public function connect(){
        try {
            $this->conn = new PDO("mysql:host=$this->serverAddress;dbname=$this->dbname", $this->username, $this->password, Array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET SESSION group_concat_max_len=3423543543'));
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>