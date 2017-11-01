<?php
class DBcore{
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
	* Get all rooms - names and numbers
	*/
	function selectAllRooms(){
		$data = array();
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
		$data = array();
                if($stmt = $this->conn->prepare("select uid, EID, firstName, lastName, email, major, biography, employeeType, image  from EMPLOYEE where employeeType='LA';")){
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return $data;

	}//end of LA

	function selectAllTAProfiles(){
		$data = array();
		$TAsqlstmt = "select e.uid, e.EID, e.firstName, e.lastName, e.email, e.major, e.biography, e.employeeType, image  FROM EMPLOYEE e WHERE e.employeeType = 'TA';";
		if($stmt = $this->conn->prepare($TAsqlstmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($data as $row){
                        	$uid = $row['uid'];
				
				$data2 = array();
				$signoffData = array();
				$SIGNOFFsqlstmt = "SELECT c.courseNumber FROM COURSE c JOIN TA_SIGNOFF t using(courseNumber) WHERE t.uid='".$uid."';";
				if($stmt2 = $this->conn->prepare($SIGNOFFsqlstmt)){
					$stmt2->execute();
					$data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
					$courseStr = '';
					foreach($data2 as $row2){
						$course = $row2['courseNumber'];
						$courseStr .= $course.";";
					}
				
					//add the course string to the first array
					array_push($signoffData, $courseStr);
				}

                	}
		}//end of if
		return array($data, $signoffData);
	
	}//end of TA
	

	function selectAllEvents(){
		$data = array();
		$sqlStmt = "select eventID, roomNumber, date, startTime, endTime, eventName from EVENT;";
                if($stmt = $this->conn->prepare($sqlStmt)){
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                return $data;

	}

	function selectTASchedules(){
		$data = array();
		$sqlStmt = "select ess.uid, ess.dayOfWeek, ess.startTime, ess.endTime, e.firstName, e.lastName from EMPLOYEE_SHIFT_SCHEDULE ess join EMPLOYEE e using(uid) WHERE employeeType='TA';";
		if($stmt = $this->conn->prepare($sqlStmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} 
		return $data;
	}	


	function selectEventsForRoom($roomNumber){
		$data = array();
		$sqlStmt = "select eventID, roomNumber, date, startTime, endTime, eventName from EVENT WHERE roomNumber='".$roomNumber."';";
		if($stmt = $this->conn->prepare($sqlStmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;

	}

	function selectAllTAShifts(){
		$data = array();
		$sqlStmt = "select ess.dayOfWeek, ess.startTime, ess.endTime FROM EMPLOYEE_SHIFT_SCHEDULE ess JOIN EMPLOYEE e using(uid) WHERE e.employeeType='TA';";
		if($stmt = $this->conn->prepare($sqlStmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	}

	function selectAllLAShifts(){
		$data = array();
		$sqlStmt = "select e.firstName, e.lastName, e.image, ess.dayOfWeek, ess.startTime, ess.endTime FROM EMPLOYEE_SHIFT_SCHEDULE ess JOIN EMPLOYEE e using(uid) WHERE e.employeeType='LA';";
		if($stmt = $this->conn->prepare($sqlStmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	}


}//end of class
?>
