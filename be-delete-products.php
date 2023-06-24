<?php
	session_start();
	$connect_db = mysqli_connect("localhost", "root", "", "web23") or die("Unable to connect");
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['booleanVal'])){
			$booleanVal = $_POST['booleanVal'];
			if($booleanVal){
				$deletion_query = "TRUNCATE products";
				if(mysqli_query($connect_db,$deletion_query)){
					echo "Products data wiped successfully!";
				}else{
					echo "Something went wrong!";
				}
			}
		}
	}
?>