<?php
 require_once('DBcoreAdmin.class.php');

	function getAdminOptions(){
		$DBcoreAdmin = new DBcoreAdmin();
                $adminArr = array();
                $adminArr = $DBcoreAdmin->selectAllAdmins();
                $options = '';
                foreach($adminArr as $row){
                        $firstName = $row['firstName'];
			$lastName = $row['lastName'];	
                        $email = $row['email'];
                        //create the html options for each admin
                        $options .= '<option value="'.$email.'">'.$firstName.' '.$lastName.'</option>';
                }//end of foreach
                return $options;
	
	}
	
	function createAddAdminForm(){
		$htmlStr .= '<form method="post" action="admin.php" name="addAdminForm">
				<label>Email</label>
				<input type="email" name="email" required><br>
				<label>First Name</label>
                                <input type="text" name="firstName" required><br>
				<label>Last Name</label>
                                <input type="text" name="lastName" required><br>
				<label>Password</label>
                                <input type="text" name="password" required><br>
			
				<input type="submit" name="submitAdminAdd" value="Add New User">
			</form>';
		return $htmlStr;
	}

	function createEditAdminForm($email){
		$htmlStr = '';
		$DBcoreAdmin = new DBcoreAdmin();
		$adminArr = array();
		$adminArr = $DBcoreAdmin->selectOneAdmin($email);
		foreach($adminArr as $row){

			$htmlStr .= '<form method="post" action="admin.php" name="editAdminForm">
				<input type="hidden" name="prevEmail" value="'.$row['email'].'">
                                <label>Email</label>
                                <input type="email" name="email" value="'.$row['email'].'" required><br>
                                <label>First Name</label>
                                <input type="text" name="firstName" value="'.$row['firstName'].'" required><br>
                                <label>Last Name</label>
                                <input type="text" name="lastName" value="'.$row['lastName'].'" required><br>
                                <label>Password</label>
                                <input type="text" name="password" required><br>

                                <input type="submit" name="submitAdminEdit" value="Edit User">
                        </form>';
		}
                return $htmlStr;

	}
	
	function addAdmin($email, $firstName, $lastName, $password){
		$DBcoreAdmin = new DBcoreAdmin();
		$addResult = $DBcoreAdmin->addOneAdmin($email, $firstName, $lastName, $password);
		return $addResult;
	}

	function deleteAdmin($email){
		$DBcoreAdmin = new DBcoreAdmin();
                $deleteResult = $DBcoreAdmin->deleteOneAdmin($email);
                return $deleteResult;
	}

	function editAdmin($prevEmail, $email, $firstName, $lastName, $password){
		$DBcoreAdmin = new DBcoreAdmin();
                $editResult = $DBcoreAdmin->editOneAdmin($prevEmail, $email, $firstName, $lastName, $password);
                return $editResult;

	}

?>

