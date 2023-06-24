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
			if(isset($_POST['pricesData'])) {

				/* -- var_dump() gets deep into the arrays/objects: for debugging purposes
				ini_set('xdebug.var_display_max_depth', 10);
				ini_set('xdebug.var_display_max_children', 256);
				ini_set('xdebug.var_display_max_data', 1024);
				*/
				//var_dump($outerInfoDataAssociativeArray);
				//var_dump($pricesAssociativeArray);

				$postedPricesData = $_POST['pricesData'];
				$postedPricesDataAssocArr = json_decode($postedPricesData, true);
				$postedPricesFinalArray = [];
				$tempArray = [];

				for($i=0;$i<sizeof($postedPricesDataAssocArr);$i++){
					
					$tempArray = [];
					$fetch_date = "";
					$fetchDateToHumanTime = "";
					$productName = "";

					if(isset($postedPricesDataAssocArr[$i]['fetch_date'])){
						$fetch_date = $postedPricesDataAssocArr[$i]['fetch_date'];
						$fetchDateToHumanTime = date('Y-m-d H:i:s', strtotime('@' . $fetch_date));
						array_push($tempArray, $fetchDateToHumanTime);
					}
					if(isset($postedPricesDataAssocArr[$i]['productName'])){
						$productName = $postedPricesDataAssocArr[$i]['productName'];
						array_push($tempArray, $productName);
					}
					
					$pricesObj = $postedPricesDataAssocArr[$i]['pricesObj'];
				    foreach ($pricesObj as $priceData => $innerValue) {
				        $date = $innerValue[0];
				        $price = $innerValue[1];
				        array_push($tempArray, $date, $price);
	    			}

					array_push($postedPricesFinalArray, $tempArray);
				}

				
				//var_dump($postedPricesFinalArray);
				$prices_bulk_query = "INSERT INTO prices (fetch_date, product_name, price_onDate_0, price_onDate_1, price_onDate_2, price_onDate_3, price_onDate_4, date_0, date_1, date_2, date_3, date_4, dateInserted) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $connect_db->prepare($prices_bulk_query);
				$connect_db->begin_transaction();
				foreach($postedPricesFinalArray as $prices => $value){
						$innerElement = $value;
						$getDate= date('Y-m-d H:i:s');
						$stmt->bind_param("ssdddddssssss", $innerElement[0], $innerElement[1], $innerElement[3], $innerElement[5], $innerElement[7], $innerElement[9], $innerElement[11], $innerElement[2], $innerElement[4], $innerElement[6], $innerElement[8], $innerElement[10], $getDate);
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

