<?php include 'header.php' ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Log in/Signup - All The Rage Deals</title>
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
		

		<!-- login/signup -->
		<nav class="login-nav">
			<ul>
				<li><a class="login" href="#0">Log in</a></li>
				<li><a class="signup" href="#0">Sign up</a></li>
			</ul>
		</nav>

		<div class="user-modal">
			<div class="user-modal-container">
				<ul class="switcher">
					<li><a href="#0">Log in</a></li>
					<li><a href="#0">New account</a></li>
				</ul>

				<div id="login">
					<form class="form" id="formLogin" method="post" name="login" novalidate>
						<p class="fieldset">
							<input type="hidden" id="action" value="login">
							<label class="image-replace username" for="login-username">Username</label>
							<input class="full-width has-padding has-border" name="login-username" id="username-login" type="text" placeholder="Username" required>
						</p>

						<p class="fieldset">
							<label class="image-replace password" for="login-password">Password</label>
							<input class="full-width has-padding has-border" name="login-password" id="password-login" type="password" placeholder="Password" required>
							<a href="#0" class="hide-password">Show</a>							
						</p>

						<p class="fieldset">
							<input type="checkbox" id="remember-me" checked>
							<label for="remember-me">Remember me</label>
						</p>

						<p class="fieldset">
							<input id= "submit" class="full-width" type="submit" value="Login">
						</p>

						<p class="form-message"></p>
					</form>
				</div>

				<div id="signup">
					<form class="form" id="formSignup" method="post" name="signup" novalidate>
						<p class="fieldset">
							<input type="hidden" id="action" value="signup">
							<label class="image-replace username" for="signup-username">Username</label>
							<input class="full-width has-padding has-border" name="signup-username" id="username-signup" type="text" placeholder="Username" required>
						</p>

						<p class="fieldset">
							<label class="image-replace email" for="signup-email">E-mail</label>
							<input class="full-width has-padding has-border" name="signup-email" id="email-signup" type="email" placeholder="E-mail" required>
						</p>

						<p class="fieldset">
							<label class="image-replace password" for="signup-password">Password</label>
							<input class="full-width has-padding has-border" name="signup-password" id="password-signup" type="password" placeholder="Password" required>
							<a href="#0" class="hide-password">Show</a>
						</p>

						<p class="fieldset">
							<label class="image-replace password" for="signup-repeat-password">Repeat password</label>
							<input class="full-width has-padding has-border" name="signup-repeat-password" id="repeat-password-signup" type="password" placeholder="Repeat password" required>
							<a href="#0" class="hide-password">Show</a>

						<p class="fieldset">
							<input id="submit" class="full-width has-padding" type="submit" value="Create account">
						</p>
						<p class="form-message"></p>
						<p class="session-message" id="sess-msg"></p>
					</form>
				</div>
				<a href="#0" class="close-form">Close</a>	
			</div>
		</div>					
		<div class="footer">
			<a href="https://www.ceid.upatras.gr/en"><img alt="Ceid @upatras web page" style="border-witdh:0" src="images/logo.png"></a>
		</div>
		<script src="fe-login-signup-script.js"></script>
		<script src="./fe-sub-menu-script.js"></script>
		<?php require 'login-signup-submitData-script.php'; ?>
		<?php require './inject-html.php'; ?>
	</body>
</html>