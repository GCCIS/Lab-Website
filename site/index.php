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

<?php
	//echo getOnShiftLAs();

    echo getRooms();

//write page footer
writeHTMLFooter();

?>
