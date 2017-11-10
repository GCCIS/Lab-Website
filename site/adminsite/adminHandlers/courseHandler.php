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

	function addCourse(){

	}


	function editCourse($courseName, $courseNumber){
		

	}

	function deleteCourse($courseNumber){
		$DBcoreAdmin = newDBcoreAdmin();
		$result = $DBcoreAdmin->deleteCourse($courseNumber);
		return $result;
	}


?>
