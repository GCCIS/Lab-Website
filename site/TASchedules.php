<?php
include_once('common/common.php');

//write the HTML head - provide page title - also starts the body
writeHTMLHead('TA Schedules');

//write nav
writeNav('notActivePage','notActivePage','activePage','notActivePage','notActivePage');


?>

<!--Dump the ta event calendar in this div -->


        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div id="taCalendar"></div>
                </div>
            </div>
        </div>    

<?php

//write page footer
writeHTMLFooter();
?>
