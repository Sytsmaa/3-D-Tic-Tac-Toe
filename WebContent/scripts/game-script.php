<?php
	function incrementWins()
	{
		$difficulty = $_SESSION["difficulty"];
		
		if($difficulty == "casual")
		{
			$value = $_SESSION["casual"][0];
			$value++;
			$_SESSION["casual"][0] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET casualWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "easy")
		{
			$value = $_SESSION["easy"][0];
			$value++;
			$_SESSION["easy"][0] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET easyWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "medium")
		{
			$value = $_SESSION["medium"][0];
			$value++;
			$_SESSION["medium"][0] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET mediumWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "hard")
		{
			$value = $_SESSION["hard"][0];
			$value++;
			$_SESSION["hard"][0] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET hardWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "impossible")
		{
			$value = $_SESSION["impossible"][0];
			$value++;
			$_SESSION["impossible"][0] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET impossibleWins=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
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
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET casualLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "easy")
		{
			$value = $_SESSION["easy"][1];
			$value++;
			$_SESSION["easy"][1] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET easyLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "medium")
		{
			$value = $_SESSION["medium"][1];
			$value++;
			$_SESSION["medium"][1] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET mediumLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "hard")
		{
			$value = $_SESSION["hard"][1];
			$value++;
			$_SESSION["hard"][1] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET hardLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "impossible")
		{
			$value = $_SESSION["impossible"][1];
			$value++;
			$_SESSION["impossible"][1] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET impossibleLosses=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
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
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET casualTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "easy")
		{
			$value = $_SESSION["easy"][2];
			$value++;
			$_SESSION["easy"][2] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET easyTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "medium")
		{
			$value = $_SESSION["medium"][2];
			$value++;
			$_SESSION["medium"][2] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET mediumTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "hard")
		{
			$value = $_SESSION["hard"][2];
			$value++;
			$_SESSION["hard"][2] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET hardTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
		if($difficulty == "impossible")
		{
			$value = $_SESSION["impossible"][2];
			$value++;
			$_SESSION["impossible"][2] = $value;
			
			if($_SESSION["username"] == "")
				return;
			
			$sql = "UPDATE USERS SET impossibleTies=" . $value . " WHERE username='" . $_SESSION["username"] . "'";
			query($userData, $sql);
		}
	}
?>