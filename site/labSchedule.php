<?php
include 'handlers/roomStatus.php';
include_once('common/common.php');

//write the HTML head - provide page title - also starts the body
writeHTMLHead('Lab Schedule');

//write nav
writeNav('','activePage','','','');

//echos the name and numbers of all rooms
echo getRooms();

//write page footer
writeHTMLFooter();

?>
