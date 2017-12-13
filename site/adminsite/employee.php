<?php
include 'common/common.php';
include 'adminHandlers/employeeHandler.php';
  session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Employee");
    writeNav();


	//if the form has been submitted then update the database
        if(isset($_POST['submitEmployeeEdit'])){
	   if($_FILES['image']['size'] > 0){
		print_r($_FILES);
		//check the image
                $target_dir = "../images/employees/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOK = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                        //echo "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                } else {
                        //echo "File is not an image.";
                        $uploadOk = 0;
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                        //echo "Sorry, file already exists.";
                        $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["image"]["size"] > 5000000) {
                        //echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                       // echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                } else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                                //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                        } else {
                                echo "Sorry, there was an error uploading your file.";
                        }
                }
	   
		//send the edit employee to the database
		editEmployee($_POST['prevUID'], $_POST['uid'], $_POST['EID'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['major'], $_POST['biography'], $_POST['employeeType'], $_FILES['image']['name']);
	   }
	//no imaqge was submitted
	   else{
		//send the edit employee to the database
                editEmployee($_POST['prevUID'], $_POST['uid'], $_POST['EID'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['major'], $_POST['biography'], $_POST['employeeType'], $_POST['prevImage']);

	   }
	}
        else if(isset($_POST['deleteEmployee'])){
                //delete the employee
                deleteEmployee($_POST['employeeList']);
        }
	else if(isset($_POST['submitEmployeeAdd'])){
	   if($_FILES['image']['size'] > 0){
		//check the image
		print_r($_FILES);
		$target_dir = "../images/employees/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOK = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["image"]["tmp_name"]);
    		if($check !== false) {
        		//echo "File is an image - " . $check["mime"] . ".";
        		$uploadOk = 1;
    		} else {
        		//echo "File is not an image.";
       	 		$uploadOk = 0;
    		}
		// Check if file already exists
		if (file_exists($target_file)) {
    			//echo "Sorry, file already exists.";
    			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["image"]["size"] > 5000000) {
    			//echo "Sorry, your file is too large.";
    			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
    			//echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		} else {
    			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        			//echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    			} else {
        			echo "Sorry, there was an error uploading your file.";
    			}
		}	
	

		//the add employee form has been submitted so now update the database	
		addEmployee($_POST['uid'], $_POST['EID'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['major'], $_POST['biography'], $_POST['employeeType'], $_FILES["image"]["name"]);
	  }
	    //no imaqge was submitted
           else{
                //send the edit employee to the database
                addEmployee($_POST['uid'], $_POST['EID'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['major'], $_POST['biography'], $_POST['employeeType'], '');

           }

	
	}


?>

    <form action="employee.php" name="employeeForm" method="post">
    	<select name="employeeList">
		<option>Select An Employee<option</>
	<?php
		echo getEmployees();
	?>
	</select>
	<input type="submit" name="editEmployee" value="Edit Employee">
        <input type="submit" name="deleteEmployee" value="Delete Employee">
        <input type="submit" name="addEmployee" value="Add Employee">
    </form><br>

<?php

	if(isset($_POST['addEmployee'])){
		//create the add employee form
		echo createAddEmployeeForm();
	}
	else if(isset($_POST['editEmployee'])){
		//create the edit employee form
		echo createEditEmployeeForm($_POST['employeeList']);	
	}

    writeHTMLFooter();
?>
