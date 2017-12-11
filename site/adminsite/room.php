<?php
include_once('common/common.php');
include 'adminHandlers/roomHandler.php';
  session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Room");
    writeNav();

	//if the form has been submitted then update the database
        if(isset($_POST['submitRoomEdit'])){
		//send the edit room to the database
		editRoom($_POST['prevNumber'], $_POST['roomName'], $_POST['roomNumber']);
	}
        else if(isset($_POST['deleteRoom'])){
                //delete the room
                deleteRoom($_POST['roomList']);
        }
	else if(isset($_POST['submitRoomAdd'])){
		//the add room form has been submitted so now update the database	
		addRoom($_POST['roomName'], $_POST['roomNumber']);
	}

?>

    <form action="room.php" name="roomForm" method="post">
 	<select name="roomList">
	<?php
		echo getRooms();
	?>
	</select>
	<input type="submit" name="editRoom" value="Edit Room">
        <input type="submit" name="deleteRoom" value="Delete Room">
        <input type="submit" name="addRoom" value="Add Room">   
    </form><br>

<?php

	if(isset($_POST['addRoom'])){
		//create the add room form
		echo createAddRoomForm();
	}
	else if(isset($_POST['editRoom'])){
		//create the edit room form
		echo createEditRoomForm($_POST['roomList']);	
	}
	

    writeHTMLFooter();
?>
