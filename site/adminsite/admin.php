<?php
include_once('common/common.php');
include 'adminHandlers/adminHandler.php';
   session_start();
   if(!isset($_SESSION['userLogin'])){
	//NOT logged in
	header("Location:logout.php");
   }   
    writeHTMLHead("Admin");
    writeNav();

	if(isset($_POST['deleteAdmin'])){
		//call delete admin function
		$deleteResult = deleteAdmin($_POST['adminList']);
	}
	if(isset($_POST['submitAdminEdit'])){
		//call edit admin function
		$editResult = editAdmin($_POST['prevEmail'],$_POST['email'], $_POST['firstName'],$_POST['lastName'],$_POST['password']);
	}
	if(isset($_POST['submitAdminAdd'])){
		//call add admin function
		$addResult = addAdmin($_POST['email'], $_POST['firstName'],$_POST['lastName'],$_POST['password']);
	}
?>

    <form action="admin.php" name="adminForm" method="post">
	<select name="adminList">
		<option>Select an Admin</option>
		<!--use php to get the admins (options) -->
		<?php 
			echo getAdminOptions();
		?>
	</select> 
	<input type="submit" name="editAdmin" value="Edit Admin">    
	<input type="submit" name="addAdmin" value="Add New Admin">
	<input type="submit" name="deleteAdmin" value="Delete Admin"> 
    </form>

<?php


	if(isset($_POST['editAdmin'])){
		//show the edit admin form
		echo createEditAdminForm($_POST['adminList']);
	}
	if(isset($_POST['addAdmin'])){	
		//show the add admin form
		echo createAddAdminForm();
	}
	


    writeHTMLFooter();
?>
