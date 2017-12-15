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
				<p>Open Hours (use 24hr time - leave blank if there are no open hours on a day)</p>
				<label>Sunday: </label>
                                Open Time: <input type="text" name="SU_openTime"> Close Time: <input type="text" name="SU_closeTime"><br>
				<label>Monday: </label>
				Open Time: <input type="text" name="M_openTime"> Close Time: <input type="text" name="M_closeTime"><br>
				<label>Tuesday: </label>
                                Open Time: <input type="text" name="TU_openTime"> Close Time: <input type="text" name="TU_closeTime"><br>
				<label>Wednesday: </label>
                                Open Time: <input type="text" name="W_openTime"> Close Time: <input type="text" name="W_closeTime"><br>
                                <label>Thursday: </label>
                                Open Time: <input type="text" name="TH_openTime"> Close Time: <input type="text" name="TH_closeTime"><br>
				<label>Friday: </label>
                                Open Time: <input type="text" name="F_openTime"> Close Time: <input type="text" name="F_closeTime"><br>
                                <label>Saturday: </label>
                                Open Time: <input type="text" name="SA_openTime"> Close Time: <input type="text" name="SA_closeTime"><br>
	
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
			$suArr = $DBcoreAdmin->selectHours($roomNumber, 'SU');
                        $mArr = $DBcoreAdmin->selectHours($roomNumber, 'M');
                        $tuArr = $DBcoreAdmin->selectHours($roomNumber, 'TU');
                        $wArr = $DBcoreAdmin->selectHours($roomNumber, 'W');
                        $thArr = $DBcoreAdmin->selectHours($roomNumber, 'TH');
                        $fArr = $DBcoreAdmin->selectHours($roomNumber, 'F');
                        $saArr = $DBcoreAdmin->selectHours($roomNumber, 'SA');

			$htmlStr .= '<form method="post" action="room.php" name="editRoomForm">
				<input type="hidden" name="prevNumber" value="'.$row['roomNumber'].'">
                                <label>Room Name</label>
                                <input type="text" name="roomName" value="'.$row['roomName'].'" required><br>
                                <label>Room Number</label>
                                <input type="text" name="roomNumber" value="'.$row['roomNumber'].'" required><br>
                                
				<p>Open Hours (use 24hr time - leave blank if there are no open hours on a day)</p>';
			if(count($suArr) > 0){
			   foreach($suArr as $surow){
                         	$htmlStr .= '<label>Sunday: </label>
					Open Time: <input type="text" name="SU_openTime" value="'.$surow['openTime'].'" > 
					Close Time: <input type="text" name="SU_closeTime" value="'.$surow['closeTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Sunday: </label>
                                        Open Time: <input type="text" name="SU_openTime">
                                        Close Time: <input type="text" name="SU_closeTime"><br>';
			}
			if(count($mArr) > 0){
			   foreach($mArr as $mrow){
				$htmlStr .=	'<label>Monday: </label>
                                	Open Time: <input type="text" name="M_openTime" value="'.$mrow['openTime'].'"> 
					Close Time: <input type="text" name="M_closeTime" value="'.$mrow['closeTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .=     '<label>Monday: </label>
                                        Open Time: <input type="text" name="M_openTime">
                                        Close Time: <input type="text" name="M_closeTime"><br>';
			} 
			if(count($tuArr) > 0){   
			   foreach($tuArr as $turow){       
				$htmlStr .= '<label>Tuesday: </label>
                                	Open Time: <input type="text" name="TU_openTime" value="'.$turow['openTime'].'"> 
					Close Time: <input type="text" name="TU_closeTime" value="'.$turow['closeTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Tuesday: </label>
                                        Open Time: <input type="text" name="TU_openTime" value="'.$turow['openTime'].'">
                                        Close Time: <input type="text" name="TU_closeTime" value="'.$turow['closeTime'].'"><br>';
			}
			if(count($wArr) > 0){
			   foreach($wArr as $wrow){        
				$htmlStr .= '<label>Wednesday: </label>
                                	Open Time: <input type="text" name="W_openTime" value="'.$wrow['openTime'].'"> 
 					Close Time: <input type="text" name="W_closeTime" value="'.$wrow['closeTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Wednesday: </label>
                                        Open Time: <input type="text" name="W_openTime">
                                        Close Time: <input type="text" name="W_closeTime"><br>';
			}
			if(count($thArr) > 0){        
			   foreach($thArr as $throw){
				$htmlStr .= '<label>Thursday: </label>
                                	Open Time: <input type="text" name="TH_openTime" value="'.$throw['openTime'].'"> 
					Close Time: <input type="text" name="TH_closeTime" value="'.$throw['closeTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Thursday: </label>
                                        Open Time: <input type="text" name="TH_openTime">
                                        Close Time: <input type="text" name="TH_closeTime"><br>';
			}
			if(count($fArr) > 0){
			   foreach($fArr as $frow){        
				$htmlStr .= '<label>Friday: </label>
                                	Open Time: <input type="text" name="F_openTime" value="'.$frow['openTime'].'"> 
					Close Time: <input type="text" name="F_closeTime" value="'.$frow['closeTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Friday: </label>
                                        Open Time: <input type="text" name="F_openTime">
                                        Close Time: <input type="text" name="F_closeTime"><br>';
			}
			if(count($saArr) > 0 ){        
			   foreach($saArr as $sarow){
				$htmlStr .= '<label>Saturday: </label>
                                	Open Time: <input type="text" name="SA_openTime" value="'.$sarow['openTime'].'"> 
					Close Time: <input type="text" name="SA_closeTime" value="'.$sarow['closeTime'].'"><br>';
			   }
			}
			else{
				$htmlStr .= '<label>Saturday: </label>
                                        Open Time: <input type="text" name="SA_openTime">
                                        Close Time: <input type="text" name="SA_closeTime"><br>';
			}
			$htmlStr .='	<input type="submit" name="submitRoomEdit" value="Edit Room">
                        </form>';
		}
                return $htmlStr;
	}
	
	
	function addRoom($roomName, $roomNumber){
		$DBcoreAdmin = new DBcoreAdmin();
		$addResult = $DBcoreAdmin->addOneRoom($roomName, $roomNumber);
		return $addResult;
	}
	
	function addRoomHours($roomNumber, $dayOfWeek, $openTime, $closeTime){
		$DBcoreAdmin = new DBcoreAdmin();
		if(strlen($openTime) > 0 && strlen($closeTime) > 0){
			$addResult = $DBcoreAdmin->addHours($roomNumber, $dayOfWeek, $openTime, $closeTime);
			return $addResult;
		}
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
	
	function editRoomHours($roomNumber, $dayOfWeek, $openTime, $closeTime){
		$DBcoreAdmin = new DBcoreAdmin();
                $editResult = $DBcoreAdmin->deleteRoomHours($roomNumber, $dayOfWeek);
		if(strlen($openTime) > 0 && strlen($closeTime) > 0){
			$addResult = $DBcoreAdmin->addHours($roomNumber, $dayOfWeek, $openTime, $closeTime);
			return $addResult;
		}
	}

?>

