<?php 
session_start();

if(isset($_SESSION['Loggedin'])){
	if($_SESSION['Type'] != 'admin'){
		header('HTTP/1.1 403 Forbidden');
		die('You do not have permission to access this page.');
	}
}else{
	header('HTTP/1.1 403 Forbidden');
	die('You do not have permission to access this page.');
}

?>