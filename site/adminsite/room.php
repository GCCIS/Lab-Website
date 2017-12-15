<?php
include_once('common/common.php');
include 'adminHandlers/roomHandler.php';
  session_start();
   if(!isset($_SESSION['userLogin'])){
        //NOT logged in
        header("Location:logout.php");
   }
   
    writeHTMLHead("Room");
    writeNav("notActivePage", "notActivePage", "notActivePage", "activePage");

	//if the form has been submitted then update the database
        if(isset($_POST['submitRoomEdit'])){
		//send the edit room to the database
		print_r($_POST);
		editRoom($_POST['prevNumber'], $_POST['roomName'], $_POST['roomNumber']);
                editRoomHours($_POST['roomNumber'], 'SU', $_POST['SU_openTime'], $_POST['SU_closeTime']);
                editRoomHours($_POST['roomNumber'], 'M', $_POST['M_openTime'], $_POST['M_closeTime']);
                editRoomHours($_POST['roomNumber'], 'TU', $_POST['TU_openTime'], $_POST['TU_closeTime']);
                editRoomHours($_POST['roomNumber'], 'W', $_POST['W_openTime'], $_POST['W_closeTime']);
                editRoomHours($_POST['roomNumber'], 'TH', $_POST['TH_openTime'], $_POST['TH_closeTime']);
                editRoomHours($_POST['roomNumber'], 'F', $_POST['F_openTime'], $_POST['F_closeTime']);
                editRoomHours($_POST['roomNumber'], 'SA', $_POST['SA_openTime'], $_POST['SA_closeTime']);


	}
        else if(isset($_POST['deleteRoom'])){
                //delete the room
                deleteRoom($_POST['roomList']);
        }
	else if(isset($_POST['submitRoomAdd'])){
		//the add room form has been submitted so now update the database	
		addRoom($_POST['roomName'], $_POST['roomNumber']);
		addRoomHours($_POST['roomNumber'], 'SU', $_POST['SU_openTime'], $_POST['SU_closeTime']);
                addRoomHours($_POST['roomNumber'], 'M', $_POST['M_openTime'], $_POST['M_closeTime']);
                addRoomHours($_POST['roomNumber'], 'TU', $_POST['TU_openTime'], $_POST['TU_closeTime']);
                addRoomHours($_POST['roomNumber'], 'W', $_POST['W_openTime'], $_POST['W_closeTime']);
                addRoomHours($_POST['roomNumber'], 'TH', $_POST['TH_openTime'], $_POST['TH_closeTime']);
                addRoomHours($_POST['roomNumber'], 'F', $_POST['F_openTime'], $_POST['F_closeTime']);
                addRoomHours($_POST['roomNumber'], 'SA', $_POST['SA_openTime'], $_POST['SA_closeTime']);
	}

?>

    <form action="room.php" name="roomForm" method="post">
 	<select name="roomList">
		<option>Select a Room</option>
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
