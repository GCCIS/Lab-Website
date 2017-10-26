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
                                    <div class="LACard">
                                        <div class="row">
                                            <div class="LAPicture cols-4 col-sm-3 col-md-4">
                                                <img src="images/employees/'.$image.'">
                                            </div>
                                             <div class="LADetails col-xs-7 col-sm-8 col-md-7">
                                                <p>'.$firstName.' '.$lastName.'</p>
                                                <p>'.$email.'</p>
                                                <p><span class="LAMajor">Signoffs</span>'.$courseStr.'</p>
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



?>
