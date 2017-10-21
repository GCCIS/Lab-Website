<?php

//writes the html head - requires the page title
function writeHTMLHead($title){
    echo '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" href="favicon.ico">

            <title>'.$title.'</title>

            <!-- Bootstrap core CSS -->
            <link href="css/bootstrap.min.css" rel="stylesheet">

            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="css/style.css" rel="stylesheet">
            
            <!-- Custom styles for Full Calendar -->
            <link href="css/fullcalendar.css" rel="stylesheet" />
            
            <!-- Full Calendar, Jquery, moment Javascript file -->
            <script src="js/fullcalendar.js"></script>
	    <script src="js/jquery.min.js"></script>
            <script src="js/moment.min.js"></script>  

            <!-- Just for debugging purposes. Dont actually copy these 2 lines! -->
            <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
            <script src="js/ie-emulation-modes-warning.js"></script>

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
          </head>

          <body>';
}//end of writeHTMLHead

//basic of a nav -- replace with the bootstrap nav you will be using
function writeNav($indexA, $scheduleA, $TASchedulA, $TAProfileA, $LAProfileA){
  echo '
         <!-- Fixed navbar -->
         <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><img src="images/IST.png"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="'.$indexA.'"><a href="index.php">Home</a></li>
                <li class="'.$scheduleA.'"><a href="labSchedule.php">Lab Schedules</a></li>
                <li class="'.$TASchedulA.'"><a href="TASchedules.php">TA Schedules</a></li>
                <li class="'.$TAProfileA.'"><a href="TAProfiles.php">TA Profiles</a></li>
                <li class="'.$LAProfileA.'"><a href="LAProfiles.php">Lab Assistant Profiles</a></li>  
              </ul>
            </div><!--/.nav-collapse -->
          </div>
         </nav>';
}//end of nav


//writes the header
function writeHTMLHeader($title){
  echo '
        <div class="header"> <!-- Main component for a primary message -->
            <div class="container">
                <div class="row"> 
                    <div class="col-md-6">
                        <h1>'.$title.'</h1>
                        <p>1:30 PM</p>
                    </div>
                    <div class="col-md-6">
                        <img src="images/IST_large.png">  
                    </div>
                </div>     
            </div>
         </div>';
}//end of header

//writes the html footer
function writeHTMLFooter(){
  echo '
            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
	    <script src="js/bootstrap.min.js"></script>
            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <script src="js/ie10-viewport-bug-workaround.js"></script>
          </body>
        </html>';
}//end of writeHTMLFooter

?>
