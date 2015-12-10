<?php
	$userData = db2_connect("75.126.155.153", "USER11358", "5S835bQMEcE1");//, "sql database-t8");
	//$userData = mysqli_connect("localhost", "rayten", "password", "sql database-t8");
	
	function query($sqlQuery)
	{
		$prepared = db2_prepare($userdata,$sqlQuery);
		db2_execute($prepared);
		return $prepared;
		//return mysqli_query($userData, $sqlQuery);
	}
	
	function nextRow($queryResult)
	{
		return db2_fetch_row($queryResult);
		//return mysqli_fetch_assoc($queryResult);
	}
	
	function close()
	{
		db2_close($userData);
		//mysqli_close($userdata);
	}
	
	if(!$userData)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
?>