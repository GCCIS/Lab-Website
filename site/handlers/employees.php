<?php
require_once('DBcore.class.php');

        function getLAProfiles(){
                $DBcore = new DBcore();
                $laArr = array();
                $laArr = $DBcore->selectAllLAProfiles();
                $laStr = '';
                foreach($laArr as $row){
			$uid = $row['uid'];
                        $EID = $row['EID'];
                        $firstName = $row['firstName'];
                        $lastName = $row['lastName'];
                        $phoneNumber = $row['phoneNumber'];
                        $email = $row['email'];
                        $major = $row['major'];
                        $biography = $row['biography'];
			$employeeType = $row['employeeType'];
			$laStr .= '<p>Name: '.$firstName.' '.$lastName.'</br>';
                        $laStr .= 'Email: '.$email.'</br></p>';
                }//end of foreach
                return $laStr;
        }

	function getTAprofiles(){
		$DBcore = new DBcore();
		$taArr = new array();
		$taArr = $DBcore->selectAllTAProfiles();
		$taStr = '';
		foreach($taArr as $row){
			$uid = $row['uid'];
                        $EID = $row['EID'];
                        $firstName = $row['firstName'];
                        $lastName = $row['lastName'];
                        $phoneNumber = $row['phoneNumber'];
                        $email = $row['email'];
                        $major = $row['major'];
                        $biography = $row['biography'];
                        $employeeType = $row['employeeType'];
			$courseNumber = $row['courseNumber'];
                        
			$taStr .= '<p>Name: '.$firstName.' '.$lastName.'</br>';
                        $taStr .= 'Email: '.$email.'</br>';
			$taStr .= 'Signoffs: '.$courseNumber.'</p>';


		}
		return $taStr;
	}


?>
