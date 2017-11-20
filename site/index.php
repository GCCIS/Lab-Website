<?php
include 'handlers/roomStatus.php';
include 'handlers/employees.php';
include 'common/common.php';



//write the HTML head - provide page title - also starts the body
writeHTMLHead('Home');

//write nav
writeNav('activePage','notActivePage','notActivePage','notActivePage','notActivePage');

?>

 <div class="container onShift">
        <div class="row">

<?php
     //echo getOnShiftLAs();
            getOnShiftTAs();
?>
        </div>
   </div>  

<<<<<<< HEAD
<?php
	//echo getOnShiftLAs();
?>	
    <div class="container labStatus  text-center">
=======
>>>>>>> 84c2b1dca6c3b9ea50cd7caec88a577c27383dc8
        
<?php
    getRooms();
        
?>

<?php

//write page footer
writeHTMLFooter();

?>
