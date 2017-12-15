<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
            <meta name="description" content="">
            <meta name="author" content="">
            <link rel="icon" href="favicon.ico">
            <title>Web Punch</title>
            <!-- Bootstrap core CSS -->
            <link href="../css/bootstrap.min.css" rel="stylesheet">
            
            <!-- Bootstrap theme CSS -->
            <link href="../css/darkly.min.css" rel="stylesheet">
            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
            
            <!-- Custom styles for Full Calendar -->
            <link href="../css/fullcalendar.css" rel="stylesheet" />
              
              
            <!-- Custom styles for this template -->
            <link href="../css/style.css" rel="stylesheet">
            
            <!-- Full Calendar, Jquery, moment Javascript file -->
	    <script src="../js/jquery.min.js"></script>
            <script src="../js/moment.min.js"></script>  
            <script src="../js/fullcalendar.js"></script>
            <!-- Just for debugging purposes. Dont actually copy these 2 lines! -->
            <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
            <script src="../js/ie-emulation-modes-warning.js"></script>
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
          </head>
          <body>
<?php

require('../handlers/DBcore.class.php');
	function sanitize($var){
        	$var = trim($var);
        	$var = stripslashes($var);
        	$var = strip_tags($var);
        	$var = htmlspecialchars($var);
        	return $var;
    	}



        if(isset($_POST['submitWebpunch'])){
                //print_r($_POST);
		//DOES NOT handle when someone enters an invalid badge number -- the database is not changed but no error is given -- the form will not show up
                date_default_timezone_set("America/New_York");
                $TA_EID = sanitize($_POST["TA_EID"]);
                $shift_date = date('Y-m-d');
                $shift_begin = date('H:i:s');
                $shift_end = sanitize($_POST["shift_end"]).':00';
                $location = sanitize($_POST["location"]);

                //ta logged their info so add a record to the database
                $DBcore = new DBcore();
                $result = $DBcore->addTAshift($TA_EID, $shift_date, $shift_begin, $shift_end, $location);
                if($result){
                }
                else{
                        echo "Something went wrong -- ensure you entered a valid Badge Number";
                }
        }
?>

<script>
	function validateForm(){
		var badgeNum = document.forms["webpunchForm"]["TA_EID"].value;
		var endTime = document.forms["webpunchForm"]["shift_end"].value;
		if(badgeNum.length != 7){
			alert("Badge Number must be 7 numbers long");
			return false;
		}
		//^([0-1][0-9]|2[0-3]):([0-5][0-9])$
		if(!endTime.match(/^([0-1][0-9]|2[0-3]):([0-5][0-9])$/)){
			alert("Time must be in the format HH:MM in 24hr time")
			return false;
		}

	}
</script>
              
              <!--
	<h1>TA Login</h1>
	<form action="index.php" method="post" name="webpunchForm" onsubmit="return validateForm()" >
		<label>Badge Number: </label>
		<input type="text" name="TA_EID" required/>
		<br>
		<label>Shift ends at (use 24hr time): </label>
		<input type="text" name="shift_end" required/>
		<br>
		<label>Location</label>
		<select name="location">
			<option value="Sys Lab">Sys Lab</option>
			<option value="Net Lab">Net Lab</option>
			<option value="Open Lab">Open Lab</option>
			<option value="Other Lab">Other Lab</option>
		</select>
		<br>
		<input type="submit" name="submitWebpunch" value="submit">
	</form> -->
              
    <div class="webPunchHeader"> <!-- Main component for a primary message -->
        <div class="container">
            <div class="row"> 
                <div class=" col-md-12 text-center">
                    <h1>Welcome to IST Labs</h1>
                </div>
                <div class="logo col-md-12">
                    <img src="images/IST_large.png">  
                </div>
            </div>     
        </div>
    </div>
    
    <div class="TALogin">
            <form class="webPunchForm" action="index.php" method="post" name="webpunchForm" onsubmit="return validateForm()" >    
                  <h2>TA/GA Login</h2>
                  <label>Badge Number:</label>
                  <input type="text" class="form-control" placeholder="Enter Badge Number" required="" autofocus="" name="TA_EID" required/>
                  <label>Shift ends at (use 24hr time):</label>
                  <input type="text" class="form-control" name="shift_end" placeholder="Enter Shift Hours" required=""/>
                  <label>Location:</label>
                  <select name="location" required="">
                    <option value="Sys Lab">Sys Lab</option>
                    <option value="Net Lab">Net Lab</option>
                    <option value="Open Lab">Open Lab</option>
                    <option value="Other Lab">Other Lab</option>
                  </select>
                  <button name="submitWebpunch" class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>   
            </form>    
    </div>
          

 <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
	    <script src="../js/bootstrap.min.js"></script>
            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <script src="../js/ie10-viewport-bug-workaround.js"></script>
            <script src="../js/script.js"></script>
</body>

</html>
