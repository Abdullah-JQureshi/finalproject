<?php

	// Database Connection

	$hostname = "localhost";
	$username = "root";
	$password  = "";
	$database  = "sports_blogging";

	$connection = mysqli_connect($hostname, $username, $password, $database);

	if(mysqli_connect_error()){
		echo "Database Connection Failed" . mysqli_connect_error() . die();
	}
?>