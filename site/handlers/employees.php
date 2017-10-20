<?php
require_once('DBcore.class.php');

        function getLAProfiles(){
            echo '
                 <div class="profiles">
                    <div class="container"> ';
            
            //Testing Profile card layout
            echo '
                        <div class="row">
                            <div class="col-xs-12 col-sm-10 col-md-6">
                                <div class="LACard">
                                    <div class="row">
                                        <div class="LAPicture col-xs-4 col-sm-3 col-md-4">
                                            <img src="images/LA1.png">
                                        </div>
                                         <div class="LADetails col-xs-7 col-sm-8 col-md-7">
                                            <p>Jacob Holtman </p>
                                            <p>email@rit.edu</p>
                                            <p><span class="LAMajor">Major</span>IST</p>
                                         </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-xs-12 col-sm-10 col-md-6">
                                <div class="LACard">
                                    <div class="row">
                                        <div class="LAPicture col-xs-4 col-sm-3 col-md-4">
                                            <img src="images/LA1.png">
                                        </div>
                                        <div class="LADetails col-xs-7 col-sm-8 col-md-7">
                                            <p>Chandan Mahapatra</p>
                                            <p>email@rit.edu</p>
                                            <p><span class="LAMajor">Major</span>IST</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>'; 
                        
                $DBcore = new DBcore();
                $laArr = array();
                $laArr = $DBcore->selectAllLAProfiles();
                $laStr = '';
                $i = 0;
                foreach($laArr as $row){
                        if ($i == 0 || $i % 2 == 0) {
                            echo '<div class="row">';
                        }
			            $uid = $row['uid'];
                        $EID = $row['EID'];
                        $firstName = $row['firstName'];
                        $lastName = $row['lastName'];
                        $phoneNumber = $row['phoneNumber'];
                        $email = $row['email'];
                        $major = $row['major'];
                        $biography = $row['biography'];
			            $employeeType = $row['employeeType'];
                        echo '
                                <div class="col-xs-12 col-sm-10 col-md-6">
                                    <div class="LACard">
                                        <div class="row">
                                            <div class="LAPicture col-xs-4 col-sm-3 col-md-4">
                                                <img src="images/LA1.png">
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
                return $laStr;
            
                        
             echo '      
                    </div>
                </div>  
                ';
        }

	function getTAprofiles(){
		$DBcore = new DBcore();
		$taArr = array();
		$taArr = $DBcore->selectAllTAProfiles();
		$taStr = '';
		$i=0;
		foreach($taArr[0] as $row){
			$uid = $row['uid'];
                        $EID = $row['EID'];
                        $firstName = $row['firstName'];
                        $lastName = $row['lastName'];
                        $phoneNumber = $row['phoneNumber'];
                        $email = $row['email'];
                        $major = $row['major'];
                        $biography = $row['biography'];
                        $employeeType = $row['employeeType'];
	         	$employeeType = $row['image'];
			//get courseNumber string
			$courseStr = $taArr[1][$i]; 
               

			$taStr .= '<p>Name: '.$firstName.' '.$lastName.'</br>';
                        $taStr .= 'Email: '.$email.'</br>';
			$taStr .= 'Signoffs: '.$courseStr.'</p>';
		
			$i++;
		}
		return $taStr;
	}


?>
