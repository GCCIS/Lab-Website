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
