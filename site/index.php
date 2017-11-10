<?php
include 'handlers/roomStatus.php';
include 'handlers/employees.php';
include 'common/common.php';



//write the HTML head - provide page title - also starts the body
writeHTMLHead('Home');

//write nav
writeNav('activePage','notActivePage','notActivePage','notActivePage','notActivePage');

echo getRooms();

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

//write page footer
writeHTMLFooter();

?>
