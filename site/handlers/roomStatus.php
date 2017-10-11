<?php

require_once('DBcore.class.php');

	function getRooms(){
		$DBcore = new DBcore();
		$roomArr = array();
		$roomArr = $DBcore->selectAllRooms();
		$roomStr = '';
		foreach($roomArr as $row){
			$roomNumber = $row['roomNumber'];
			$roomName = $row['roomName'];
			
			$roomStr .= '<p>Room Number: '.$roomNumber.'</br>';
			$roomStr .= 'Room Name: '.$roomName.'</br></p>';

			
		}//end of foreach
		return $roomStr;
	}
?>
