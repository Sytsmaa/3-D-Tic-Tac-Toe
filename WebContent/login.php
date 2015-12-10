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
			//prevent injection
			require_once("scripts/security.php");
			$username = preventInjection($username);
			
			//get user information
			require_once("database/data.php");
			$sql = "SELECT * FROM users WHERE username='" . $username . "' LIMIT 1";
			$queryResult = query($userData, $sql);
			
			if($queryResult === false)//mysqli_num_rows($queryResult) === 0)
			{
				//debugging
				echo "No rows\n";
				
				$valid = false;
				$loginError = "That username and password combination does not exist.";
			}
			else
			{
				//debugging
				echo "Found user\n";
				
				$row = nextRow($queryResult);
				$hashedPassword = $row["password"];
				
				if(!isPassword($password, $hashedPassword))
				{
					$valid = false;
					$loginError = "That username and password combination does not exist.";
				}
				
				//set session values
				if($valid)
				{
					//set session variables
					session_start();
					
					//set username
					$_SESSION["username"] = $username;
					
					//set statistics
					$_SESSION["casual"] = array($row["casualWins"], $row["casualLosses"], $row["casualTies"]);
					$_SESSION["easy"] = array($row["easyWins"], $row["easyLosses"], $row["easyTies"]);
					$_SESSION["medium"] = array($row["mediumWins"], $row["mediumLosses"], $row["mediumTies"]);
					$_SESSION["hard"] = array($row["hardWins"], $row["hardLosses"], $row["hardTies"]);
					$_SESSION["impossible"] = array($row["impossibleWins"], $row["impossibleLosses"], $row["impossibleTies"]);
					
					//redirect
					header("Location: index.php");
				}
			}
		}
	}
	
	$title = "Login";
	$homeDir = "";
	require_once("layout/header.php");
?>
<p style="margin: 20px auto 5px;"><?php echo $loginError;?></p>
<form name="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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