<?php
require_once('DBcore.class.php');

	function getRooms(){
		$DBcore = new DBcore();
		$roomArr = array();
		$roomArr = $DBcore->selectAllRooms();
		foreach($roomArr as $row){
			$roomNumber = $row['roomNumber'];
			$roomName = $row['roomName'];
			
			//$eventsCurr = array();
                        //for each room check to see if there any events currently happening
                        $eventsCurr = $DBcore->selectCurrentEvent($roomNumber);
			//print_r($eventsCurr);
			if($eventsCurr == 0){
				//if it is 0 then there is no class in session
				$roomStatus = 'Closed/Open';
			}
			else{
				//if it is greater than 0 then and event is in progress
				$roomStatus = 'Class';

			}
            
            
            
             echo ' <div class="row">
                  <div class="col-sm-6 col-md-3">
                      <form id="'.$roomName.'" action="labSchedule.php" method="post">
                          <input type="hidden" name="roomNumber" value="'.$roomNumber.'">
                          <div class="col-sm-12 col-md-12">
                          <a href="labSchedule.php" class="roomCard" onclick="document.getElementById("'.$roomName.'").submit();">

                                    <div class="lab lab-open">
                                            <div class="labHeading">
                                                <h3>'.$roomName.' - '.$roomNumber.'</h3>
                                                <h4>Lab Hours: 8 AM - 12 AM</h4>
                                            </div>
                                            <div class="labDetails">
                                                <p class="currentStatus">'.$roomStatus.'</p>
                                            </div>
                                    </div>
                          </a>
                          </div>      
                      </form>
                    </div>
                </div> ';
			
		}//end of foreach
	}
	
?>