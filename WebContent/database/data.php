<?php
	//Referenced from https://hub.jazz.net/project/communitysample/php-mysql/overview#https://hub.jazz.net/git/communitysample%252Fphp-mysql/contents/master/index.php
	echo '<h2>VCAP_SERVICE Environment variable</h2>';
	echo "----------------------------------" . "</br>";
	$key = "VCAP_SERVICES";
	$value = getenv ( $key );
	echo $key . ":" . $value . "</br>";
	echo "----------------------------------" . "</br>";

	/*$vcap_services = json_decode($_ENV["VCAP_SERVICES"]);
	$db = $vcap_services->{'sqldb'}[0]->credentials;
	$mysql_database = $vcap_services->{'sqldb'}[0]->name;
	$mysql_server_name = $db->host . ':' . $db->port;
	$mysql_username = $db->username;
	$mysql_password = $db->password;

	echo "name=" . $mysql_database . "\n";
	echo "server=" . $mysql_server_name . "\n";
	echo "username=" . $mysql_username . "\n";
	echo "password=" . $mysql_password . "\n";

	$mysql_server_name = "75.126.155.153:50000";
	$mysql_username = "user11913";
	$mysql_password = "CrCkhfK9hKDL";
	$mysql_database = "SQL Database-eu";

	$userData = mysql_connect($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);*/

	$conn_string = "DRIVER={IBM DB2 ODBC DRIVER};DATABASE=SQL Database-eu;HOSTNAME=75.126.155.153;PORT=50000;PROTOCOL=TCPIP;UID=user11913;PWD=CrCkhfK9hKDL";
	$userData = db2_connect($conn_string, '', '');

	//$userData = mysqli_connect("75.126.155.153", "USER11358", "5S835bQMEcE1");//, "sql database-t8");
	//$userData = mysqli_connect("localhost", "rayten", "password", "sql database-t8");
	
	if(!$userData)
	{
		//die("Connection failed: " . mysql_error());
		die("Connection failed: " . db2_conn_errormsg());
	}
?>