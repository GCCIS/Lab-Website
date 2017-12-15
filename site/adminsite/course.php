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
    writeNav("notActivePage", "activePage", "notActivePage", "notActivePage");


	//if the form has been submitted then update the database
        if(isset($_POST['submitEdit'])){
		//send the edit course to the database
		editCourse($_POST['prevNumber'], $_POST['courseName'], $_POST['courseNumber']);
	}
        else if(isset($_POST['deleteCourse'])){
                //delete the course
                deleteCourse($_POST['courseList']);
        }
	else if(isset($_POST['submitAdd'])){
		//the add course form has been submitted so now update the database	
		addCourse($_POST['courseName'], $_POST['courseNumber']);
	}
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class=adminFunctions>
                 <form action="course.php" method="post" name="courseForm">
                    <ul>
                        <select name="courseList" required="">
                            <option>Select an course</option>
                            <!--use php to get the course (options) -->
                            <?php 
                                echo getCourses();
                            ?>
                        </select>
                        <li><button class="btn btn-lg btn-primary btn-block" type="submit" name="editCourse" value="Edit Course">Edit Course</button></li>
                        <li><button class="btn btn-lg btn-primary btn-block" type="submit" name="addCourse" value="Add Course">Add Course</button></li>
                        <li><button class="btn btn-lg btn-primary btn-block" type="submit" name="deleteCourse" value="Delete Course">Delete Course</button></li>
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

	if(isset($_POST['addCourse'])){
                //add course form
                echo '
                
                 <div class="adminFunctionsForm">
                    <form class="functionsForm" action="course.php" method="post" name="addCourse">
                          <label>Course Name</label>
                          <input type="text" name="courseName" class="form-control" placeholder="Enter Course Name" required="" autofocus="" />
                          <label>Course Number</label>
                          <input type="text" name="courseNumber" class="form-control" placeholder="Enter Course Number" required="" autofocus="" />
                          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitAdd" value="Submit Add">Add New Course</button>
                    </form>    
                </div>';

        }
	if(isset($_POST['editCourse'])){
                //create the edit course form
                editCourseForm($_POST['courseList']);
        }

    writeHTMLFooter();
?>
