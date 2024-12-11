<?php
class ConnectDB{

    public $connDB;

    private $host = "localhost"; 
    private $username = "root"; 
    private $password = ""; 
    private $dbname = "money_tracking_db"; 

    
    public function getConnectionDB(){
        $this->connDB = null;
        try{
            $this->connDB = new PDO ("mysql:host=$this->host;dbname=$this->dbname",$this->username,$this->password);
            $this->connDB->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->connDB;
    }



        
}
?>

