<?php
include_once('common/common.php');
  session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Employee");
    writeNav();
?>

    <form action="admin.php" name="employeeForm" method="post">
    
    </form>

<?php

    writeHTMLFooter();
?>
