<?php
	//Referenced from https://hub.jazz.net/project/communitysample/php-mysql/overview#https://hub.jazz.net/git/communitysample%252Fphp-mysql/contents/master/index.php
	$vcap_services = json_decode($_ENV["VCAP_SERVICES"]);
	$db = $vcap_services->{'mysql-5.5'}[0]->credentials;
	$mysql_database = $db->name;
	$mysql_server_name = $db->host . ':' . $db->port;
	$mysql_username = $db->username;
	$mysql_password = $db->password;

	$userData = mysql_connect($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
	//$userData = mysqli_connect("75.126.155.153", "USER11358", "5S835bQMEcE1");//, "sql database-t8");
	//$userData = mysqli_connect("localhost", "rayten", "password", "sql database-t8");
	
	if(!$userData)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
?>