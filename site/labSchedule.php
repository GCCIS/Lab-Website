<?php
include 'handlers/roomStatus.php';
//include 'handlers/eventSchedules.php';
include_once('common/common.php');

//write the HTML head - provide page title - also starts the body
writeHTMLHead('Lab Schedule');

//write nav
writeNav('notActivePage','activePage','notActivePage','notActivePage','notActivePage');

//echos the name and numbers of all rooms
//echo getRooms();

?>
<!--Dump the event calendar in this div -->

</br></br</br></br></br></br>
<div id="calendar"><div>


<?php
echo createRoomStatus();

//write page footer
writeHTMLFooter();

?>
