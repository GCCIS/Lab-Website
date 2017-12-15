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

    <div class="adminHeader"> <!-- Main component for a primary message -->
        <div class="container">
            <div class="row"> 
                <div class=" col-md-12 text-center">
                    <h1>Welcome to IST Labs</h1>
                </div>
                <div class="logo col-md-12">
                    <img src="../images/IST_large.png">  
                </div>
            </div>     
        </div>
    </div>

    <div class="adminLogin">
        <form class="loginForm" action = "adminLogin.php" name="adminLogin" method = "post">       
              <h2>Admin Login</h2>
              <input type="text" class="form-control" name="username" placeholder="Enter Username" required="" autofocus="" />
              <input type="password" class="form-control" name="password" placeholder="Enter Password" required=""/> 
              <button class="btn btn-lg btn-primary btn-block" type="submit" name="loginSubmit" value="Login">Login</button>   
        </form>    
    </div>

<!--
    <form action = "adminLogin.php" name="adminLogin" method = "post">
        <label>UserName: </label><input type = "text" name = "username"/><br/>
        <label>Password: </label><input type = "password" name = "password"/><br/>
        <input type = "submit" name = "loginSubmit" value = "Login"/><br/>
    </form> -->
<?php

writeHTMLFooter();
?>
