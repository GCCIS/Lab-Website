<?php
class DBcore{
	//connection object
	private $conn;
		
	//Default constructor
	function __construct(){
	//will be the path to our dbInfo
		require_once('/home/ISTLABS/amber.libby/dbinfo.php');
		try{
        		$this->conn = new PDO('mysql:dbname='.$db.';host='.$host.'', $user, $pass, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      		}
      		catch(PDOException $e){
        	//used for developing
        	echo'Connection Failed: '.$e->getMessage();
      		}
	}//end of default constructor 
  
	/*
	* Get all rooms - names and numbers
	*/
	function selectAllRooms(){
		$data = Array();
		if($stmt = $this->conn->prepare("select roomNumber, roomName from ROOM;")){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	
	}//end of get rooms	

	/*
	* Get all LAs
	*/
	function selectAllLAProfiles(){
		$data = Array();
                if($stmt = $this->conn->prepare("select uid, EID, firstName, lastName, phoneNumber, email, major, biography, employeeType from EMPLOYEE where employeeType='LA';")){
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return $data;

	}//end of LA

	function selectAllTAProfiles(){
		$data = array();
		$sqlstmt = "select e.uid, e.EID, e.firstName, e.lastName, e.phoneNumber, e.email, e.major, e.biography, e.employeeType, c.courseNumber FROM EMPLOYEE e JOIN TA_SIGNOFF using(uid) JOIN COURSE c using(courseNumber) WHERE employeeType = 'TA' AND signoff='1';";
		if($stmt = $this->conn->prepare($sqlstmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	
	}//end of TA
	

	function selectAllEvents(){
		$data = Array();
                if($stmt = $this->conn->prepare("select eventID, roomNumber, date, startTime, endTime, eventName from EVENT;")){
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return $data;

	}
}//end of class
?>
