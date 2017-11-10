<?php
include_once('common/common.php');
   session_start();
   if(!isset($_SESSION['userLogin'])){
	//NOT logged in
	header("Location:logout.php");
   }   
    writeHTMLHead("Admin");
    writeNav();

?>

    <form action="admin.php" name="adminForm" method="post">
        
    </form>

<?php

    writeHTMLFooter();
?>
