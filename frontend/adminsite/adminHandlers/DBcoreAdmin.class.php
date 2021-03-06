<?php
class DBcoreAdmin{
	//connection object
	private $conn;
		
	//Default constructor
	function __construct(){
	//will be the path to our dbInfo
		require('/home/ISTLABS/amber.libby/dbinfo.php');
		try{
        		$this->conn = new PDO('mysql:dbname='.$db.';host='.$host.'', $user, $pass, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      		}
      		catch(PDOException $e){
        	//used for developing
        	echo'Connection Failed: '.$e->getMessage();
      		}
	}//end of default constructor 
  
	/*
	* Get all rooms
	*/
	function selectAllRooms(){
		$data = array();
		if($stmt = $this->conn->prepare("select r.roomNumber, r.roomName, rs.dayOfWeek, rs.openTIme, rs.closeTime from ROOM r JOIN ROOM_SCHEDULE rs using(roomNumber);")){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	
	}//end of get rooms	

	/*
	* Get all admins
	*/
	function selectAllAdmins(){
		$data = array();
		if($stmt = $this->conn->prepare("select email, firstName, lastName, accessLevel, password from ADMINUSER;")){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	
	}//end of get admins	

	/*
	* Get all courses
	*/
	function selectAllCourses(){
		$data = array();
		if($stmt = $this->conn->prepare("select courseNumber, courseName from COURSE;")){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	
	}//end of get courses
    
    
	/*
	* Get all Employees
	*/
	function selectAllEmployees(){
		$data = array();
                if($stmt = $this->conn->prepare("select e.uid, e.EID, e.firstName, e.lastName, e.email, e.major, e.biography, e.employeeType, e.image from EMPLOYEE e;")){
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return $data;

	}//end of 

}//end of class
?>
