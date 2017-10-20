<?php
include 'handlers/employees.php';
include 'common/common.php';

//write the HTML head - provide page title - also starts the body
writeHTMLHead('TA Profiles');

//write nav
writeNav('notActivePage','notActivePage','notActivePage','activePage','notActivePage');

echo getTAProfiles();

//write page footer
writeHTMLFooter();
?>

