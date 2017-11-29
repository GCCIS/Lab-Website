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


	function selectRoomHours($roomNumber){
		$data = array();
		$dowNum = date('w');
		$dayOfWeekArr = array('SU'=>0,'M'=>1,'TU'=>2,'W'=>3,'TH'=>4,'F'=>5,'SA'=>6);
		$dowLetter = array_search($dowNum, $dayOfWeekArr);
		if($stmt = $this->conn->prepare("select rs.openTime, rs.closeTime from ROOM r join ROOM_SCHEDULE rs using(roomNumber) where dayOfWeek=:dow AND r.roomNumber= :roomNumber;")){
			$stmt->bindValue(":dow", $dowLetter);
			$stmt->bindValue(":roomNumber", $roomNumber);
			$stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	}

	/*
	* Select the current event that is hapenning in the room - if no event then return 0 - if event that return 1
	*/
	function selectCurrentEvent($roomNumber){
                date_default_timezone_set("America/New_York");
                $currDate = date("Y-m-d");
                $time = date("H:i:s");
		$result = '';
		$sqlStmt = "select count(*) from EVENT where roomNumber=:roomNumber AND date=:currDate AND endTime > :time AND startTime < :time2;";
		if($stmt = $this->conn->prepare($sqlStmt)){
                        $stmt->bindValue(":roomNumber", $roomNumber);
                        $stmt->bindValue(":currDate", $currDate);
                       	$stmt->bindValue(":time", $time);
			$stmt->bindValue(":time2", $time);
			$stmt->execute();
        	        $result = $stmt->fetchColumn();      
       			
		}
		return $result;
	}


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
		$signoffData = array();
		$TAsqlstmt = "select e.uid, e.EID, e.firstName, e.lastName, e.email, e.major, e.biography, e.employeeType, image  FROM EMPLOYEE e WHERE e.employeeType = 'TA';";
		if($stmt = $this->conn->prepare($TAsqlstmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($data as $row){
                       		$uid = $row['uid'];
				array_push($signoffData, $this->selectTASignoffs($uid));

                	}
		}//end of if
		return array($data, $signoffData);
	
	}//end of TA

	function selectTASignoffs($uid){
		$data = array();
		$courseStr = '';
                $SIGNOFFsqlstmt = "SELECT c.courseNumber FROM COURSE c JOIN TA_SIGNOFF t using(courseNumber) WHERE t.uid='".$uid."';";
               	if($stmt = $this->conn->prepare($SIGNOFFsqlstmt)){
               		$stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $row){
                        	$course = $row['courseNumber'];
                                $courseStr .= $course.", ";
                      	}
                 }
		return rtrim($courseStr, ", ");

	}//end of TA signoffs
	

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
		$sqlStmt = "select e.firstName, e.lastName, e.image, e.major, ess.dayOfWeek, ess.startTime, ess.endTime FROM EMPLOYEE_SHIFT_SCHEDULE ess JOIN EMPLOYEE e using(uid) WHERE e.employeeType='LA';";
		if($stmt = $this->conn->prepare($sqlStmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	}
	
	function selectWorkingTAs(){
		$data = array();
		date_default_timezone_set("America/New_York");
		$currDate = date("Y-m-d");
		$currTime = date("H:i:s");
		//select all events on today where the current time falls within the shift begin and end
		$sqlStmt = "SELECT tsl.TA_EID, tsl.shift_date, tsl.shift_begin, tsl.shift_end, tsl.location, e.firstName, e.lastName, e.image, e.uid FROM TA_SHIFT_LOG tsl JOIN EMPLOYEE e on tsl.TA_EID=e.EID WHERE tsl.shift_date='".$currDate."' AND tsl.shift_begin <= '".$currTime."' AND tsl.shift_end >= '".$currTime."' AND e.employeeType ='TA';";
		if($stmt = $this->conn->prepare($sqlStmt)){
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);


		}
		return $data;
	}
                   


	function addTAshift($TA_EID, $shift_date, $shift_begin, $shift_end, $location){
		$sqlStmt = "INSERT INTO TA_SHIFT_LOG (TA_EID, shift_date, shift_begin, shift_end, location) VALUES (:TA_EID, :shift_date, :shift_begin, :shift_end, :location)";
		if($stmt = $this->conn->prepare($sqlStmt)){
			$stmt->bindValue(":TA_EID", $TA_EID);
			$stmt->bindValue(":shift_date", $shift_date);
                        $stmt->bindValue(":shift_begin", $shift_begin);
                        $stmt->bindValue(":shift_end", $shift_end);
                        $stmt->bindValue(":location", $location);
			$result = $stmt->execute();
		}
		return $result;

	}


}//end of class
?>
