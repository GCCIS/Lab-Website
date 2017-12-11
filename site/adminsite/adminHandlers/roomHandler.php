<?php
	require_once('DBcoreAdmin.class.php');


	function getRooms(){
		$DBcoreAdmin = new DBcoreAdmin();
		$roomArr = array();
		$roomArr = $DBcoreAdmin->selectAllRooms();
		$options = '';
		foreach($roomArr as $row){
			$roomName = $row['roomName'];
			$roomNumber = $row['roomNumber'];
			//create the html options for each course
			$options .= '<option value="'.$roomNumber.'">'.$roomName.'</option>';
		}//end of foreach
		return $options;
	}

	function createAddRoomForm(){
		$htmlStr .= '<form method="post" action="room.php" name="addRoomForm">
				<label>Room Name</label>
				<input type="text" name="roomName" required><br>
				<label>Room Number</label>
                                <input type="text" name="roomNumber" required><br>
				<input type="submit" name="submitRoomAdd" value="Add New Room">
			</form>';
		return $htmlStr;
	}
	
	function createEditRoomForm($roomNumber){
		$htmlStr = '';
		$DBcoreAdmin = new DBcoreAdmin();
		$roomArr = array();
		$roomArr = $DBcoreAdmin->selectOneRoom($roomNumber);
		foreach($roomArr as $row){
			$htmlStr .= '<form method="post" action="room.php" name="editRoomForm">
				<input type="hidden" name="prevNumber" value="'.$row['roomNumber'].'">
                                <label>Room Name</label>
                                <input type="text" name="roomName" value="'.$row['roomName'].'" required><br>
                                <label>Room Number</label>
                                <input type="text" name="roomNumber" value="'.$row['roomNumber'].'" required><br>
                                <input type="submit" name="submitRoomEdit" value="Edit Room">
                        </form>';
		}
                return $htmlStr;
	}
	
	
	function addRoom($roomName, $roomNumber){
		$DBcoreAdmin = new DBcoreAdmin();
		$addResult = $DBcoreAdmin->addOneRoom($roomName, $roomNumber);
		return $addResult;
	}
	
	function deleteRoom($roomNumber){
		$DBcoreAdmin = new DBcoreAdmin();
                $deleteResult = $DBcoreAdmin->deleteOneRoom($roomNumber);
                return $deleteResult;
	}
	
	function editRoom($prevNumber, $roomName, $roomNumber){
		$DBcoreAdmin = new DBcoreAdmin();
                $editResult = $DBcoreAdmin->editOneRoom($prevNumber, $roomName, $roomNumber);
                return $editResult;
	}

?>

