<?php

writeHTMLHead("Admin Login");

?>
    <form action = "" name="adminLogin" method = "post">
        <label>UserName: </label><input type = "text" name = "username"/><br/>
        <label>Password: </label><input type = "password" name = "password"/><br/>
        <input type = "submit" name = "loginSubmit" value = "loginSubmit"/><br/>
    </form>
<?php

writeHTMLFooter();
?>