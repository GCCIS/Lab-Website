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
		$htmlStr .= '<div class="adminFunctionsForm">
				<form class="functionsForm" method="post" action="room.php" name="addRoomForm">
				<label>Room Name</label>
				<input type="text" name="roomName" class="form-control" placeholder="Enter Room Name" autofocus="" required>
				<label>Room Number</label>
                                <input type="text" name="roomNumber" class="form-control" placeholder="Enter Room Number" required>
				<h3>Open Hours</h3> 
					<p>(use 24hr time - leave blank if there are no open hours on a day)</p>
				<label>Sunday: </label>
                                <input type="text" name="SU_openTime" class="form-control" placeholder="Enter Open Time"><input type="text" name="SU_closeTime" class="form-control" placeholder="Enter Close Time">
				<label>Monday: </label>
				<input type="text" name="M_openTime" class="form-control" placeholder="Enter Open Time"><input type="text" name="M_closeTime" class="form-control" placeholder="Enter Close Time">
				<label>Tuesday: </label>
                                <input type="text" name="TU_openTime" class="form-control" placeholder="Enter Open Time"><input type="text" name="TU_closeTime" class="form-control" placeholder="Enter Close Time">
				<label>Wednesday: </label>
                                <input type="text" name="W_openTime" class="form-control" placeholder="Enter Open Time"><input type="text" name="W_closeTime" class="form-control" placeholder="Enter Close Time">
                                <label>Thursday: </label>
                                <input type="text" name="TH_openTime" class="form-control" placeholder="Enter Open Time"><input type="text" name="TH_closeTime" class="form-control" placeholder="Enter Close Time">
				<label>Friday: </label>
                                <input type="text" name="F_openTime" class="form-control" placeholder="Enter Open Time"><input type="text" name="F_closeTime" class="form-control" placeholder="Enter Close Time">
                                <label>Saturday: </label>
                                <input type="text" name="SA_openTime" class="form-control" placeholder="Enter Open Time"><input type="text" name="SA_closeTime" class="form-control" placeholder="Enter Close Time">
	
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submitRoomAdd" value="Add New Room">Add New Room</button>
			</form></div>';
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

			$htmlStr .= '<div class="adminFunctionsForm"><form class="functionsForm" method="post" action="room.php" name="editRoomForm">
				<input type="hidden" name="prevNumber" value="'.$row['roomNumber'].'">
                                <label>Room Name</label>
                                <input class="form-control" placeholder="Enter Room Name" type="text" name="roomName" value="'.$row['roomName'].'" required><br>
                                <label>Room Number</label>
                                <input class="form-control" placeholder="Enter Room Number" type="text" name="roomNumber" value="'.$row['roomNumber'].'" required><br>
                                
				<h3>Open Hours</h3> <p>(use 24hr time - leave blank if there are no open hours on a day)</p>';
			if(count($suArr) > 0){
			   foreach($suArr as $surow){
                         	$htmlStr .= '<label>Sunday: </label>
					<input type="text" name="SU_openTime" value="'.$surow['openTime'].'" class="form-control" placeholder="Enter Open Time"> 
					<input type="text" name="SU_closeTime" value="'.$surow['closeTime'].'" class="form-control" placeholder="Enter Close Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Sunday: </label>
                                        <input type="text" name="SU_openTime" class="form-control" placeholder="Enter Open Time">
                                        <input type="text" name="SU_closeTime" class="form-control" placeholder="Enter Close Time">';
			}
			if(count($mArr) > 0){
			   foreach($mArr as $mrow){
				$htmlStr .=	'<label>Monday: </label>
                                	<input type="text" name="M_openTime" value="'.$mrow['openTime'].'" class="form-control" placeholder="Enter Open Time"> 
					<input type="text" name="M_closeTime" value="'.$mrow['closeTime'].'" class="form-control" placeholder="Enter Close Time">';
                           }
			}
			else{
				$htmlStr .=     '<label>Monday: </label>
                                        <input type="text" name="M_openTime" class="form-control" placeholder="Enter Open Time">
                                        <input type="text" name="M_closeTime" class="form-control" placeholder="Enter Close Time">';
			} 
			if(count($tuArr) > 0){   
			   foreach($tuArr as $turow){       
				$htmlStr .= '<label>Tuesday: </label>
                                	<input type="text" name="TU_openTime" value="'.$turow['openTime'].'" class="form-control" placeholder="Enter Open Time"> 
					<input type="text" name="TU_closeTime" value="'.$turow['closeTime'].'" class="form-control" placeholder="Enter Close Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Tuesday: </label>
                                        <input type="text" name="TU_openTime"  class="form-control" placeholder="Enter Open Time">
                                        <input type="text" name="TU_closeTime" class="form-control" placeholder="Enter Close Time">';
			}
			if(count($wArr) > 0){
			   foreach($wArr as $wrow){        
				$htmlStr .= '<label>Wednesday: </label>
                                	<input type="text" name="W_openTime" value="'.$wrow['openTime'].'" class="form-control" placeholder="Enter Open Time"> 
 					<input type="text" name="W_closeTime" value="'.$wrow['closeTime'].'" class="form-control" placeholder="Enter Close Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Wednesday: </label>
                                        <input type="text" name="W_openTime" class="form-control" placeholder="Enter Open Time">
                                        <input type="text" name="W_closeTime" class="form-control" placeholder="Enter Close Time">';
			}
			if(count($thArr) > 0){        
			   foreach($thArr as $throw){
				$htmlStr .= '<label>Thursday: </label>
                                	<input type="text" name="TH_openTime" value="'.$throw['openTime'].'" class="form-control" placeholder="Enter Open Time"> 
					<input type="text" name="TH_closeTime" value="'.$throw['closeTime'].'" class="form-control" placeholder="Enter Close Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Thursday: </label>
                                        <input type="text" name="TH_openTime" class="form-control" placeholder="Enter Open Time">
                                        <input type="text" name="TH_closeTime" class="form-control" placeholder="Enter Close Time">';
			}
			if(count($fArr) > 0){
			   foreach($fArr as $frow){        
				$htmlStr .= '<label>Friday: </label>
                                	<input type="text" name="F_openTime" value="'.$frow['openTime'].'" class="form-control" placeholder="Enter Open Time"> 
					<input type="text" name="F_closeTime" value="'.$frow['closeTime'].'" class="form-control" placeholder="Enter Close Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Friday: </label>
                                        <input type="text" name="F_openTime" class="form-control" placeholder="Enter Open Time">
                                        <input type="text" name="F_closeTime" class="form-control" placeholder="Enter Close Time">';
			}
			if(count($saArr) > 0 ){        
			   foreach($saArr as $sarow){
				$htmlStr .= '<label>Saturday: </label>
                                	<input type="text" name="SA_openTime" value="'.$sarow['openTime'].'" class="form-control" placeholder="Enter Open Time"> 
					<input type="text" name="SA_closeTime" value="'.$sarow['closeTime'].'" class="form-control" placeholder="Enter Close Time">';
			   }
			}
			else{
				$htmlStr .= '<label>Saturday: </label>
                                        <input type="text" name="SA_openTime" class="form-control" placeholder="Enter Open Time">
                                        <input type="text" name="SA_closeTime" class="form-control" placeholder="Enter Close Time">';
			}
			$htmlStr .='	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submitRoomEdit" value="Edit Room">Edit Room</button>
                        </form></div>';
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

