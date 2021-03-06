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
			//$sql = "SELECT * FROM users WHERE username='" . $username . "' LIMIT 1";
			$sql = "SELECT * FROM users WHERE username='" . $username . "'";
			//$queryResult = query($userData, $sql);
			$queryResult = db2_exec($userData, $sql);
			
			$row = db2_fetch_assoc($queryResult);
			
			//if($queryResult === false || numRows($queryResult) == 0)//mysqli_num_rows($queryResult) === 0)\
			if($queryResult === false || $row === false)
			{
				//debugging
				echo "<p>No Rows</p>";
				
				$valid = false;
				$loginError = "That username and password combination does not exist.";
			}
			else
			{
				//debugging
				echo "<p>Found user</p>";
				
				//$row = nextRow($queryResult);
				//$row = db2_fetch_assoc($queryResult);
				$hashedPassword = $row['PASSWORD'];
				
				//debugging
				echo "<p>" . $row['USERNAME'] . " " . $row['PASSWORD'] . "</p>";
				
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
					$_SESSION["casual"] = array($row["CASUALWINS"], $row["CASUALLOSSES"], $row["CASUALTIES"]);
					$_SESSION["easy"] = array($row["EASYWINS"], $row["EASYLOSSES"], $row["EASYTIES"]);
					$_SESSION["medium"] = array($row["MEDIUMWINS"], $row["MEDIUMLOSSES"], $row["MEDIUMTIES"]);
					$_SESSION["hard"] = array($row["HARDWINS"], $row["HARDLOSSES"], $row["HARDTIES"]);
					$_SESSION["impossible"] = array($row["IMPOSSIBLEWINS"], $row["IMPOSSIBLELOSSES"], $row["IMPOSSIBLETIES"]);
					
					//close database
					db2_close($userData);
					
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
          	<td align="right"><input type="submit" value="Log In" /></td>
        </tr>
    </table>
</form>
<?php
require_once("layout/footer.php");
?>