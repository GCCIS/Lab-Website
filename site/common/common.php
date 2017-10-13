<?php

//writes the html head - requires the page title
function writeHTMLHead($title){
  echo '<!doctype html>
        <html lang="en">
        <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge>
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
          <title>'.$title.'</title>
          <link rel="stylesheet" href="css/style.css">
          <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
	  <link href='cal/assets/fullcalendar.css' rel='stylesheet' />
	  <script src='cal/lib/jquery.min.js'></script>
	  <script src='cal/assets/fullcalendar.js'></script>  
        </head>
        <body>';
}//end of writeHTMLHead

//basic of a nav -- replace with the bootstrap nav you will be using
function writeNav(){
  echo '
	<nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="labSchedule.php">Lab Schedules</a></li>
            <li><a href="TASchedules.php">TA Schedules</a></li>
            <li><a href="TAProfiles.php">TA Profiles</a></li>
            <li><a href="LAProfiles.php">LA Profiles</a></li>
          </ul>
        </nav>';
}//end of nav

//writes the html footer
function writeHTMLFooter(){
  echo '
	<script src="js/jquery-3.2.1.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        </body>
        </html>';
}//end of writeHTMLFooter
?>
