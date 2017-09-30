<?php

//writes the html head - requires the page title
function writeHTMLHead($title){
  echo '<!doctype html>\r\n
        <html lang="en">\r\n
        <head>\r\n
          <meta charset="utf-8">\r\n
          <title>$title</title>\r\n
          <link rel="stylesheet" href="css/style.css">\r\n
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
  echo '</body>\r\n
        </html>\r\n';
}//end of writeHTMLFooter
?>
