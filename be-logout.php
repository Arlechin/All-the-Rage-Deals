<?php
	session_start();
	if(isset($_SESSION["Loggedin"])){
		if($_SESSION["Loggedin"] == true){
			header("Location: ./successful-logout.php");
			session_destroy();
			session_unset();
		}
	}else{
		header("Location: ./unsuccessful-logout.php");
	}
	
?>