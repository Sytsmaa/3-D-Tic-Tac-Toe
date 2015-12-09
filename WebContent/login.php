<?php
	$loginError = "&nbsp;";
	if(isset($_POST["username"]) && isset($_POST["password"]))
	{
		//set variables
		$username = $_POST["username"];
		$password = $_POST["password"];
		$valid = true;
		
		//check if username and password are set
		if($username == NULL || $username == "" || $password == NULL || $password == "")
		{
			$loginError = "Username and Password are required for logging in";
			$valid = false;
		}
		
		//check for user
		if($valid)
		{
			//continue validation
		}
		
		//set session variables
		session_start();
		
		//redirect
		header("Location: index.php");
	}
	
	$title = "Login";
	$homeDir = "";
	require_once("layout/header.php");
?>
<p style="margin: 20px auto 5px;"><?php echo $loginError;?></p>
<form name="login" method="post" action="login.php">
	<table style="margin: 0 auto 20px;">
    	<tr>
        	<td>Username: </td>
            <td><input name="username" type="text" maxlength="32" required /></td>
        </tr>
        <tr>
        	<td>Password: </td>
            <td><input name="password" type="password" required /></td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
          	<td align="right"><input type="submit" /></td>
        </tr>
    </table>
</form>
<?php
require_once("layout/footer.php");
?>