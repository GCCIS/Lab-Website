<?php
require_once('../handlers/DBcore.class.php');

	if(isset($_POST)){
		print_r($_POST);
		date_default_timezone_set("America/New_York");
		$TA_EID = $_POST["TA_EID"];
		$shift_date = date('Y-m-d');
		$shift_begin = date('H:i:s');
		$shift_end = $_POST["shift_end"];
		$location = $_POST["location"];

		//ta logged their info so add a record to the database
		$DBcore = new DBcore();
		$result = $DBcore->addTAshift($TA_EID, $shift_date, $shift_begin, $shift_end, $location);
		if($result){
			header('Location: index.php');
		}
		else{
			echo "Something went wrong";
		}
	}
	else{
		//some issue happened how did we get to this page
	}

?>
