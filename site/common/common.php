<?php

//writes the html head - requires the page title
function writeHTMLHead($title){
  echo '<!doctype html>\r\n
        <html lang="en">\r\n
        <head>\r\n
          <meta charset="utf-8">\r\n
          <meta http-equiv="X-UA-Compatible" content="IE=edge">\r\n
          <meta name="viewport" content="width=device-width, initial-scale=1">\r\n
          <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->\r\n
          <title>$title</title>\r\n
          <link rel="stylesheet" href="css/style.css">\r\n
          <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">\r\n
        </head>\r\n
        <body>\r\n';
}//end of writeHTMLHead

//basic of a nav -- replace with the bootstrap nav you will be using
function writeNav(){
  echo '<nav>\r\n
          <ul>\r\n
            <li><a href="index.php">Home</a></li>\r\n
            <li><a href="labSchedule.php">Lab Schedules</a></li>\r\n
            <li><a href="TASchedules.php">TA Schedules</a></li>\r\n
            <li><a href="TAProfiles.php">TA Profiles</a></li>\r\n
            <li><a href="LAProfiles.php">LA Profiles</a></li>\r\n
          </ul>\r\n
        </nav>\r\n';
}//end of nav

//writes the html footer
function writeHTMLFooter(){
  echo '<script src="js/jquery-3.2.1.min.js"></script>\r\n
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>\r\n
        </body>\r\n
        </html>\r\n';
}//end of writeHTMLFooter
?>
