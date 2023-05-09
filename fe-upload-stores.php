<?php 
	include 'header.php';
	include 'protect-admin.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Upload Stores - All The Rage Deals</title>
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
			<h2>Upload Stores</h2>
			<p>Here you can upload stores in your area using a json file.</p>
			<h3>Choose the json file containing the stores you want to upload.</h3>
			<form id="upload">
				<input type="file" id="myFile" name="filename">
				<input type="submit" id="submitFile" accept=".json">
			</form>
			<h3>You can also erase all the stores in the system using the button below.</h3>
			<input type="button" id="delete_stores_btn" value="Delete All Stores"></input>
		</main>
		

		<div class="footer">
			<a href="https://www.ceid.upatras.gr/en"><img alt="Ceid @upatras web page" style="border-witdh:0" src="images/logo.png"></a>
		</div>
		<script src="./fe-sub-menu-script.js"></script>
		<script src="./upload-stores-script.js"></script>
		<?php require './inject-html.php'; ?>
	</body>
</html>