<?php
include_once('common/common.php');

//write the HTML head - provide page title - also starts the body
writeHTMLHead('TA Schedules');

//write nav
writeNav('notActivePage','notActivePage','activePage','notActivePage','notActivePage');


?>

<!--Dump the ta event calendar in this div -->

</br></br</br></br></br></br>

<div id="taCalendar"></div>

<?php

//write page footer
writeHTMLFooter();
?>
