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
	
	/*
	* Create the lab buttons on Lab Schedules page
	*/
	function createRoomStatus(){
		$DBcore = new DBcore();
                $roomArr = array();
                $roomArr = $DBcore->selectAllRooms();
                $roomButtonStr = '';
                foreach($roomArr as $row){
                        $roomNumber = $row['roomNumber'];
                        $roomName = $row['roomName'];
			
			$roomButtonStr .= '<div class="roomStatus"><form action="#" method="post" class="roomStatusForm" name="roomStatusForm">';
                        $roomButtonStr .= '<button name="roomStatus" value="'.$roomNumber.'" type="submit" class="roomStatusButton">'.$roomNumber.'</br>'.$roomName.'</button>';
			$roomButtonStr .= '</form></div>';


                }//end of foreach
                return $roomButtonStr;

	}
?>
