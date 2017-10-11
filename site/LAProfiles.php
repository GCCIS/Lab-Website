<?php
include 'handlers/employees.php';
include 'common/common.php';

//write the HTML head - provide page title - also starts the body
writeHTMLHead('LA Profiles');

//write nav
writeNav();

echo getEmployees('LA');

//write page footer
writeHTMLFooter();
?>
