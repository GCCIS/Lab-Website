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
		$htmlStr .= '<form method="post" action="employee.php" name="addEmployeeForm" enctype="multipart/form-data">
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
					<input type="submit" name="submitEmployeeEdit" value="Edit Employee">
                        </form>';
		}
                return $htmlStr;
	}
	
	
	function addEmployee($uid, $EID, $firstName, $lastName, $email, $major, $biography, $employeeType, $image){
		$DBcoreAdmin = new DBcoreAdmin();
		$addResult = $DBcoreAdmin->addOneEmployee($uid, $EID, $firstName, $lastName, $email, $major, $biography, $employeeType, $image);
		return $addResult;
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


?>
