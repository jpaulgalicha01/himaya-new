<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "himaya");

class db{
	private $DB_HOST = DB_HOST;
	private $DB_USER = DB_USER;
	private $DB_PASS = DB_PASS;
	private $DB_NAME = DB_NAME;

	public function connect(){
		try{
			$getconn = "mysql:host=".$this->DB_HOST."; dbname=".$this->DB_NAME;
			$conn = new PDO($getconn,$this->DB_USER,$this->DB_PASS);
			$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
			if($conn){
				return $conn;
			}else{
				$conn = "";
				return $conn;
			}
			
		}catch(PDOException $error){
			die("ERROR MESSAGE:".$error->getMessage());
		}
	}
}
?>