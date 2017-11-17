<?php
require_once('DBcore.class.php');

	function getRooms(){
		$DBcore = new DBcore();
		$roomArr = array();
		$roomArr = $DBcore->selectAllRooms();
        
        echo '<div class="container labStatus  text-center">';
        $j=0;
		foreach($roomArr as $row){
            
                        
            if ($j == 0 && $j == 5) {
                            echo '
                                  <div class="row">';
                        }
            
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
            
            
             echo '
                  <div class="col-sm-6 col-md-3">
                      <form id="'.$roomName.'" name="roomStatusForm" action="labSchedule.php" method="post">
                          <input type="hidden" name="roomNumber" value="'.$roomNumber.'">
                          <div class="col-sm-12 col-md-12">
                          <a href="labSchedule.php" class="roomCard" onclick="document.getElementById(&#145'.$roomName.'&#146).submit();">

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
                    </div>';
            
            if ($j == 4) {
                            echo '  <!-- End of Lab  -->
                                  </div>';
 
                        }
                        else {
                             echo '
                                <!-- End of Lab -->';
                        }
            $j++;
			
		}//end of foreach
        
        /*
                    if($j % 4 != 0) {
                            echo '
                                <!-- End of Lab  -->
                                </div>
                                ';
                }*/
            
                        
             echo '
                </div>  
                ';
	}
	
?>
