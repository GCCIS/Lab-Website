<?php
 require_once('DBcoreAdmin.class.php');

	function getCourses(){
		$DBcoreAdmin = new DBcoreAdmin();
		$courseArr = array();
		$courseArr = $DBcoreAdmin->selectAllCourses();
		$options = '';
		foreach($courseArr as $row){
			$courseName = $row['courseName'];
			$courseNumber = $row['courseNumber'];
			//create the html options for each course
			$options .= '<option value="'.$courseNumber.'">'.$courseNumber.'</option>';
		}//end of foreach
		return $options;
	}

	function addCourse($courseName, $courseNumber){
		$DBcoreAdmin = new DBcoreAdmin();
		$result = $DBcoreAdmin->addTheCourse($courseName, $courseNumber);
		if($result == 1){
			//if the result is 1 than the record was added
			return true;
		}
		else{
			//the record was not added
			return false;
		}
	}


	function editCourse($prevNumber, $courseName, $courseNumber){
		$DBcoreAdmin = new DBcoreAdmin();
		$result = $DBcoreAdmin->editTheCourse($prevNumber, $courseName, $courseNumber);
		 if($result == 1){
                        //if the result is 1 than the record was edited
                        return true;
                }
                else{
                        //the record was not edited
                        return false;
                }

	}

	function editCourseForm($courseNumber){
		$DBcoreAdmin = new DBcoreAdmin();
		$courseName = $DBcoreAdmin->selectCourseName($courseNumber);
		//create the edit form 
		echo '
        
                <div class="adminFunctionsForm">
                    <form class="functionsForm" action="course.php" method="post" name="editForm">
                          <input type="hidden" name="prevNumber" value="'.$courseNumber.'">    
                          <label>Course Name</label>
                          <input type="text" name="courseName" class="form-control" value="'.$courseName.'" placeholder="Enter Course Name" required="" autofocus="" />
                          <label>Course Number</label>
                          <input type="text" name="courseNumber" class="form-control" value="'.$courseNumber.'" placeholder="Enter Course Number" required="" autofocus="" />
                          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitEdit" value="Submit Add">Edit Course</button>
                    </form>    
                </div>';
	}

	function deleteCourse($courseNumber){
		$DBcoreAdmin = new DBcoreAdmin();
		$result = $DBcoreAdmin->deleteTheCourse($courseNumber);
		return $result;
	}


?>
