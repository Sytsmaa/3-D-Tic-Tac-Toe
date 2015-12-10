<?php
	$userData = mysqli_connect("75.126.155.153", "user11358", "5S835bQMEcE1", "sql database-t8");
	//$userData = mysqli_connect("localhost", "rayten", "password", "sql database-t8");
	
	if(!$userData)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
?>