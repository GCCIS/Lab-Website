<?php
require_once('DBcore.class.php');


        $DBcore = new DBcore();
        $eventArr = array();
        	$eventArr = $DBcore->selectEventsForRoom($_POST['roomNum']);
	
	//returning array
        $events = array();

        foreach($eventArr as $row){
                $eventID = $row['eventID'];
                $roomNumber = $row['roomNumber'];
                $date = $row['date'];
                $startTime = $row['startTime'];
                $endTime = $row['endTime'];
                $eventName = $row['eventName'];

                $e['eventID'] = $eventID;
                $e['title'] = $eventName;
                $e['start'] = $date.'T'.$startTime;
                $e['end'] = $date.'T'.$endTime;
                $e['allDay'] = false;

                array_push($events, $e);
        }
        echo json_encode($events);
        exit();
?>

