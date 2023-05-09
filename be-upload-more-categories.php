<?php
	session_start();
	$connect_db = new mysqli("localhost", "root", "", "web23") or die("Unable to connect");
	$connect_db->set_charset("utf8");
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		if((isset($_POST['catData'])) && (isset($_POST['subData']))) {
			$postedCatData = $_POST['catData'];
			$postedSubData = $_POST['subData'];
			$categoriesAssociativeArray = json_decode($postedCatData, true);
			$subcategoriesAssociativeArray = json_decode($postedSubData, true);

			// --------------CATEGORIES-------------
			$catFinalArray = array();
			$tempArray = array();
			for($i=0;$i<sizeof($categoriesAssociativeArray);$i++){
				$tempArray = [];
				$catId = "";
				$catName = "";
				if(isset($categoriesAssociativeArray[$i]['catId'])){
					$catId = $categoriesAssociativeArray[$i]['catId'];
					array_push($tempArray,$catId);
				}
				if(isset($categoriesAssociativeArray[$i]['catName'])){
					$catName = $categoriesAssociativeArray[$i]['catName'];
					array_push($tempArray,$catName);
				}
				array_push($catFinalArray,$tempArray);
			}

			// ---------------SUBCATEGORIES------------------
			$subcatFinalArray = array();
			for($i=0;$i<sizeof($subcategoriesAssociativeArray);$i++) {
				$tempArray = [];
				$subId = "";
				$subName = "";
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
				array_push($subcatFinalArray,$tempArray);
			}
			
			// ---------------CATEGORIES-----------------

			$select_query0 = "SELECT @myRight := rgt FROM nested_category WHERE lft = 1;";
			$update_query0 = "UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myRight;";
			$update_query1 = "UPDATE nested_category SET lft = lft + 2 WHERE lft > @myRight;";
			$insert_query = "INSERT INTO nested_category (gen_cat_scraper_id,category_name,dateInserted,lft,rgt) VALUES (?,?,?,@myRight + 1,@myRight + 2);";
			
			$connect_db->begin_transaction();
			$connect_db->query("SET autocommit = 0");

			$lock_stmt0 = $connect_db->prepare("SELECT * FROM nested_category FOR UPDATE");
			$lock_stmt0->execute();
			$lock_result = $lock_stmt0->get_result();
			$lock_result->free();
			
			$select_stmt0 = $connect_db->prepare($select_query0);
			$update_stmt0 = $connect_db->prepare($update_query0);
			$update_stmt1 = $connect_db->prepare($update_query1);
			$insert_stmt = $connect_db->prepare($insert_query);
			
			
			foreach($catFinalArray as $catsOuter){
				$getDate = date('Y-m-d H:i:s');
				$select_stmt0->execute();
				$select_result = $select_stmt0->get_result();
			    $select_result->free();
			    $update_stmt0->execute();
			    $update_stmt1->execute();
			    $insert_stmt->bind_param("sss", $catsOuter[0], $catsOuter[1], $getDate);
			    $insert_stmt->execute();
			}
			
			$connect_db->commit();
			$select_stmt0->close();
			$update_stmt0->close();
			$update_stmt1->close();
			$insert_stmt->close();
			$lock_stmt0->close();
			
			// --------------SUBCATEGORIES----------------	

			$select_query1 = "SELECT @myLeft := lft FROM nested_category WHERE gen_cat_scraper_id = ?;";
			$update_query2 = "UPDATE nested_category SET rgt = rgt + 2 WHERE rgt > @myLeft;";
			$update_query3 = "UPDATE nested_category SET lft = lft + 2 WHERE lft > @myLeft;";
			$update_query4 = "INSERT INTO nested_category (sub_cat_scraper_id,subcatBelongsToCatId,category_name,dateInserted,lft,rgt) VALUES (?,?,?,?, @myLeft+1, @myLeft+2);";
			
			$connect_db->begin_transaction();
			$connect_db->query("SET autocommit = 0");

			$lock_stmt1 = $connect_db->prepare("SELECT * FROM nested_category FOR UPDATE");
			$lock_stmt1->execute();
			$lock_result1 = $lock_stmt1->get_result();
			$lock_result1->free();

			$select_stmt1 = $connect_db->prepare($select_query1);
			$update_stmt2 = $connect_db->prepare($update_query2);
			$update_stmt3 = $connect_db->prepare($update_query3);
			$update_stmt4 = $connect_db->prepare($update_query4);
			
			foreach($subcatFinalArray as $subcatsOuter){
				$getDate = date('Y-m-d H:i:s');
				$select_stmt1->bind_param("s", $subcatsOuter[1]);
				$select_stmt1->execute();
				$select_result1 = $select_stmt1->get_result();
				$select_result1->free();
				$update_stmt2->execute();
				$update_stmt3->execute();
				$update_stmt4->bind_param("ssss", $subcatsOuter[0], $subcatsOuter[1], $subcatsOuter[2], $getDate);
				$update_stmt4->execute();
			}

			$connect_db->commit();
			$select_stmt1->close();
			$update_stmt2->close();
			$update_stmt3->close();
			$update_stmt4->close();
			$lock_stmt1->close();
		}
	}
?>



