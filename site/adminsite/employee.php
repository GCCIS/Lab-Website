<?php
include 'common/common.php';
include 'adminHandlers/employeeHandler.php';
  session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Employee");
    writeNav("notActivePage", "notActivePage", "activePage", "notActivePage");


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
		editEmployee(sanitize($_POST['prevUID']), sanitize($_POST['uid']), sanitize($_POST['EID']), sanitize($_POST['firstName']), sanitize($_POST['lastName']), sanitize($_POST['email']), sanitize($_POST['major']), sanitize($_POST['biography']), sanitize($_POST['employeeType']), sanitize($_FILES['image']['name']));
	   	editEmployeeShift(sanitize($_POST['uid']), 'SU', sanitize($_POST['SU_startTime']), sanitize($_POST['SU_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'M', sanitize($_POST['M_startTime']), sanitize($_POST['M_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'TU', sanitize($_POST['TU_startTime']), sanitize($_POST['TU_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'W', sanitize($_POST['W_startTime']), sanitize($_POST['W_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'TH', sanitize($_POST['TH_startTime']), sanitize($_POST['TH_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'F', sanitize($_POST['F_startTime']), sanitize($_POST['F_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'SA', sanitize($_POST['SA_startTime']), sanitize($_POST['SA_endTime']));
		
		deleteTASignoffs(sanitize($_POST['uid']));
		if(isset($_POST['signoffList'])){
			for($i = 0; $i < count($_POST['signoffList']); $i++){
                        	editTASignoff(sanitize($_POST['uid']), sanitize($_POST['signoffList'][$i]));
                	}
		}
	   }
	//no imaqge was submitted
	   else{
		//send the edit employee to the database
                editEmployee(sanitize($_POST['prevUID']), sanitize($_POST['uid']), sanitize($_POST['EID']), sanitize($_POST['firstName']), sanitize($_POST['lastName']), sanitize($_POST['email']), sanitize($_POST['major']), sanitize($_POST['biography']), sanitize($_POST['employeeType']), sanitize($_POST['prevImage']));
		editEmployeeShift(sanitize($_POST['uid']), 'SU', sanitize($_POST['SU_startTime']), sanitize($_POST['SU_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'M', sanitize($_POST['M_startTime']), sanitize($_POST['M_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'TU', sanitize($_POST['TU_startTime']), sanitize($_POST['TU_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'W', sanitize($_POST['W_startTime']), sanitize($_POST['W_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'TH', sanitize($_POST['TH_startTime']), sanitize($_POST['TH_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'F', sanitize($_POST['F_startTime']), sanitize($_POST['F_endTime']));
                editEmployeeShift(sanitize($_POST['uid']), 'SA', sanitize($_POST['SA_startTime']), sanitize($_POST['SA_endTime']));
		
		deleteTASignoffs(sanitize($_POST['uid']));
		if(isset($_POST['signoffList'])){
			for($i = 0; $i < count($_POST['signoffList']); $i++){
                        	addTASignoff(sanitize($_POST['uid']), sanitize($_POST['signoffList'][$i]));
                	}
		}
	   }
	}
        else if(isset($_POST['deleteEmployee'])){
                //delete the employee
                deleteEmployee(sanitize($_POST['employeeList']));
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
		addEmployee(sanitize($_POST['uid']), sanitize($_POST['EID']), sanitize($_POST['firstName']), sanitize($_POST['lastName']), sanitize($_POST['email']), sanitize($_POST['major']), sanitize($_POST['biography']), sanitize($_POST['employeeType']), sanitize($_FILES["image"]["name"]));
		addEmployeeShift(sanitize($_POST['uid']), 'SU', sanitize($_POST['SU_startTime']), sanitize($_POST['SU_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'M', sanitize($_POST['M_startTime']), sanitize($_POST['M_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'TU', sanitize($_POST['TU_startTime']), sanitize($_POST['TU_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'W', sanitize($_POST['W_startTime']), sanitize($_POST['W_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'TH', sanitize($_POST['TH_startTime']), sanitize($_POST['TH_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'F', sanitize($_POST['F_startTime']), sanitize($_POST['F_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'SA', sanitize($_POST['SA_startTime']), sanitize($_POST['SA_endTime']));
  		if(isset($_POST['signoffList'])){
			for($i = 0; $i < count($_POST['signoffList']); $i++){
                        	addTASignoff(sanitize($_POST['uid']), sanitize($_POST['signoffList'][$i]));
                	}
		}
	   }
	    //no image was submitted
           else{
                //send the edit employee to the database
                addEmployee(sanitize($_POST['uid']), sanitize($_POST['EID']), sanitize($_POST['firstName']), sanitize($_POST['lastName']), sanitize($_POST['email']), sanitize($_POST['major']), sanitize($_POST['biography']), sanitize($_POST['employeeType']), '');
		addEmployeeShift(sanitize($_POST['uid']), 'SU', sanitize($_POST['SU_startTime']), sanitize($_POST['SU_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'M', sanitize($_POST['M_startTime']), sanitize($_POST['M_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'TU', sanitize($_POST['TU_startTime']), sanitize($_POST['TU_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'W', sanitize($_POST['W_startTime']), sanitize($_POST['W_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'TH', sanitize($_POST['TH_startTime']), sanitize($_POST['TH_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'F', sanitize($_POST['F_startTime']), sanitize($_POST['F_endTime']));
                addEmployeeShift(sanitize($_POST['uid']), 'SA', sanitize($_POST['SA_startTime']), sanitize($_POST['SA_endTime']));
		if(isset($_POST['signoffList'])){
			for($i = 0; $i < count($_POST['signoffList']); $i++){
				addTASignoff(sanitize($_POST['uid']), sanitize($_POST['signoffList'][$i]));		
 			}
		}
          }

	
	}


?>
<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class=adminFunctions>
    			<form action="employee.php" name="employeeForm" method="post">
    				<ul>
					<select name="employeeList">
						<option>Select An Employee</option>
						<?php
							echo getEmployees();
						?>
					</select>
					<li><button class="btn btn-lg btn-primary btn-block" type="submit" name="editEmployee" value="Edit Employee">Edit Employee</button></li>
					<li><button class="btn btn-lg btn-primary btn-block" type="submit" name="addEmployee" value="Add Employee">Add Employee</button></li>
					<li><button class="btn btn-lg btn-primary btn-block" type="submit" name="deleteEmployee" value="Delete Employee">Delete Employee</button></li>
    				</ul>
			</form>
	 	</div>
            </div>
        </div>
    </div>   

<?php

	if(isset($_POST['addEmployee'])){
		//create the add employee form
		echo createAddEmployeeForm();
	}
	else if(isset($_POST['editEmployee'])){
		//create the edit employee form
		echo createEditEmployeeForm(sanitize($_POST['employeeList']));	
	}

    writeHTMLFooter();
?>
