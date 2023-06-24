<?php
	session_start();
	try {
		date_default_timezone_set('Europe/Athens');
		$connect_db = mysqli_connect("localhost", "root", "", "web23");
		if($connect_db->connect_errno){
				throw new Exception("Failed to connect to MySQL: " . $connect_db->connect_error);
		}
		$connect_db->set_charset("utf8");
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			if((isset($_POST['prodData']))) {

				$postedProdData = $_POST['prodData'];
				$productsAssociativeArray = json_decode($postedProdData, true);
				$prodFinalArray = [];

				for($i=0;$i<sizeof($productsAssociativeArray);$i++){
					
					$tempArray = [];
					$prodScrapedId = "";
					$prodName = "";
					$prodCategory = "";
					$prodSubCategory = "";

					if(isset($productsAssociativeArray[$i]['prodScrapedId'])){
						$prodScrapedId = $productsAssociativeArray[$i]['prodScrapedId'];
						array_push($tempArray, $prodScrapedId);
					}
					if(isset($productsAssociativeArray[$i]['prodName'])){
						$prodName = $productsAssociativeArray[$i]['prodName'];
						array_push($tempArray, $prodName);
					}
					if(isset($productsAssociativeArray[$i]['prodCategory'])){
						$prodCategory = $productsAssociativeArray[$i]['prodCategory'];
						array_push($tempArray, $prodCategory);
					}
					if(isset($productsAssociativeArray[$i]['prodSubcategory'])){
						$prodSubCategory = $productsAssociativeArray[$i]['prodSubcategory'];
						array_push($tempArray, $prodSubCategory);
					}
					array_push($prodFinalArray, $tempArray);
				}

				$prod_bulk_query = "INSERT INTO products (scraped_id, product_name, product_category_id, product_subcategory_id, dateInserted) VALUES (?,?,?,?,?)";
				$stmt = $connect_db->prepare($prod_bulk_query);
				$connect_db->begin_transaction();
				foreach($prodFinalArray as $products){
					$getDate = date('Y-m-d H:i:s');
					$stmt->bind_param("sssss", $products[0], $products[1], $products[2], $products[3], $getDate);
					$stmt->execute();
				}
				$connect_db->commit();
				echo "Inserts successful!";
			}else{
				echo "An error has occured!";
			}
		}
		$connect_db->close();
		$returnArr = [
			"message" => "ajaxSuccess!"
		];
		echo json_encode($returnArr);
	} catch (Exception $e) {
		$returnArr = ["error" => $e->getMessage()];
		echo json_encode($returnArr);
	}
?>