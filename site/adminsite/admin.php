<?php
include 'common/common.php';
include 'adminHandlers/adminHandler.php';
   session_start();
   if(!isset($_SESSION['userLogin'])){
	//NOT logged in
	header("Location:logout.php");
   }   
    writeHTMLHead("Admin");
    writeNav("activePage", "notActivePage", "notActivePage", "notActivePage");

	if(isset($_POST['deleteAdmin'])){
		//call delete admin function
		$deleteResult = deleteAdmin(sanitize($_POST['adminList']));
	}
	if(isset($_POST['submitAdminEdit'])){
		//call edit admin function
		$editResult = editAdmin(sanitize($_POST['prevEmail']),sanitize($_POST['email']), sanitize($_POST['firstName']),sanitize($_POST['lastName']),sanitize($_POST['password']));
	}
	if(isset($_POST['submitAdminAdd'])){
		//call add admin function
		$addResult = addAdmin(sanitize($_POST['email']), sanitize($_POST['firstName']),sanitize($_POST['lastName']),sanitize($_POST['password']));
	}
?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class=adminFunctions>
                 <form action="admin.php" name="adminForm" method="post">
                    <ul>
                        <select name="adminList" required="">
                            <option>Select an Admin</option>
                            <!--use php to get the admins (options) -->
                            <?php 
                                echo getAdminOptions();
                            ?>
                        </select>
                        <li><button class="btn btn-lg btn-primary btn-block" type="submit" name="editAdmin" value="Edit Admin">Edit Admin</button></li>
                        <li><button class="btn btn-lg btn-primary btn-block" type="submit" name="addAdmin" value="Add New Admin">Add New Admin</button></li>
                        <li><button class="btn btn-lg btn-primary btn-block" type="submit" name="deleteAdmin" value="Delete Admin">Delete Admin</button></li>
                    </ul>
                 </form> 
                </div>
            </div>
        </div>
          <div class="row">
            <div class="col-md-12 text-center">
                  <div id="calendar"></div>
            </div>
        </div>
    </div>   
    

<?php


	if(isset($_POST['editAdmin'])){
		//show the edit admin form
		echo createEditAdminForm(sanitize($_POST['adminList']));
	}
	if(isset($_POST['addAdmin'])){	
		//show the add admin form
		echo createAddAdminForm();
	}
	


    writeHTMLFooter();
?>
