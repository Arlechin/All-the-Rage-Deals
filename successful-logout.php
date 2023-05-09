<?php include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Thank you! - All The Rage Deals</title>
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
		
		<main>
			<h2>Thank you!</h2>
			<p>You have been logged out successfully, thank you for using our services!</p>
		</main>
		<div class="footer">
			<a href="https://www.ceid.upatras.gr/en"><img alt="Ceid @upatras web page" style="border-witdh:0" src="images/logo.png"></a>
		</div>
		<script src="./fe-sub-menu-script.js"></script>
		<?php require './inject-html.php'; ?>
	</body>
</html>