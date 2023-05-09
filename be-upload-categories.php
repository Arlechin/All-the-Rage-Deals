<?php
	session_start();
	$connect_db = mysqli_connect("localhost", "root", "", "web23") or die("Unable to connect");
	$connect_db->set_charset("utf8");
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if((isset($_POST['catData'])) && (isset($_POST['subData']))) {
			$postedCatData = $_POST['catData'];
			$postedSubData = $_POST['subData'];
			$categoriesAssociativeArray = json_decode($postedCatData, true);
			$subcategoriesAssociativeArray = json_decode($postedSubData, true);
			$catFinalArray = array();
			$tempArray = array();
			for($i=0;$i<sizeof($categoriesAssociativeArray);$i++){
				$tempArray = [];
				$catId = "";
				$catName = "";
				$catLeft = "";
				$catRight = "";
				if(isset($categoriesAssociativeArray[$i]['catId'])){
					$catId = $categoriesAssociativeArray[$i]['catId'];
					array_push($tempArray,$catId);
				}
				if(isset($categoriesAssociativeArray[$i]['catName'])){
					$catName = $categoriesAssociativeArray[$i]['catName'];
					array_push($tempArray,$catName);
				}
				if(isset($categoriesAssociativeArray[$i]['catLeft'])){
					$catLeft = $categoriesAssociativeArray[$i]['catLeft'];
					array_push($tempArray,$catLeft);
				}
				if(isset($categoriesAssociativeArray[$i]['catRight'])){
					$catRight = $categoriesAssociativeArray[$i]['catRight'];
					array_push($tempArray,$catRight);
				}
				array_push($catFinalArray,$tempArray);
			}
			$subcatFinalArray = array();
			for($i=0;$i<sizeof($subcategoriesAssociativeArray);$i++){
				$tempArray = [];
				$subId = "";
				$subName = "";
				$subLeft = "";
				$subRight = "";
				$catId = "";
				if(isset($subcategoriesAssociativeArray[$i]['subId'])){
					$subId = $subcategoriesAssociativeArray[$i]['subId'];
					array_push($tempArray,$subId);
				}
				if(isset($subcategoriesAssociativeArray[$i]['catId'])){
					$catId = $subcategoriesAssociativeArray[$i]['catId'];
					array_push($tempArray,$catId);
				}
				if(isset($subcategoriesAssociativeArray[$i]['subName'])){
					$subName = $subcategoriesAssociativeArray[$i]['subName'];
					array_push($tempArray,$subName);
				}
				if(isset($subcategoriesAssociativeArray[$i]['subLeft'])){
					$subLeft = $subcategoriesAssociativeArray[$i]['subLeft'];
					array_push($tempArray,$subLeft);
				}
				if(isset($subcategoriesAssociativeArray[$i]['subRight'])){
					$subRight = $subcategoriesAssociativeArray[$i]['subRight'];
					array_push($tempArray,$subRight);
				}
				
				array_push($subcatFinalArray,$tempArray);
			}
			$cat_bulk_query = "INSERT INTO nested_category (gen_cat_scraper_id,category_name,lft,rgt,dateInserted) VALUES (?,?,?,?,?)";
			$stmt = $connect_db->prepare($cat_bulk_query);
			$connect_db->begin_transaction();
			foreach($catFinalArray as $catsOuter){
				$getDate = date('Y-m-d H:i:s');
				$stmt->bind_param("sssss", $catsOuter[0], $catsOuter[1], $catsOuter[2], $catsOuter[3], $getDate);
				$stmt->execute();
			}
			$connect_db->commit();

			$sub_bulk_query = "INSERT INTO nested_category (sub_cat_scraper_id,subcatBelongsToCatId,category_name,lft,rgt,dateInserted) VALUES (?,?,?,?,?,?)";
			$stmt = $connect_db->prepare($sub_bulk_query);
			$connect_db->begin_transaction();
			foreach($subcatFinalArray as $subcatsOuter){
				$getDate = date('Y-m-d H:i:s');
				$stmt->bind_param("ssssss", $subcatsOuter[0], $subcatsOuter[1], $subcatsOuter[2], $subcatsOuter[3], $subcatsOuter[4], $getDate);
				$stmt->execute();
			}
			$connect_db->commit();
			echo "Inserts successful!";
		}else{
			echo "An error has occured!";
		}
	}
?>