<?php
include 'common/common.php';
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
		editRoom(sanitize($_POST['prevNumber']), sanitize($_POST['roomName']), sanitize($_POST['roomNumber']));
                editRoomHours(sanitize($_POST['roomNumber']), 'SU', sanitize($_POST['SU_openTime']), sanitize($_POST['SU_closeTime']));
                editRoomHours(sanitize($_POST['roomNumber']), 'M', sanitize($_POST['M_openTime']), sanitize($_POST['M_closeTime']));
                editRoomHours(sanitize($_POST['roomNumber']), 'TU', sanitize($_POST['TU_openTime']), sanitize($_POST['TU_closeTime']));
                editRoomHours(sanitize($_POST['roomNumber']), 'W', sanitize($_POST['W_openTime']), sanitize($_POST['W_closeTime']));
                editRoomHours(sanitize($_POST['roomNumber']), 'TH', sanitize($_POST['TH_openTime']), sanitize($_POST['TH_closeTime']));
                editRoomHours(sanitize($_POST['roomNumber']), 'F', sanitize($_POST['F_openTime']), sanitize($_POST['F_closeTime']));
                editRoomHours(sanitize($_POST['roomNumber']), 'SA', sanitize($_POST['SA_openTime']), sanitize($_POST['SA_closeTime']));


	}
        else if(isset($_POST['deleteRoom'])){
                //delete the room
                deleteRoom(sanitize($_POST['roomList']));
        }
	else if(isset($_POST['submitRoomAdd'])){
		//the add room form has been submitted so now update the database	
		addRoom(sanitize($_POST['roomName']), sanitize($_POST['roomNumber']));
		addRoomHours(sanitize($_POST['roomNumber']), 'SU', sanitize($_POST['SU_openTime']), sanitize($_POST['SU_closeTime']));
                addRoomHours(sanitize($_POST['roomNumber']), 'M', sanitize($_POST['M_openTime']), sanitize($_POST['M_closeTime']));
                addRoomHours(sanitize($_POST['roomNumber']), 'TU', sanitize($_POST['TU_openTime']), sanitize($_POST['TU_closeTime']));
                addRoomHours(sanitize($_POST['roomNumber']), 'W', sanitize($_POST['W_openTime']), sanitize($_POST['W_closeTime']));
                addRoomHours(sanitize($_POST['roomNumber']), 'TH', sanitize($_POST['TH_openTime']), sanitize($_POST['TH_closeTime']));
                addRoomHours(sanitize($_POST['roomNumber']), 'F', sanitize($_POST['F_openTime']), sanitize($_POST['F_closeTime']));
                addRoomHours(sanitize($_POST['roomNumber']), 'SA', sanitize($_POST['SA_openTime']), sanitize($_POST['SA_closeTime']));
	}

?>


<div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class=adminFunctions>
    			<form action="room.php" name="roomForm" method="post">
				<ul>
 					<select name="roomList" required="">
						<option>Select a Room</option>
						<?php
							echo getRooms();
						?>
					</select>
					<li><button class="btn btn-lg btn-primary btn-block" type="submit" name="editRoom" value="Edit Room">Edit Room</button></li>
					<li><button class="btn btn-lg btn-primary btn-block" type="submit" name="addRoom" value="Add Room">Add Room</button></li>
					<li><button class="btn btn-lg btn-primary btn-block" type="submit" name="deleteRoom" value="Delete Room">Delete Room</button></li>
    				</ul>
			</form>
		</div>
            </div>
        </div>
    </div> 
<?php

	if(isset($_POST['addRoom'])){
		//create the add room form
		echo createAddRoomForm();
	}
	else if(isset($_POST['editRoom'])){
		//create the edit room form
		echo createEditRoomForm(sanitize($_POST['roomList']));	
	}
	

    writeHTMLFooter();
?>
