<?php
 require_once('DBcoreAdmin.class.php');
include 'courseHandler.php';


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
		$htmlStr = '<div class="adminFunctionsForm"> <form class="functionsForm" method="post" action="employee.php" name="addEmployeeForm" enctype="multipart/form-data">
				<label>First Name</label>
				<input type="text" name="firstName" class="form-control" placeholder="Enter First Name" required><br>
				<label>Last Name</label>
				<input type="text" name="lastName" class="form-control" placeholder="Enter Last Name" required><br>
				<label>University ID</label>
				<input type="text" name="uid" class="form-control" placeholder="Enter University ID" required><br>
				<label>Badge Number</label>
				<input type="text" name="EID" class="form-control" placeholder="Enter Kronos Badge Number" required><br>
				<label>Email</label>
                		<input type="email" name="email" class="form-control" placeholder="Enter Email" required><br>
				<label>Major</label>
                		<input type="text" name="major" class="form-control" placeholder="Enter Major Abbrv." required><br>
				<label>Biography</label>
               			<input type="text" name="biography" class="form-control" placeholder="Enter Biography"><br>
				<label>Employee Type</label>
					<select name="employeeType">
						<option value="TA">Teaching Assistant</option>
						<option value="LA">Lab Assistant</option>
					</select><br>
				<label>Image</label>
				<input type="file" name="image" id="image" class="form-control"><br>

				<h3>Shift Schedule</h3> <p>(use 24hr time - leave blank if there are no scheduled hours on a day)</p>
				<label>Sunday: </label>
					<input type="text" name="SU_startTime" class="form-control" placeholder="Enter Start Time"><input type="text" name="SU_endTime" class="form-control" placeholder="Enter End Time">
				<label>Monday: </label>
					<input type="text" name="M_startTime" class="form-control" placeholder="Enter Start Time"><input type="text" name="M_endTime" class="form-control" placeholder="Enter End Time">
				<label>Tuesday: </label>
					<input type="text" name="TU_startTime" class="form-control" placeholder="Enter Start Time"><input type="text" name="TU_endTime" class="form-control" placeholder="Enter End Time">
				<label>Wednesday: </label>
					<input type="text" name="W_startTime" class="form-control" placeholder="Enter Start Time"><input type="text" name="W_endTime" class="form-control" placeholder="Enter End Time">
				<label>Thursday: </label>
					<input type="text" name="TH_startTime" class="form-control" placeholder="Enter Start Time"><input type="text" name="TH_endTime" class="form-control" placeholder="Enter End Time">
				<label>Friday: </label>
					<input type="text" name="F_startTime" class="form-control" placeholder="Enter Start Time"><input type="text" name="F_endTime" class="form-control" placeholder="Enter End Time">
				<label>Saturday: </label>
					<input type="text" name="SA_startTime" class="form-control" placeholder="Enter Start Time"><input type="text" name="SA_endTime" class="form-control" placeholder="Enter End Time">

				<label>TA Signoff Course List</label><br><select name="signoffList[]" multiple>';
			$htmlStr .= getCourses();				
						

			$htmlStr .=	'</select><br>

				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submitEmployeeAdd" value="Add New Employee">Add New Employee</button>
			</form></div>';
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
			
			$htmlStr .= '<div class="adminFunctionsForm"><form class="functionsForm" method="post" action="employee.php" name="editEmployeeForm" enctype="multipart/form-data">
					<input type="hidden" name="prevUID" value="'.$row['uid'].'">
					<input type="hidden" name="prevImage" value="'.$row['image'].'">
                                	<label>First Name</label>
					<input type="text" name="firstName" value="'.$row['firstName'].'" class="form-control" placeholder="Enter First Name" required>
					<label>Last Name</label>
					<input type="text" name="lastName" value="'.$row['lastName'].'" class="form-control" placeholder="Enter Last Name" required>
					<label>University ID</label>
					<input type="text" name="uid" value="'.$row['uid'].'" class="form-control" placeholder="Enter University ID" required>
					<label>Badge Number</label>
					<input type="text" name="EID" value="'.$row['EID'].'" class="form-control" placeholder="Enter Kronos Badge Number" required>
					<label>Email</label>
					<input type="email" name="email" value="'.$row['email'].'" class="form-control" placeholder="Enter Email" required>
					<label>Major</label>
					<input type="text" name="major" value="'.$row['major'].'" class="form-control" placeholder="Enter Major Abbrv." required>
					<label>Biography</label>
					<input type="text" name="biography" value="'.$row['biography'].'" class="form-control" placeholder="Enter Biography">
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
					<input type="file" name="image" id="image" class="form-control"><br>
					<h3>Shift Schedule</h3> <p>(use 24hr time - leave blank if there are no scheduled hours on a day)</p>';

			if(count($suArr) > 0){
			   foreach($suArr as $surow){
                         	$htmlStr .= '<label>Sunday: </label>
					<input type="text" name="SU_startTime" value="'.$surow['startTime'].'" class="form-control" placeholder="Enter Start Time"> 
					<input type="text" name="SU_endTime" value="'.$surow['endTime'].'" class="form-control" placeholder="Enter End Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Sunday: </label>
                                        <input type="text" name="SU_startTime" class="form-control" placeholder="Enter Start Time">
                                        <input type="text" name="SU_endTime" class="form-control" placeholder="Enter End Time">';
			}
			if(count($mArr) > 0){
			   foreach($mArr as $mrow){
				$htmlStr .=	'<label>Monday: </label>
                                	<input type="text" name="M_startTime" value="'.$mrow['startTime'].'" class="form-control" placeholder="Enter Start Time"> 
					<input type="text" name="M_endTime" value="'.$mrow['endTime'].'" class="form-control" placeholder="Enter End Time">';
                           }
			}
			else{
				$htmlStr .=     '<label>Monday: </label>
                                        <input type="text" name="M_startTime" class="form-control" placeholder="Enter Start Time">
                                        <input type="text" name="M_endTime" class="form-control" placeholder="Enter End Time">';
			} 
			if(count($tuArr) > 0){   
			   foreach($tuArr as $turow){       
				$htmlStr .= '<label>Tuesday: </label>
                                	<input type="text" name="TU_startTime" value="'.$turow['startTime'].'" class="form-control" placeholder="Enter Start Time"> 
					<input type="text" name="TU_endTime" value="'.$turow['endTime'].'" class="form-control" placeholder="Enter End Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Tuesday: </label>
                                        <input type="text" name="TU_startTime" class="form-control" placeholder="Enter Start Time">
                                        <input type="text" name="TU_endTime" class="form-control" placeholder="Enter End Time">';
			}
			if(count($wArr) > 0){
			   foreach($wArr as $wrow){        
				$htmlStr .= '<label>Wednesday: </label>
                                	<input type="text" name="W_startTime" value="'.$wrow['startTime'].'" class="form-control" placeholder="Enter Start Time"> 
 					<input type="text" name="W_endTime" value="'.$wrow['endTime'].'" class="form-control" placeholder="Enter End Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Wednesday: </label>
                                        <input type="text" name="W_startTime" class="form-control" placeholder="Enter Start Time">
                                        <input type="text" name="W_endTime" class="form-control" placeholder="Enter End Time">';
			}
			if(count($thArr) > 0){        
			   foreach($thArr as $throw){
				$htmlStr .= '<label>Thursday: </label>
                                	<input type="text" name="TH_startTime" value="'.$throw['startTime'].'" class="form-control" placeholder="Enter Start Time"> 
					<input type="text" name="TH_endTime" value="'.$throw['endTime'].'" class="form-control" placeholder="Enter End Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Thursday: </label>
                                        <input type="text" name="TH_startTime" class="form-control" placeholder="Enter Start Time">
                                        <input type="text" name="TH_endTime" class="form-control" placeholder="Enter End Time">';
			}
			if(count($fArr) > 0){
			   foreach($fArr as $frow){        
				$htmlStr .= '<label>Friday: </label>
                                	<input type="text" name="F_startTime" value="'.$frow['startTime'].'" class="form-control" placeholder="Enter Start Time"> 
					<input type="text" name="F_endTime" value="'.$frow['endTime'].'" class="form-control" placeholder="Enter End Time">';
                           }
			}
			else{
				$htmlStr .= '<label>Friday: </label>
                                        <input type="text" name="F_startTime" class="form-control" placeholder="Enter Start Time">
                                        <input type="text" name="F_endTime" class="form-control" placeholder="Enter End Time">';
			}
			if(count($saArr) > 0 ){        
			   foreach($saArr as $sarow){
				$htmlStr .= '<label>Saturday: </label>
                                	<input type="text" name="SA_startTime" value="'.$sarow['startTime'].'" class="form-control" placeholder="Enter Start Time"> 
					<input type="text" name="SA_endTime" value="'.$sarow['endTime'].'" class="form-control" placeholder="Enter End Time">';
			   }
			}
			else{
				$htmlStr .= '<label>Saturday: </label>
                                        <input type="text" name="SA_startTime" class="form-control" placeholder="Enter Start Time">
                                        <input type="text" name="SA_endTime" class="form-control" placeholder="Enter End Time">';
			}

			$htmlStr .= '<label>TA Signoff Course List</label>
					<br><select name="signoffList[]" multiple>';
			$htmlStr .= getCourses();

			$htmlStr .= '</select><br>
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="submitEmployeeEdit" value="Edit Employee">Edit Employee</button>
                        	</form></div>';
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

	function addTASignoff($uid, $courseNumber){
		$DBcoreAdmin = new DBcoreAdmin();
		$addResult = $DBcoreAdmin->addTASignoffs($uid, $courseNumber);
		return $addResult;
	}
	
	function deleteTASignoffs($uid){
		$DBcoreAdmin = new DBcoreAdmin();
		$deleteResult = $DBcoreAdmin->deleteAllTASignoffs($uid);
		return $deleteResult;
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
