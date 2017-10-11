<?php
require_once('DBcore.class.php');

        function getEmployees($employeeTypeNeed){
                $DBcore = new DBcore();
                $employeeArr = array();
                $employeeArr = $DBcore->selectAllEmployees();
                $employeeStr = '';
                foreach($employeeArr as $row){
			$uid = $row['uid'];
                        $EID = $row['EID'];
                        $firstName = $row['firstName'];
                        $lastName = $row['lastName'];
                        $phoneNumber = $row['phoneNumber'];
                        $email = $row['email'];
                        $major = $row['major'];
                        $biography = $row['biography'];
			$employeeType = $row['employeeType'];
			if($employeeTypeNeed == $employeeType){
                        	$employeeStr .= '<p>Name: '.$firstName.' '.$lastName.'</br>';
                        	$employeeStr .= 'Email: '.$email.'</br></p>';
			}
			
                }//end of foreach
                return $employeeStr;
        }



?>
