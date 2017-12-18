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

    <title>IST Labs</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/adminStyle.css" rel="stylesheet">

    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

          <body>';
}//end of writeHTMLHead

//basic of a nav -- replace with the bootstrap nav you will be using
function writeNav($admin, $course, $employee, $room){
  echo '    
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img src="../images/IST.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="'.$admin.'"><a href="admin.php">Admins</a></li>
            <li class="'.$course.'"><a href="course.php">Courses</a></li>
            <li class="'.$employee.'"><a href="employee.php">Employees</a></li>
            <li class="'.$room.'"><a href="room.php">Rooms</a></li>
            <li class="logOut"><a href="logout.php">Logout</a></li>  
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	';
}//end of nav



//writes the html footer
function writeHTMLFooter(){
  echo '</body>
        </html>';
}//end of writeHTMLFooter


function sanitize($var){
	$var = trim($var);
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlspecialchars($var);
	return $var;
}


?>
