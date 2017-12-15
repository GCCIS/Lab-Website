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
		$htmlStr = '
                <div class="adminFunctionsForm">
                    <form class="functionsForm" method="post" action="admin.php" name="addAdminForm">
                          <label>Email</label>
                          <input type="email" name="email" class="form-control" placeholder="Enter Email" required="" autofocus="" />
                          <label>First Name</label>
                          <input type="text" class="form-control" name="firstName" placeholder="Enter First Name" required="" autofocus="" />
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="lastName" placeholder="Enter Last Name" required="" autofocus="" />  
                          <label>Password</label>
                          <input type="text" class="form-control" name="password" placeholder="Enter Password" required>
                          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitAdminAdd" value="Add New User">Add New User</button>
                    </form>    
                </div>';
		return $htmlStr;
	}

	function createEditAdminForm($email){
		$htmlStr = '';
		$DBcoreAdmin = new DBcoreAdmin();
		$adminArr = array();
		$adminArr = $DBcoreAdmin->selectOneAdmin($email);
		foreach($adminArr as $row){

			$htmlStr .= '
            
             <div class="adminFunctionsForm">
                    <form class="functionsForm" method="post" action="admin.php" name="editAdminForm">
                          <input type="hidden" name="prevEmail" value="'.$row['email'].'">
                          <label>Email</label>
                          <input type="email" class="form-control" name="email" value="'.$row['email'].'" required="" autofocus="" />
                          <label>First Name</label>
                          <input type="text" class="form-control" name="firstName"  value="'.$row['firstName'].'" required="" autofocus="" />
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="lastName" value="'.$row['lastName'].'" required="" autofocus="" />  
                          <label>Password</label>
                          <input type="text" class="form-control" name="password" required>
                          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitAdminEdit" value="Edit User">Edit User</button>
                    </form>    
                </div>';
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

