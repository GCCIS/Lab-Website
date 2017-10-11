<?php
include 'handlers/roomStatus.php';
include 'common/common.php';



//write the HTML head - provide page title - also starts the body
writeHTMLHead('Home');

//write nav
writeNav();

echo getRooms();

//write page footer
writeHTMLFooter();

?>
