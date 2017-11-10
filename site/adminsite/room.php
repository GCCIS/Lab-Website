<?php
include_once('common/common.php');
  session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Room");
    writeNav();
?>

    <form action="admin.php" name="roomForm" method="post">
    
    </form>

<?php

    writeHTMLFooter();
?>
