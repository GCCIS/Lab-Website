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

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class=Roomstatus>
                       <h2 class="text-left">Select a room to see the calendar</h2>
                        <ul>
                            <?php
                                //<li class="activeRoom"><a>Mac Lab2</a></li>
                                if(isset($_POST['roomNumber'])){
                                    echo makeRoomButtons($_POST['roomNumber']);
                                }
                            else{
                                    echo makeRoomButtons("");
                            }
                            ?>
                            
                        </ul>

                    </div>
                </div>
            </div>
              <div class="row">
                <div class="col-md-12 text-center">
                      <div id="calendar"></div>
                </div>
            </div>
        </div>    


<script>
	var room = "<?php echo $_POST['roomNumber'];?>";
	console.log(room);
</script>
    <div class="container labStatus  text-center">

<?php
    getRooms();


//write page footer
writeHTMLFooter();
?>
