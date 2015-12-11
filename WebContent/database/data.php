<?php
function handler($level, $message)
{
	return;
}
set_error_handler("handler");
	//referenced from https://hub.jazz.net/project/ibmdatabase/dashDB/overview?cm_mc_uid=55561737454714477902675&cm_mc_sid_50200000=1449758628#https://hub.jazz.net/git/ibmdatabase%252FdashDB/contents/master/samples/dashDBPHP/index.php
	//parse vcap
	if( getenv("VCAP_SERVICES") ) {
	    $json = getenv("VCAP_SERVICES");
	} 
	// No DB credentials
	else {
	    echo "No vcap services available.";
	    return;
	}
	$services_json = json_decode($json,true);
	$blu = $services_json["sqldb"];
	if (empty($blu)) {
	    echo "No sqldb service instance is bound. Please bind a sqldb service instance";
	    return;
	}
	$bludb_config = $services_json["sqldb"][0]["credentials"];
	// create DB connect string
	$conn_string = "DRIVER={IBM DB2 ODBC DRIVER};DATABASE=".
	   $bludb_config["db"].
	   ";HOSTNAME=".
	   $bludb_config["host"].
	   ";PORT=".
	   $bludb_config["port"].
	   ";PROTOCOL=TCPIP;UID=".
	   $bludb_config["username"].
	   ";PWD=".
	   $bludb_config["password"].
	   ";";
	// connect to BLUDB
	$userData = db2_connect($conn_string, '', '');
	//$userData = mysqli_connect("localhost", "rayten", "password", "sql database-t8");
	
	if(!$userData)
	{
		//die("Connection failed: " . mysql_error());
		die("Connection failed: " . db2_conn_errormsg());
	}
	
	function query($sqlQuery)
	{
		/*$prepared = db2_prepare($userdata,$sqlQuery);
		if(db2_execute($prepared))
		{
			return $prepared;
		}
		else
		{
			return false;
		}*/
		return db2_exec($userdata, $sqlQuery);
		//return mysqli_query($userData, $sqlQuery);
	}
	
	function numRows($queryResult)
	{
		return db2_num_rows($queryResult);
		//return mysqli_num_rows($queryResult);
	}
	
	function nextRow($queryResult)
	{
		return db2_fetch_assoc($queryResult);
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