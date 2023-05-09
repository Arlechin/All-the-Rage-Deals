<?php 
	session_start();
	$connect_db = mysqli_connect("localhost", "root", "", "web23") or die("Unable to connect");
	if(isset($_SESSION["Loggedin"])){
		if($_SESSION["Loggedin"] == true){
			if($_SESSION["Type"] == "admin") {
				$_SESSION["addCategories"] = false;
				$add_or_upload_query = "SELECT COUNT(*) FROM nested_category";
				$execute_query = mysqli_query($connect_db,$add_or_upload_query);
				$dataArray = mysqli_fetch_array($execute_query, MYSQLI_NUM);
				if($dataArray[0] != 0){
					$_SESSION["addCategories"] = true;
				}else{
					$_SESSION["addCategories"] = false;
				}
			}
			
			$returnArr = ["message"=>"ajaxSuccess!","loggedin"=>$_SESSION["Loggedin"],"username"=>$_SESSION["Username"],"type"=>$_SESSION["Type"],"addCategories"=>$_SESSION["addCategories"]];
			echo json_encode($returnArr);
		}
	}else{
		$returnArr = ["ajaxError!"];
		echo json_encode($returnArr);
	}
?>