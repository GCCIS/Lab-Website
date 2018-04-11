<?php
require_once('DBcore.class.php');

	function getRooms(){
		$DBcore = new DBcore();
		$roomArr = array();
		$roomArr = $DBcore->selectAllRooms();
		echo '<div class="container labStatus  text-center">';
        	$j=0;
		$openTime = "";
		$closeTime = "";
		$currentTime = date("g:i a");
		foreach($roomArr as $row){
			$cssClassText = '';
            		if ($j == 0 || $j % 4 == 0) {
						echo '<div class="row">';
                        }//end of if to check if it is the beginning of a new row
            
			$roomNumber = $row['roomNumber'];
			$roomName = $row['roomName'];
			
                        $roomHours = $DBcore->selectRoomHours($roomNumber);
			$openTime = '';
			$closeTime = '';
			foreach($roomHours as $row2){
				$openTime = date("g:i a", strtotime(substr($row2['openTime'], 0, 5)));
				$closeTime = date("g:i a", strtotime(substr($row2['closeTime'],0,5)));
				$labHourStr = 'Lab Hours: '.$openTime.' - '.$closeTime.'';
				 
			}
			if(strlen($openTime) == 0){
				$labHourStr = "No open Hours";
			}
			$openTimeTest = date("H:i", strtotime($openTime));
			$closeTimeTest = date("H:i", strtotime($closeTime));
			$currentTimeTest = date("H:i", strtotime($currentTime));
			if($openTimeTest == "00:00"){
				$openTimeTest = "24:00";
			}
			elseif($closeTimeTest == "00:00"){
				$closeTimeTest = "24:00";
			}	
			elseif($currentTimeTest == "00:00"){
				$currentTimeTest = "24:00";
			}

			//$eventsCurr = array();
                        //for each room check to see if there any events currently happening
                        $eventsCurr = $DBcore->selectCurrentEvent($roomNumber);
			//print_r($eventsCurr);
			if($eventsCurr == 0){
				//if it is 0 then there is no class in session
				if($labHourStr == "No open Hours"){
					$roomStatus = 'Closed';
					$cssClassText = 'lab-closed';
				}
				else{
					//check to see if the lab is currently open
					if($currentTimeTest > $openTimeTest && $currentTimeTest < $closeTimeTest){
						$roomStatus = 'Open ';
						$cssClassText = 'lab-open';
					}
					elseif($currentTimeTest < $openTimeTest || $currentTimeTest > $closeTimeTest){
						
						$roomStatus = 'Closed ';
						$cssClassText = 'lab-closed';
					}
				}
			}
			else{
				//if it is greater than 0 then and event is in progress
				$roomStatus = 'Class';
				$cssClassText = 'lab-class';
			}
			echo '
                  		<div class="col-sm-6 col-md-3">
							<form id="'.$roomName.'" name="roomStatusForm" action="labSchedule.php" method="post">
								<input type="hidden" name="roomNumber" value="'.$roomNumber.'">
								<div class="col-sm-12 col-md-12">
									<a href="#" class="roomCard" onclick="document.getElementById(\''.$roomName.'\').submit();">
									<div class="lab '.$cssClassText.'">
										<div class="labHeading">
											<h3>'.$roomName.' - '.$roomNumber.'</h3>
											<h4>'.$labHourStr.'</h4>
										</div>
										<div class="labDetails">
											<p class="currentStatus">'.$roomStatus.'</p>
										</div>
									</div>
									</a>
								</div>      
							</form>
						</div>';
					$j++;
					if ($j % 4 == 0) {
						echo '  <!-- End of Row -->
							  </div>';
					}

		}//end of foreach
	}


    function makeRoomButtons($postRoom){
        $DBcore = new DBcore();
		$roomArr = array();
		$roomArr = $DBcore->selectAllRooms();
        $roomStr = "";
        
        foreach($roomArr as $row){
            $roomNumber = $row['roomNumber'];
			$roomName = $row['roomName'];
            if($postRoom ==  $roomNumber){
                $roomStr.= '<li class="activeRoom"><form id="'.$roomName.'" name="roomStatusForm" action="labSchedule.php" method="post"><input type="hidden" name="roomNumber" value="'.$roomNumber.'"><a href="#" onclick="document.getElementById(\''.$roomName.'\').submit();">'.$roomName.'</a></form></li>';
            }
            else{
                $roomStr.= '<li class="notActiveRoom"><form id="'.$roomName.'" name="roomStatusForm" action="labSchedule.php" method="post"><input type="hidden" name="roomNumber" value="'.$roomNumber.'"><a href="#" onclick="document.getElementById(\''.$roomName.'\').submit();">'.$roomName.'</a></form></li>';
            }
        }
        return $roomStr;
     }
    
	
?>
