<?php 
	include 'header.php';
	include 'protect-admin.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Upload Products - All The Rage Deals</title>
	</head>
	<body>
		<h1 class="header">All The Rage Deals</h1>
		<div class="profile-menu-action">
			<img class="user-pic" src="./images/user.png" onclick="toggleMenu()">
			<div class="sub-menu-wrap" id="sub-menu-wrap">
				<div class="sub-menu" id="sub-menu-menu">
				</div>
			</div>	
		</div>
		<nav class="header">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
		<div class="side-nav-container" id="side-nav-container">
			<!--<div class="side-nav">
				<a href="#" class="side-nav-logo">
					<img src="./images/ATRD-logo-cut.png" class="side-nav-logo-img">
					<img src="./images/ATRD-small-logo.png" class="side-nav-logo-icon">
				</a>
				<ul class="side-nav-links">
					<li><a href="#"><i class="fa-solid fa-map-location-dot"></i><p>Offers Map</p></a></li>
					<li><a href="#"><i class="fa-solid fa-coins"></i><p>My Tokens</p></a></li>
					<li><a href="#"><i class="fa-solid fa-star-half-stroke"></i><p>My Score</p></a></li>
					<div class="side-nav-link-active"></div>
				</ul>
			</div>-->
		</div>
		<main>
			<h2>Upload Products</h2>
			<h2>Here you can upload product categories, subcategories, products and prices</h2>
			<div class="upload-categories-container" id="upload-categories-container">
				<!--<h3>Choose the json file containing the categories/subcategories/products you want to upload.</h3>
				<form id="upload-categories-subcategories">
					<input type="file" id="categoriesFile" name="catFilename">
					<input type="submit" id="submitFile" accept=".json">
				</form>-->
			</div> 
			
			<div class="upload-products-container" id="upload-products-container">
				<!--inject container-->	
			</div>
			<!--<h3>Choose the json file containing the product prices you want to upload.</h3>
			<form id="upload-product-prices">
				<input type="file" id="pricesFile" name="pricesFilename">
				<input type="submit" id="submitFile" accept=".json">
			</form>
			-->
			<div class="upload-prices-container" id="upload-prices-container">

			</div>
			
			<h3>You can also erase all related data in the system using the button below.</h3>
			<input type="button" id="delete_categories_btn" value="Delete All Categories/Products Data"></input>
		</main>
		

		<div class="footer" id="footer">
			<a href="https://www.ceid.upatras.gr/en"><img alt="Ceid @upatras web page" style="border-witdh:0" src="images/logo.png"></a>
		</div>
		<!--<script src="./upload-categories-script.js"></script>-->
		<script src="./fe-sub-menu-script.js"></script>
		<?php require './inject-html.php'; ?>
	</body>
</html>