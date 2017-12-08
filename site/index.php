<?php
include 'handlers/roomStatus.php';
include 'handlers/employees.php';
include 'common/common.php';



//write the HTML head - provide page title - also starts the body
writeHTMLHead('Home');

//write nav
writeNav('activePage','notActivePage','notActivePage','notActivePage','notActivePage');

?>

 <div class="container onShift">
        <div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
                	<div class="TA-onShift">
				<h2>On Duty - TA</h2>

<?php
            echo getOnShiftTAs();
?>
			</div>	
		</div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="LA-onShift">
                                <h2>On Duty - Lab Assistant</h2>

<?php
            echo getOnShiftLAs();
?>
                        </div>
                </div>
        </div>
 </div>
 

<?php
	//echo getOnShiftLAs();

    echo getRooms();

//write page footer
writeHTMLFooter();

?>
