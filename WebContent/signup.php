<?php
	$signupError = "&nbsp;";
	if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["email"]))
	{
		//set variables
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password2 = $_POST["password2"];
		$email = $_POST["email"];
		$quickCheck = array($username, $password, $password2, $email);
		$valid = true;
		
		//check if all required fields were set
		foreach($quickCheck as $field)
		{
			if($field == NULL || $field == "")
			{
				$signupError = "Please fill in all fields to sign up";
				$valid = false;
			}
		}
		
		//check for user
		if($valid)
		{
			//check for existing username or e-mail
			
			//encrypt password
			// A higher "cost" is more secure but consumes more processing power
			$cost = 10;
			
			// Create a random salt
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
			
			// Prefix information about the hash so PHP knows how to verify it later.
			// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
			$salt = sprintf("$2a$%02d$", $cost) . $salt;
			
			// Hash the password with the salt
			$hash = crypt($password, $salt);
			
			//create account
		
			//set session variables
			session_start();
			$_SESSION["username"] = $_POST["username"];
			if(!isset($_SESSION["casual"]))
			{
				$_SESSION["casual"] = array(0, 0, 0);
				$_SESSION["easy"] = array(0, 0, 0);
				$_SESSION["medium"] = array(0, 0, 0);
				$_SESSION["hard"] = array(0, 0, 0);
				$_SESSION["impossible"] = array(0, 0, 0);
			}
			
			//redirect
			header("Location: index.php");
		}
	}
	
	$title = "Login";
	$homeDir = "";
	require_once("layout/header.php");
?>
<p style="margin: 20px auto 5px;"><?php echo $signupError;?></p>
<form name="login" method="post" action="login.php">
	<table style="margin: 0 auto 20px;">
    	<tr>
        	<td>Username: </td>
            <td><input name="username" type="text" maxlength="32" required /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td>Password: </td>
            <td><input name="password" type="password" required /></td>
            <td>Note: For your own security, do not use a password used for other accounts.</td>
        </tr>
        <tr>
        	<td>Re-enter Password: </td>
            <td><input name="password2" type="password" maxlength="32" requred /></td>
        </tr>
        <tr>
        	<td>E-Mail: </td>
            <td><input name="email" type="email" maxlength="32" required /></td>
            <td>Note: This is only to prevent users having unlimited accounts. We will not share or use this information</td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
          	<td align="right"><input type="submit" /></td>
            <td>&nbsp;</td>
        </tr>
    </table>
</form>
<?php
require_once("layout/footer.php");
?>