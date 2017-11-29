<?php
require_once('DBcore.class.php');

        function getLAProfiles(){
            echo '
                 <div class="profiles">
                    <div class="container"> '; 
                        
                $DBcore = new DBcore();
                $laArr = array();
                $laArr = $DBcore->selectAllLAProfiles();
                $i = 0;
                foreach($laArr as $row){
                        if ($i == 0 || $i % 2 == 0) {
                            echo '<div class="row">';
                        }
			            $uid = $row['uid'];
                        $EID = $row['EID'];
                        $firstName = $row['firstName'];
                        $lastName = $row['lastName'];
                        $email = $row['email'];
                        $major = $row['major'];
                        $biography = $row['biography'];
			$image = $row['image'];
			if(strlen($image)<4){
                                $image = 'default.jpg';
                        }

			$employeeType = $row['employeeType'];
                        echo '
                                <div class="col-xs-12 col-sm-10 col-md-6">
                                    <div class="LACard">
                                        <div class="row">
                                            <div class="LAPicture cols-4 col-sm-3 col-md-4">
                                                <img src="images/employees/'.$image.'">
                                            </div>
                                             <div class="LADetails col-xs-7 col-sm-8 col-md-7">
                                                <p>'.$firstName.' '.$lastName.'</p>
                                                <p>'.$email.'</p>
                                                <p><span class="LAMajor">Major</span>'.$major.'</p>
                                             </div>
                                        </div>
                                    </div>
                                </div>    
                        ';
                        if ($i == 0 || $i % 2 == 0) {
                            echo '
                                <!-- End of Card -->';
                        }
                        else {
                            echo '  <!-- End of Card -->
                                  </div>';
                        }
                        $i++;
                }//end of foreach
                if($i % 2 != 0) {
                            echo '
                                <!-- End of Card -->
                                </div>
                                ';
                }
            
                        
             echo '      
                    </div>
                </div>  
                ';
        }

	function getTAprofiles(){
        
          echo '
                 <div class="profiles">
                    <div class="container"> '; 
        
		$DBcore = new DBcore();
		$taArr = array();
		$taArr = $DBcore->selectAllTAProfiles();
		$j=0;
		foreach($taArr[0] as $row){
            
            if ($j == 0 || $j % 2 == 0) {
                            echo '<div class="row">';
                        }
            
			$uid = $row['uid'];
            $EID = $row['EID'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $email = $row['email'];
            $major = $row['major'];
            $biography = $row['biography'];
            $employeeType = $row['employeeType'];
            $image = $row['image'];
            if(strlen($image)<4){
                    $image = 'default.jpg';
            }
			//get courseNumber string
			$courseStr = $taArr[1][$j]; 
            	$employeeType = $row['employeeType'];
                        echo '
                                <div class="col-xs-12 col-sm-10 col-md-6">
                                    <div class="TACard">
                                        <div class="row">
                                            <div class="TAPicture cols-4 col-sm-3 col-md-4">
                                                <img src="images/employees/'.$image.'">
                                            </div>
                                             <div class="TADetails col-xs-7 col-sm-8 col-md-7">
                                                <p>'.$firstName.' '.$lastName.'</p>
                                                <p>'.$email.'</p>
                                                <p><span class="TAMajor">Signoffs</span>'.$courseStr.'</p>
                                             </div>
                                        </div>
                                    </div>
                                </div>    
                        ';
                        if ($j == 0 || $j % 2 == 0) {
                            echo '
                                <!-- End of Card -->';
                        }
                        else {
                            echo '  <!-- End of Card -->
                                  </div>';
                        }
                        $j++;
                }//end of foreach
                if($j % 2 != 0) {
                            echo '
                                <!-- End of Card -->
                                </div>
                                ';
                }
            
                        
             echo '      
                    </div>
                </div>  
                ';
		}

	function getOnShiftLAs(){
		$DBcore = new DBcore();
                $laShiftArr = array();
                $laShiftArr = $DBcore->selectAllLAShifts();
                $laShiftStr = "";

		//used to assign numbers as dayOfWeek
		//array to get the date of the day of week
        	$dayOfWeekArr = array(0=>'SU',1=>'M',2=>'TU',3=>'W',4=>'TH',5=>'F',6=>'SA');
		date_default_timezone_set('America/New_York');	

		//today's day of week number
		$today = date('w');
		$currentTime = date('H:i:s');
	
		foreach($laShiftArr as $row){
			$name = $row['firstName'].' '.$row['lastName'];
			$image = $row['image'];
			if(strlen($image)<4){
                                $image = 'default.jpg';
                        }
			$dayOfWeek = $row['dayOfWeek'];
			$dayOfWeekNum = array_search($dayOfWeek, $dayOfWeekArr);
			$startTime = substr($row['startTime'], 0, 5);
			$startTime12  = date("g:i a", strtotime($startTime));
			$endTime = substr($row['endTime'], 0, 5);
                        $endTime12  = date("g:i a", strtotime($endTime));
			$major = $row['major'];
			
			//if today is the same day as scheduled then print it out
			if($today == $dayOfWeekNum){
				//if the current time is between the start and the end time then show the la
				if($startTime <= $currentTime && $currentTime <= $endTime){
					//$laShiftStr.= $name." works ".$startTime." - ".$endTime." </br>";
					$laShiftStr .= '<div class="row">
                                                	<div class="col-xs-4 col-sm-4 col-md-3">
                                                        	<img src="images/employees/'.$image.'">
                                                        	<h3>'.$name.'</h3>
                                                	</div>
                                                	<div class="TADetails col-xs-7 col-sm-7 col-md-8">
                                                        	<p>Equipment Cage</p>
								<p>'.$startTime12.' to '.$endTime12.'</p>
								<p><span class="TASignoffs">Major</span>'.$major.'</p>
                                                	</div>
                                        	</div>';
				}
			}
		}
		return $laShiftStr;
	}

	function getOnShiftTAs(){
		$DBcore = new DBcore();
		$taShiftArr = array();
		//will get the TA's that are currently clocked into webpunch
		$taShiftArr = $DBcore->selectWorkingTAs();
		$taStr = '';
		foreach($taShiftArr as $row){
			$eid = $row['TA_EID'];
			$shiftBegin = substr($row['shift_begin'],0,5);
                        $beginTime12  = date("g:i a", strtotime($shiftBegin));
			$shiftEnd = substr($row['shift_end'],0,5);
                        $endTime12  = date("g:i a", strtotime($shiftEnd));
			$location = $row['location'];
			$name = $row['firstName'].' '.$row['lastName'];
			$image = $row['image'];
			if(strlen($image)<4){
                                $image = 'default.jpg';
                        }
			$uid = $row['uid'];
			$courseStr = $DBcore->SelectTASignoffs($uid);
            		$taStr .= '		<div class="row">
                        			<div class="col-xs-4 col-sm-4 col-md-3">
                            				<img src="images/employees/'.$image.'">
                            				<h3>'.$name.'</h3>
                        			</div>
                        			<div class="TADetails col-xs-7 col-sm-7 col-md-8">
                            				<p>'.$location.'</p>
                            				<p>'.$beginTime12.' to '.$endTime12.'</p>
                            				<p><span class="TASignoffs">Signoffs</span>'.$courseStr.'</p>
                        			</div>
                    			</div>';
            
			
		}
		return $taStr;
	}


?>
