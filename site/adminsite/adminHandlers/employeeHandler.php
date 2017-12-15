<?php
 require_once('DBcoreAdmin.class.php');


	function getEmployees(){
		$DBcoreAdmin = new DBcoreAdmin();
		$empArr = array();
		$empArr = $DBcoreAdmin->selectAllEmployees();
		$options = '';
		foreach($empArr as $row){
			$firstName = $row['firstName'];
			$lastName = $row['lastName'];
			$uid = $row['uid'];
			//create the html options for each course
			$options .= '<option value="'.$uid.'">'.$firstName.' '.$lastName.'</option>';
		}//end of foreach
		return $options;
	}
	function createAddEmployeeForm(){
		$htmlStr = '<form method="post" action="employee.php" name="addEmployeeForm" enctype="multipart/form-data">
				<label>First Name</label>
				<input type="text" name="firstName" required><br>
				<label>Last Name</label>
				<input type="text" name="lastName" required><br>
				<label>University ID</label>
				<input type="text" name="uid" required><br>
				<label>Badge Number</label>
				<input type="text" name="EID" required><br>
				<label>Email</label>
                		<input type="email" name="email" required><br>
				<label>Major</label>
                		<input type="text" name="major" required><br>
				<label>Biography</label>
               			<input type="text" name="biography"><br>
				<label>Employee Type</label>
					<select name="employeeType"><br>
						<option value="TA">Teaching Assistant</option>
						<option value="LA">Lab Assistant</option>
					</select><br>
				<label>Image</label>
				<input type="file" name="image" id="image"><br>

				<p>Shift Schedule (use 24hr time - leave blank if there are no scheduled hours on a day)</p>
				<label>Sunday: </label>
					Start Time: <input type="text" name="SU_startTime"> End Time: <input type="text" name="SU_endTime"><br>
				<label>Monday: </label>
					Start Time: <input type="text" name="M_startTime"> End Time: <input type="text" name="M_endTime"><br>
				<label>Tuesday: </label>
					Start Time: <input type="text" name="TU_startTime"> End Time: <input type="text" name="TU_endTime"><br>
				<label>Wednesday: </label>
					Start Time: <input type="text" name="W_startTime"> End Time: <input type="text" name="W_endTime"><br>
				<label>Thursday: </label>
					Start Time: <input type="text" name="TH_startTime"> End Time: <input type="text" name="TH_endTime"><br>
				<label>Friday: </label>
					Start Time: <input type="text" name="F_startTime"> End Time: <input type="text" name="F_endTime"><br>
				<label>Saturday: </label>
					Start Time: <input type="text" name="SA_startTime"> End Time: <input type="text" name="SA_endTime"><br>

				<input type="submit" name="submitEmployeeAdd" value="Add New Employee">
			</form>';
		return $htmlStr;
	}
	
	function createEditEmployeeForm($uid){
		$htmlStr = '';
		$DBcoreAdmin = new DBcoreAdmin();
		$empArr = array();
		$empArr = $DBcoreAdmin->selectOneEmployee($uid);
		foreach($empArr as $row){
			$employeeType = $row['employeeType'];
			
			$suArr = $DBcoreAdmin->selectShift($uid, 'SU');
			$mArr = $DBcoreAdmin->selectShift($uid, 'M');
			$tuArr = $DBcoreAdmin->selectShift($uid, 'TU');
			$wArr = $DBcoreAdmin->selectShift($uid, 'W');
			$thArr = $DBcoreAdmin->selectShift($uid, 'TH');
			$fArr = $DBcoreAdmin->selectShift($uid, 'F');
			$saArr = $DBcoreAdmin->selectShift($uid, 'SA');
			
			$htmlStr .= '<form method="post" action="employee.php" name="editEmployeeForm" enctype="multipart/form-data">
					<input type="hidden" name="prevUID" value="'.$row['uid'].'">
					<input type="hidden" name="prevImage" value="'.$row['image'].'">
                                	<label>First Name</label>
					<input type="text" name="firstName" value="'.$row['firstName'].'" required><br>
					<label>Last Name</label>
					<input type="text" name="lastName" value="'.$row['lastName'].'" required><br>
					<label>University ID</label>
					<input type="text" name="uid" value="'.$row['uid'].'" required><br>
					<label>Badge Number</label>
					<input type="text" name="EID" value="'.$row['EID'].'" required><br>
					<label>Email</label>
					<input type="email" name="email" value="'.$row['email'].'" required><br>
					<label>Major</label>
					<input type="text" name="major" value="'.$row['major'].'" required><br>
					<label>Biography</label>
					<input type="text" name="biography" value="'.$row['biography'].'" ><br>
					<label>Employee Type</label>
					<select name="employeeType">';
						if($employeeType == 'TA'){
							$htmlStr .= '<option value="TA" selected>Teaching Assistant</option>
									<option value="LA">Lab Assistant</option>';
						}
						else{
							$htmlStr .= '<option value="TA">Teaching Assistant</option>
									<option value="LA" selected>Lab Assistant</option>';
						}
										
			$htmlStr .='</select><br>
					<label>Image</label>
					<input type="file" name="image" id="image"><br>
					<p>Shift Schedule (use 24hr time - leave blank if there are no scheduled hours on a day)</p>';

			if(count($suArr) > 0){
			   foreach($suArr as $surow){
                         	$htmlStr .= '<label>Sunday: </label>
					Start Time: <input type="text" name="SU_startTime" value="'.$surow['startTime'].'" > 
					End Time: <input type="text" name="SU_endTime" value="'.$surow['endTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Sunday: </label>
                                        Start Time: <input type="text" name="SU_startTime">
                                        End Time: <input type="text" name="SU_endTime"><br>';
			}
			if(count($mArr) > 0){
			   foreach($mArr as $mrow){
				$htmlStr .=	'<label>Monday: </label>
                                	Start Time: <input type="text" name="M_startTime" value="'.$mrow['startTime'].'"> 
					End Time: <input type="text" name="M_endTime" value="'.$mrow['endTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .=     '<label>Monday: </label>
                                        Start Time: <input type="text" name="M_startTime">
                                        End Time: <input type="text" name="M_endTime"><br>';
			} 
			if(count($tuArr) > 0){   
			   foreach($tuArr as $turow){       
				$htmlStr .= '<label>Tuesday: </label>
                                	Start Time: <input type="text" name="TU_startTime" value="'.$turow['startTime'].'"> 
					End Time: <input type="text" name="TU_endTime" value="'.$turow['endTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Tuesday: </label>
                                        Start Time: <input type="text" name="TU_startTime" value="'.$turow['startTime'].'">
                                        End Time: <input type="text" name="TU_endTime" value="'.$turow['endTime'].'"><br>';
			}
			if(count($wArr) > 0){
			   foreach($wArr as $wrow){        
				$htmlStr .= '<label>Wednesday: </label>
                                	Start Time: <input type="text" name="W_startTime" value="'.$wrow['startTime'].'"> 
 					End Time: <input type="text" name="W_endTime" value="'.$wrow['endTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Wednesday: </label>
                                        Start Time: <input type="text" name="W_startTime">
                                        End Time: <input type="text" name="W_endTime"><br>';
			}
			if(count($thArr) > 0){        
			   foreach($thArr as $throw){
				$htmlStr .= '<label>Thursday: </label>
                                	Start Time: <input type="text" name="TH_startTime" value="'.$throw['startTime'].'"> 
					End Time: <input type="text" name="TH_endTime" value="'.$throw['endTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Thursday: </label>
                                        Start Time: <input type="text" name="TH_startTime">
                                        End Time: <input type="text" name="TH_endTime"><br>';
			}
			if(count($fArr) > 0){
			   foreach($fArr as $frow){        
				$htmlStr .= '<label>Friday: </label>
                                	Start Time: <input type="text" name="F_startTime" value="'.$frow['startTime'].'"> 
					End Time: <input type="text" name="F_endTime" value="'.$frow['endTime'].'"><br>';
                           }
			}
			else{
				$htmlStr .= '<label>Friday: </label>
                                        Start Time: <input type="text" name="F_startTime">
                                        End Time: <input type="text" name="F_endTime"><br>';
			}
			if(count($saArr) > 0 ){        
			   foreach($saArr as $sarow){
				$htmlStr .= '<label>Saturday: </label>
                                	Start Time: <input type="text" name="SA_startTime" value="'.$sarow['startTime'].'"> 
					End Time: <input type="text" name="SA_endTime" value="'.$sarow['endTime'].'"><br>';
			   }
			}
			else{
				$htmlStr .= '<label>Saturday: </label>
                                        Start Time: <input type="text" name="SA_startTime">
                                        End Time: <input type="text" name="SA_endTime"><br>';
			}

			

			$htmlStr .= '<input type="submit" name="submitEmployeeEdit" value="Edit Employee">
                        	</form>';
		}
                return $htmlStr;
	}
	
	
	function addEmployee($uid, $EID, $firstName, $lastName, $email, $major, $biography, $employeeType, $image){
		$DBcoreAdmin = new DBcoreAdmin();
		$addResult = $DBcoreAdmin->addOneEmployee($uid, $EID, $firstName, $lastName, $email, $major, $biography, $employeeType, $image);
		return $addResult;
	}
	
	function addEmployeeShift($uid, $dayOfWeek, $startTime, $endTime){
		$DBcoreAdmin = new DBcoreAdmin();
		if(strlen($startTime) > 0 && strlen($endTime) > 0){
			$addResult = $DBcoreAdmin->addShift($uid, $dayOfWeek, $startTime, $endTime);
			return $addResult;
		}
	}
	
	function deleteEmployee($uid){
		$DBcoreAdmin = new DBcoreAdmin();
        	$deleteResult = $DBcoreAdmin->deleteOneEmployee($uid);
        	return $deleteResult;
	}
	
	function editEmployee($prevUID, $uid, $EID, $firstName, $lastName, $email, $major, $biography, $employeeType, $image){
		$DBcoreAdmin = new DBcoreAdmin();
        	$editResult = $DBcoreAdmin->editOneEmployee($prevUID, $uid, $EID, $firstName, $lastName, $email, $major, $biography, $employeeType, $image);
        	return $editResult;
	}

	function editEmployeeShift($uid, $dayOfWeek, $startTime, $endTime){
		$DBcoreAdmin = new DBcoreAdmin();
		$editResult = $DBcoreAdmin->deleteShift($uid, $dayOfWeek);
		if(strlen($startTime) > 0 && strlen($endTime) > 0){
			$addResult = $DBcoreAdmin->addShift($uid, $dayOfWeek, $startTime, $endTime);
			return $addResult;
		}
	
	}

?>
