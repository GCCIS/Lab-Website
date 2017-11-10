<?php
include_once('common/common.php');
  session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Course");
    writeNav();

?>

    <form action="admin.php" name="courseForm" method="post">
    
    </form>

<?php

    writeHTMLFooter();
?>
