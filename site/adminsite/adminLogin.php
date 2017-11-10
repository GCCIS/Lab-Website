<?php
include_once('common/common.php');

 require_once('adminHandlers/DBcoreAdmin.class.php');
    //begin session
    session_start();
    session_name("LoginSession"); 
    //Check if the form has been submitted and the SESSION is already set
    if (isset($_SESSION['userLogin'])) {
        // logged in
        header("Location:employee.php");
    }
    else{
        if(isset($_POST['loginSubmit'])){
            $email = $_POST['username'];
            $pass = $_POST['password'];
            $DBcore = new DBcoreAdmin();
            $userArr = array();
            $userResult = $DBcore->login($email,$pass);
			//Call database function to pull the user type
            if($userResult){
              //Successful login
              $_SESSION['userLogin'] = $email;
              $_SESSION['loginStatus'] = "Pass"; 
             
		header("Location:employee.php");
              
            }       
        }
    }





writeHTMLHead("Admin Login");

?>
    <form action = "adminLogin.php" name="adminLogin" method = "post">
        <label>UserName: </label><input type = "text" name = "username"/><br/>
        <label>Password: </label><input type = "password" name = "password"/><br/>
        <input type = "submit" name = "loginSubmit" value = "Login"/><br/>
    </form>
<?php

writeHTMLFooter();
?>
