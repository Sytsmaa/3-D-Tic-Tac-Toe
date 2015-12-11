<?php
	function incrementWins()
	{
		$difficulty = $_SESSION["difficulty"];
		
		if($difficulty == "casual")
		{
			$value = $_SESSION["casual"][0];
			$value++;
			$_SESSION["casual"][0] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE USERS SET CASUALWINS=" . $value . " WHERE USERNAME='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			$result = db2_exec($userData, $sql);
		}
		if($difficulty == "easy")
		{
			$value = $_SESSION["easy"][0];
			$value++;
			$_SESSION["easy"][0] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET easyWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			$result = db2_exec($userData, $sql);		}
		if($difficulty == "medium")
		{
			$value = $_SESSION["medium"][0];
			$value++;
			$_SESSION["medium"][0] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET mediumWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			$result = db2_exec($userData, $sql);
		}
		if($difficulty == "hard")
		{
			$value = $_SESSION["hard"][0];
			$value++;
			$_SESSION["hard"][0] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET hardWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			$result = db2_exec($userData, $sql);
		}
		if($difficulty == "impossible")
		{
			$value = $_SESSION["impossible"][0];
			$value++;
			$_SESSION["impossible"][0] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET impossibleWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			$result = db2_exec($userData, $sql);
		}
		
		echo "difficulty=" . $difficulty . "<br />";
		echo "username=" . $_SESSION["username"] . "<br />";
		echo "value=" . $value . "<br />";
		echo "sql=" . $sql . "<br />";
		
		if ($result)
		{
			echo "result=" . $result . "<br />";
		}
		else
		{
			echo "result=false<br />";
		}
	}
	
	function incrementLosses()
	{
		$difficulty = $_SESSION["difficulty"];
		
		if($difficulty == "casual")
		{
			$value = $_SESSION["casual"][1];
			$value++;
			$_SESSION["casual"][1] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET casualLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
		if($difficulty == "easy")
		{
			$value = $_SESSION["easy"][1];
			$value++;
			$_SESSION["easy"][1] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET easyLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
		if($difficulty == "medium")
		{
			$value = $_SESSION["medium"][1];
			$value++;
			$_SESSION["medium"][1] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET mediumLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
		if($difficulty == "hard")
		{
			$value = $_SESSION["hard"][1];
			$value++;
			$_SESSION["hard"][1] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET hardLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
		if($difficulty == "impossible")
		{
			$value = $_SESSION["impossible"][1];
			$value++;
			$_SESSION["impossible"][1] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET impossibleLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
	}
	
	function incrementTies()
	{
		$difficulty = $_SESSION["difficulty"];
		
		if($difficulty == "casual")
		{
			$value = $_SESSION["casual"][2];
			$value++;
			$_SESSION["casual"][2] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET casualTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
		if($difficulty == "easy")
		{
			$value = $_SESSION["easy"][2];
			$value++;
			$_SESSION["easy"][2] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET easyTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
		if($difficulty == "medium")
		{
			$value = $_SESSION["medium"][2];
			$value++;
			$_SESSION["medium"][2] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET mediumTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
		if($difficulty == "hard")
		{
			$value = $_SESSION["hard"][2];
			$value++;
			$_SESSION["hard"][2] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET hardTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
		if($difficulty == "impossible")
		{
			$value = $_SESSION["impossible"][2];
			$value++;
			$_SESSION["impossible"][2] = $value;
			
			if(!isset($_SESSION["username"]))
				return;
			
			$sql = "UPDATE users SET impossibleTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			//query($userData, $sql);
			db2_exec($userData, $sql);
		}
	}
?>