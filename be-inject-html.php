<?php 
	session_start();
	$connect_db = mysqli_connect("localhost", "root", "", "web23") or die("Unable to connect");
	if(isset($_SESSION["Loggedin"])){
		if($_SESSION["Loggedin"] == true){
			if($_SESSION["Type"] == "admin") {
				$_SESSION["addCategories"] = false;
				$add_or_upload_categories_query = "SELECT COUNT(*) FROM nested_category";
				$add_or_upload_products_query = "SELECT COUNT(*) FROM products";
				$add_or_upload_prices_query = "SELECT COUNT(*) FROM prices";

				$execute_categories_query = mysqli_query($connect_db,$add_or_upload_categories_query);
				$execute_products_query = mysqli_query($connect_db,$add_or_upload_products_query);
				$execute_prices_query = mysqli_query($connect_db,$add_or_upload_prices_query);

				$categoriesDataArray = mysqli_fetch_array($execute_categories_query, MYSQLI_NUM);
				$productsDataArray = mysqli_fetch_array($execute_products_query, MYSQLI_NUM);
				$pricesDataArray = mysqli_fetch_array($execute_prices_query, MYSQLI_NUM);

				if($categoriesDataArray[0] != 0){
					$_SESSION["addCategories"] = true;
				}else{
					$_SESSION["addCategories"] = false;
				}
				if($productsDataArray[0] != 0){
					$_SESSION["addProducts"] = true;
				}else{
					$_SESSION["addProducts"] = false;
				}
				if($pricesDataArray[0] != 0){
					$_SESSION["addPrices"] = true;
				}else{
					$_SESSION["addPrices"] = false;
				}

			}else{
				$_SESSION["addCategories"] = false;
				$_SESSION["addProducts"] = false;
				$_SESSION["addPrices"] = false;
			}
			
			$returnArr = ["message"=>"ajaxSuccess!", "loggedin"=>$_SESSION["Loggedin"], "username"=>$_SESSION["Username"], "type"=>$_SESSION["Type"], "addCategories"=>$_SESSION["addCategories"], "addProducts"=>$_SESSION["addProducts"], "addPrices"=>$_SESSION["addPrices"]];
			echo json_encode($returnArr);
		}
	}else{
		$returnArr = ["ajaxError!"];
		echo json_encode($returnArr);
	}
?>