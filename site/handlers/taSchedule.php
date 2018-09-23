<?php
require_once('DBcore.class.php');

        $DBcore = new DBcore();
        $taArr = array();
        $taArr = $DBcore->selectTASchedules();

        //returning array
        $events = array();

        //array to get the date of the day of week
        $dayOfWeekArr = array(7=>'SU',1=>'M',2=>'TU',3=>'W',4=>'TH',5=>'F',6=>'SA');
	date_default_timezone_set('America/New_York');	

        foreach($taArr as $row){
                $uid = $row['uid'];
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $startTime = $row['startTime'];
                $endTime = $row['endTime'];
                $dayOfWeek = $row['dayOfWeek'];
                $dayOfWeekNum = array_search($dayOfWeek, $dayOfWeekArr);
                
		$genDate = new DateTime();
		$genDate->setISODate(date('Y'), date('W'), $dayOfWeekNum);
		$date = $genDate->format('Y-m-d');


                $e['eventID'] = $uid;
                $e['title'] = $firstName.' '.$lastName;
                $e['start'] = $date.'T'.$startTime;
                $e['end'] = $date.'T'.$endTime;
                $e['allDay'] = false;

                array_push($events, $e);
        }
        echo json_encode($events);
        exit();
?>

