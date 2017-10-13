<?php
include 'handlers/employees.php';
include 'common/common.php';

//write the HTML head - provide page title - also starts the body
writeHTMLHead('LA Profiles');

//write nav
writeNav('','','','','activePage');

echo getLAProfiles();

//write page footer
writeHTMLFooter();
?>
