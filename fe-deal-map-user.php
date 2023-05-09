<?php 
	include 'header.php';
	include 'protect-user.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Deal Map - All The Rage Deals</title>
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
			<h2>Deal Map</h2>
			<p>To be written  <a href="https://www.ceid.upatras.gr">ceid</a></p>
			<div class="leaflet-map" id="map">

			</div>
		</main>

		<div class="footer">
			<a href="https://www.ceid.upatras.gr/en"><img alt="Ceid @upatras web page" style="border-witdh:0" src="images/logo.png"></a>
		</div>
		<script src="./fe-sub-menu-script.js"></script>
		<script src="./fe-deal-map-user-script.js"></script>
		<?php require './inject-html.php'; ?>
	</body>
</html>