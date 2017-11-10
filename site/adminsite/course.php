<?php
include_once('common/common.php');
include 'adminHandlers/courseHandler.php';
  session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Course");
    writeNav();


?>
	<form action="course.php" method="post" name="courseForm">
		<select name="courseList">
		<?php
			echo getCourses();
		?>
		</select>
		<input type="submit" name="editCourse" value="Edit Course">
                <input type="submit" name="deleteCourse" value="Delete Course">
                <input type="submit" name="addCourse" value="Add Course">

	</form>
	    
	
<?php
	//if the form has been submitted then check what needs to show
	if(isset($_POST['editCourse'])){
		//edit course form
	}
	else if(isset($_POST['deleteCourse'])){
		//delete the course
	}
	else if(isset($_POST['addCourse'])){
		//add course form
	}
	

    writeHTMLFooter();
?>
