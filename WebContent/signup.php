<?php
	$signupError = "&nbsp;";
	
	//values to autofill
	$username = "";
	$email = "";
	
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
		
		if($valid && strlen($password) < 6)
		{
			$valid = false;
			$signupError = "Password must be at least 6 characters long.";
		}
		
		//compare entered passwords
		if($valid && $password !== $password2)
		{
			$signupError = "Passwords did not match";
			$valid = false;
		}
		
		//check password for rules
		/*if($valid)
		{
			$hasUpper = false;
			$hasLower = false;
			$hasNum = false;
			$hasSpecial = false;
			for($x = 0; $x < strlen($password); $x++)
			{
				$char = substr($password, $x, 1);
				
				if(ctype_upper($char))
				{
					$hasUpper = true;
				}
				else if(ctype_lower($char))
				{
					$hasLower = true;
				}
				else if(ctype_digit($char))
				{
					$hasNum = true;
				}
				else
				{
					$hasSpecial = true;
				}
			}
			
			if(!$hasLower || !$hasNum || !$hasSpecial || !$hasUpper)
			{
				$valid = false;
				$signupError = "Your password must contain at least one upper-case letter, one lower-case letter, one number, and one special character";
			}
		}*/
		
		//try to prevent injections
		require_once("scripts/security.php");
		$username = preventInjection($username);
		$email = preventInjection($email);
		
		//check for user
		if($valid)
		{
			//check for existing username or e-mail
			require_once("database/data.php");
			$queryResults = query($userData, "SELECT username, email FROM USERS WHERE username='" . $username . "' OR email='" . $email . "'");
			
			if(!($queryResults === false) && numRows($queryResults) > 0)
			{
				//debug
				echo "<p>has at least one row</p>";
				
				$valid = false;
				$usernameTaken = false;
				$emailTaken = false;
				
				while($row = nextRow($queryResults))
				{
					//debugging
					echo "<p>" . $row["username"] . " " . $row["password"] . "</p>";
					echo "<p>while</p>";
					
					if($row["username"] == $username)
					{
						$usernameTaken = true;
					}
					
					if($row["email"] == $email)
					{
						$emailTaken = true;
					}
				}
				
				if($usernameTaken)
				{
					$signupError = "That username has already been taken. ";
				}
				
				if($emailTaken)
				{
					$signupError = $signupError . "That e-mail has already been taken.";
				}
			}
		}
		
		//create user
		if($valid)
		{
			//encrypt password
			$hash = hashPassword($password);
			
			//create account
			$sql = "INSERT INTO USERS (username, password, email) VALUES ('" . $username . "', '" . $hash . "', '" . $email . "')";
			
			query($userData, $sql);
		
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
			//header("Location: index.php");
		}
	}
	
	$title = "Signup";
	$homeDir = "";
	require_once("layout/header.php");
?>
<p style="margin: 20px auto 5px;"><?php echo $signupError;?></p>
<form name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<table style="margin: 0 auto 20px;">
    	<tr>
        	<td>Username: </td>
            <td><input name="username" type="text" value="<?php echo $username;?>" maxlength="32" required /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td>Password: </td>
            <td><input name="password" type="password" required /></td>
            <td>Note: For your own security, do not use a password used for other accounts. For your security, your password cannot be changed as of right now.</td>
        </tr>
        <tr>
        	<td>Re-enter Password: </td>
            <td><input name="password2" type="password" maxlength="32" requred /></td>
        </tr>
        <tr>
        	<td>E-Mail: </td>
            <td><input name="email" type="email" value="<?php echo $email;?>" maxlength="32" required /></td>
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