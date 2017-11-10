<!DOCTYPE html>
<html lang="en">

<head>
	<title>Web Punch</title>
</head>

<body>
	<h1>TA Login</h1>
	<form action="webPunch.php" method="post">
		<label>Badge Number: </label>
		<input type="text" name="TA_EID"/>

		<label>Shift ends at: </label>
		<input type="text" name="shift_end"/>

		<select name="location">
			<option value="Sys Lab">Sys Lab</option>
			<option value="Net Lab">Net Lab</option>
			<option value="Open Lab">Open Lab</option>
			<option value="Other Lab">Other Lab</option>
		</select>
	
		<input type="submit" value="submit">
	</form>
</body>

</html>