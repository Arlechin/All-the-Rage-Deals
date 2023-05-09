<?php

	$connect_DB = mysqli_connect("localhost", "root", "", "web23") or die("Unable to establish connection to database.");

	if(mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connecterror();
		exit();	
	}
?>