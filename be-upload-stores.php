<?php
	session_start();
	$connect_db = mysqli_connect("localhost", "root", "", "web23") or die("Unable to connect");
	$connect_db->set_charset("utf8");
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if(isset($_POST['data'])){
			$postedData = $_POST['data'];
			$associativeArrayData = json_decode($postedData, true);
			$finalArray = array();
			$tempArray = array();
			for($i=0;$i<sizeof($associativeArrayData);$i++) {
				$tempArray = [];
				$getDate = date('Y-m-d H:i:s');
				$idInserted = "";
				$nameInserted = "";
				$shopTypeInserted = "";
				$addressInserted = "";
				$latInserted = "";
				$lngInserted = "";
				if(isset($associativeArrayData[$i]['id'])){
					$idInserted = $associativeArrayData[$i]['id'];
					array_push($tempArray,$idInserted);
				}
				if(isset($associativeArrayData[$i]['name'])){
					$nameInserted = $associativeArrayData[$i]['name'];
					array_push($tempArray,$nameInserted);
				}
				if(isset($associativeArrayData[$i]['shopType'])){
					$shopTypeInserted = $associativeArrayData[$i]['shopType'];
					array_push($tempArray,$shopTypeInserted);
				}
				if(isset($associativeArrayData[$i]['address'])){
					$addressInserted = $associativeArrayData[$i]['address'];
					array_push($tempArray,$addressInserted);
				}
				if(isset($associativeArrayData[$i]['lat'])){
					$latInserted = $associativeArrayData[$i]['lat'];
					array_push($tempArray,$latInserted);
				}
				if(isset($associativeArrayData[$i]['lng'])){
					$lngInserted = $associativeArrayData[$i]['lng'];
					array_push($tempArray,$lngInserted);
				}
				array_push($finalArray,$tempArray);
			}
			$bulk_query = "INSERT INTO stores (id, name, shopType, address, lat, lng, dateInserted) VALUES (?,?,?,?,?,?,?)";
			$stmt = $connect_db->prepare($bulk_query);
			$connect_db->begin_transaction();
			foreach($finalArray as $outer){
				$stmt->bind_param("sssssss", $outer[0], $outer[1], $outer[2], $outer[3], $outer[4], $outer[5], date('Y-m-d H:i:s'));
				$stmt->execute();
			}
			$connect_db->commit();
			echo "Inserts successful!";
		}else{
			echo "An error has occured";
		}	
	}
?>
	