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
			
			//$eventsCurr = array();
                        //for each room check to see if there any events currently happening
                        $eventsCurr = $DBcore->selectCurrentEvent($roomNumber);
			//print_r($eventsCurr);
			$roomStr .= '<p>Room Number: '.$roomNumber.'</br>';
			$roomStatus = '';
			if($eventsCurr == 0){
				//if it is 0 then there is no class in session
				$roomStatus = 'Closed/Open';
			}
			else{
				//if it is greater than 0 then and event is in progress
				$roomStatus = 'Class';

			}
			$roomStr .= 'Current Status: '.$roomStatus.'</br>';
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
			
			//for each room check to see if there any events currently happening
			$eventsCurr = $DBcore->selectCurrentEvent($roomNumber);	
			

			$roomButtonStr .= '<div class="roomStatus"><form action="#" method="post" class="roomStatusForm" name="roomStatusForm">';
                        $roomButtonStr .= '<button name="roomStatus" value="'.$roomNumber.'" type="submit" class="roomStatusButton">'.$roomNumber.'</br>'.$roomName.'</button>';
			$roomButtonStr .= '</form></div>';


                }//end of foreach
                return $roomButtonStr;

	}
?>
