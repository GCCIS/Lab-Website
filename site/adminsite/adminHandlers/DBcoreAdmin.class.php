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
	* Get room info
	*/
	function selectAllRoomInfo($roomNumber){
		$data = array();
		if($stmt = $this->conn->prepare("select r.roomNumber, r.roomName, rs.dayOfWeek, rs.openTime, rs.closeTime from ROOM r JOIN ROOM_SCHEDULE rs using(roomNumber) where r.roomNumber=:roomNumber;")){
                        $stmt->bindParam(':roomNumber', $roomNumber);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return $data;
	
	}//end of get room info	

	/*
        * Get all rooms
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

	/*
	* validate login
	*/
	function login($email, $pass){
		$pass = hash('sha256', $pass);
		$data = array();
		if($stmt = $this->conn->prepare("select email, password from ADMINUSER where email=:email and password=:pass;")){
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':pass', $pass);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		if($data){
			return true;
		}
		//not a valid login
		return false;
	}//end of login	

	/*
	* select just 1 course name
	*/
	function selectCourseName($courseNumber){
		if($stmt = $this->conn->prepare("select courseName from COURSE where courseNumber=:courseNumber;")){
			$stmt->bindParam(':courseNumber', $courseNumber);
			$stmt->execute();
			$courseName = $stmt->fetch();
			return $courseName[0];
		}
		
	}//end of selectOneCourse

	

  	/*
        * select just 1 admin
        */
        function selectOneAdmin($email){
		$data = array();
                if($stmt = $this->conn->prepare("select email, firstName, lastName, password from ADMINUSER where email=:email;")){
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        return $data;
                }

        }//end of selectOneAdmin



	
        /*
        * select just 1 room
        */
        function selectOneRoom($roomNumber){
                $data = array();
                if($stmt = $this->conn->prepare("select roomNumber, roomName from ROOM where roomNumber=:roomNumber;")){
                        $stmt->bindParam(':roomNumber', $roomNumber);
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        return $data;
                }

        }//end of selectOneRoom

	/*
	* Select the open and close times for a lab on a day of week
	*/
	function selectHours($roomNumber, $dayOfWeek){
		$data = array();
		if($stmt = $this->conn->prepare("select openTime, closeTime from ROOM_SCHEDULE where roomNumber=:roomNumber and dayOfWeek=:dayOfWeek;")){
			$stmt->bindParam(':roomNumber', $roomNumber);
			$stmt->bindParam(':dayOfWeek', $dayOfWeek);
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $data;
	
		}
	}



	/*
        * select just 1 employee
        */
        function selectOneEmployee($uid){
                $data = array();
                if($stmt = $this->conn->prepare("select uid, EID, firstName, lastName, email, major, biography, employeeType, image from EMPLOYEE where uid=:uid;")){
                        $stmt->bindParam(':uid', $uid);
                        $stmt->execute();
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        return $data;
                }

        }//end of selectOneRoom





	//DELETE FUNCTIONALITY
	
	function deleteTheCourse($courseNumber){
		$sql = "delete from COURSE where courseNumber=:courseNumber;";
		if($stmt = $this->conn->prepare($sql)){
			$stmt->bindParam(':courseNumber', $courseNumber);
			$result = $stmt->execute();
		}
		return $result;
	}
	
	function deleteOneAdmin($email){
		$sql = "delete from ADMINUSER where email=:email;";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':email', $email);
                        $result = $stmt->execute();
                }
                return $result;
	}
	
	function deleteOneRoom($roomNumber){
		$hourSQL = "delete from ROOM_SCHEDULE where roomNumber=:roomNumber";
		if($stmt = $this->conn->prepare($hourSQL)){
			$stmt->bindParam(':roomNumber', $roomNumber);
			$resultHr = $stmt->execute();
		}
		$sql = "delete from ROOM where roomNumber=:roomNumber;";
		if($stmta = $this->conn->prepare($sql)){
                        $stmta->bindParam(':roomNumber', $roomNumber);
                        $result = $stmta->execute();
                }
                return $result;

	}

	function deleteOneEmployee($uid){
                $sql = "delete from EMPLOYEE where uid=:uid;";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':uid', $uid);
                        $result = $stmt->execute();
                }
                return $result;

        }
	
	function deleteRoomHours($roomNumber, $dayOfWeek){
		$sql = "delete from ROOM_SCHEDULE where roomNumber=:roomNumber and dayOfWeek=:dayOfWeek";
		if($stmt = $this->conn->prepare($sql)){
			$stmt->bindParam(':roomNumber', $roomNumber);
			$stmt->bindParam('dayOfWeek', $dayOfWeek);
			$result = $stmt->execute();
		}
		return $result;
	}


	//INSERT FUNCTIONALITY
	function addTheCourse($courseName, $courseNumber){
		$sql = "insert into COURSE (courseName, courseNumber) VALUES (:courseName, :courseNumber);";
		if($stmt = $this->conn->prepare($sql)){
			$stmt->bindParam(':courseName', $courseName);
			$stmt->bindParam(':courseNumber',$courseNumber);
			$result = $stmt->execute();
		}
		return $result;
	}
	
	function addOneAdmin($email, $firstName, $lastName, $password){
		$pass = hash('sha256', $password);
		$sql = "insert into ADMINUSER (email, firstName, lastName, accessLevel, password) VALUES (:email, :firstName, :lastName, 1, :password);";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':firstName',$firstName);
                        $stmt->bindParam(':lastName', $lastName);
                        $stmt->bindParam(':password',$pass);
                        $result = $stmt->execute();
                }
                return $result;

	}

	function addOneRoom($roomName, $roomNumber){
                $sql = "insert into ROOM (roomNumber, roomName) VALUES (:roomNumber, :roomName);";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':roomNumber', $roomNumber);
                        $stmt->bindParam(':roomName',$roomName);
                        $result = $stmt->execute();
                }
                return $result;

        }
	
	function addOneEmployee($uid, $EID, $firstName, $lastName, $email, $major, $biography, $employeeType, $image){
                $sql = "insert into EMPLOYEE (uid, EID, firstName, lastName, email, major, biography, employeeType, image) VALUES (:uid, :EID, :firstName, :lastName, :email, :major, :biography, :employeeType, :image);";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':uid', $uid);
                        $stmt->bindParam(':EID',$EID);
                        $stmt->bindParam(':firstName', $firstName);
                        $stmt->bindParam(':lastName', $lastName);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':major', $major);
                        $stmt->bindParam(':biography', $biography);
                        $stmt->bindParam(':employeeType', $employeeType);
                        $stmt->bindParam(':image', $image);
                        $result = $stmt->execute();
                }
                return $result;

        }

	/*
	* Add the hours for one day for one room
	*/
	function addHours($roomNumber, $dayOfWeek, $openTime, $closeTime){
		$sql = "insert into ROOM_SCHEDULE (roomNumber, dayOfWeek, openTime, closeTime) VALUES (:roomNumber, :dayOfWeek, :openTime, :closeTime);";
		if($stmt = $this->conn->prepare($sql)){
			$stmt->bindParam(':roomNumber', $roomNumber);
			$stmt->bindParam(':dayOfWeek', $dayOfWeek);
			$stmt->bindParam(':openTime', $openTime);
			$stmt->bindParam(':closeTime', $closeTime);
			$result = $stmt->execute();
		}
		return $result;
	}


	//UPDATE FUNCTIONALITY
	function editTheCourse($prevNumber, $courseName, $courseNumber){
		$sql = "update COURSE SET courseName=:courseName, courseNumber=:courseNumber where courseNumber=:prevNumber;";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':courseName', $courseName);
                        $stmt->bindParam(':courseNumber',$courseNumber);
			$stmt->bindParam(':prevNumber', $prevNumber);
                        $result = $stmt->execute();
                }
                return $result;

	}

	 function editOneAdmin($prevEmail, $email, $firstName, $lastName, $password){
		$pass = hash('sha256', $password);
                $sql = "update ADMINUSER SET email=:email, firstName=:firstName, lastName=:lastName, password=:password where email=:prevEmail;";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':firstName',$firstName);
                        $stmt->bindParam(':lastName', $lastName);
                        $stmt->bindParam(':password',$pass);
			$stmt->bindParam('prevEmail', $prevEmail);
                        $result = $stmt->execute();
                }
                return $result;

        }
	
	function editOneRoom($prevNumber, $roomName, $roomNumber){
                $sql = "update ROOM SET roomName=:roomName, roomNumber=:roomNumber where roomNumber=:prevNumber;";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':roomName', $roomName);
                        $stmt->bindParam(':roomNumber',$roomNumber);
                        $stmt->bindParam(':prevNumber', $prevNumber);
                        $result = $stmt->execute();
                }
                return $result;
        }

	function editOneEmployee($prevUID, $uid, $EID, $firstName, $lastName, $email, $major, $biography, $employeeType, $image){
                $sql = "update EMPLOYEE set uid=:uid, EID=:EID, firstName=:firstName, lastName=:lastName, email=:email, major=:major, biography=:biography, employeeType=:employeeType, image=:image where uid=:prevUID;";
                if($stmt = $this->conn->prepare($sql)){
                        $stmt->bindParam(':uid', $uid);
                        $stmt->bindParam(':EID',$EID);
                        $stmt->bindParam(':firstName', $firstName);
                        $stmt->bindParam(':lastName', $lastName);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':major', $major);
                        $stmt->bindParam(':biography', $biography);
                        $stmt->bindParam(':employeeType', $employeeType);
                        $stmt->bindParam(':image', $image);
                        $stmt->bindParam(':prevUID', $prevUID);
                        $result = $stmt->execute();
                }
                return $result;
        }





}//end of class
?>
