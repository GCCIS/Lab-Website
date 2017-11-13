<?php
include_once('common/common.php');
include 'adminHandlers/courseHandler.php';
  //check if the user is logged in
   session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Course");
    writeNav();


	//if the form has been submitted then update the database
        if(isset($_POST['editCourse'])){
                //create the edit course form
		editCourseForm($_POST['courseList']);
        }
	else if(isset($_POST['submitEdit'])){
		//send the edit course to the database
		editCourse($_POST['prevNumber'], $_POST['courseName'], $_POST['courseNumber']);
	}
        else if(isset($_POST['deleteCourse'])){
                //delete the course
                deleteCourse($_POST['courseList']);
        }
        else if(isset($_POST['addCourse'])){
                //add course form
		echo '<form action="course.php" method="post" name="addCourse">
			Course Name: <input type="text" name="courseName" required><br>
			Course Number: <input type="text" name="courseNumber" required><br> 
			<input type="submit" name="submitAdd" value="submitAdd">
		      </form>';
		
        }
	else if(isset($_POST['submitAdd'])){
		//the add course form has been submitted so now update the database	
		addCourse($_POST['courseName'], $_POST['courseNumber']);
	}
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

    writeHTMLFooter();
?>
