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


 
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="TA-onShift">
                    <h2>TA - Available</h2>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3">
                            <img src="images/LA1.png">
                            <h3>Jacob Holtman </h3>
                        </div>
                        <div class="TADetails col-xs-7 col-sm-7 col-md-8">
                            <p>Open Lab</p>
                            <p>1:20 PM to 3:00 PM</p>
                            <p><span class="TASignoffs">Signoffs</span>240, 340</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="TA-onShift">
                    <h2>TA - Available</h2>
                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-3">
                            <img src="images/LA1.png">
                            <h3>Jacob Holtman </h3>
                        </div>
                        <div class="TADetails col-xs-7 col-sm-7 col-md-8">
                            <p>Open Lab</p>
                            <p>1:20 PM to 3:00 PM</p>
                            <p><span class="TASignoffs">Signoffs</span>240, 340</p>
                        </div>
                    </div>
                </div>
            </div>
   