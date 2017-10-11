<?php
include 'handlers/employees.php';
include 'common/common.php';

//write the HTML head - provide page title - also starts the body
writeHTMLHead('TA Profiles');

//write nav
writeNav();

echo getEmployees('TA');

//write page footer
writeHTMLFooter();
?>

