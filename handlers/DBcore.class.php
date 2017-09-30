<?php
class DBcore{
  //connection object
	private $conn;
		
    //Default constructor
		function __construct(){
      //will be the path to our dbInfo
			require_once("../../../dbInfo.php");
			try{
        $this->conn = PDO('mysql:dbname=$db;host=$host', $user, $password, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }
      catch(PDOException $e){
        //used for developing
        echo'Connection Failed: '.$e->getMessage();
      }
		}//end of default constructor 
  
}//end of class
?>
