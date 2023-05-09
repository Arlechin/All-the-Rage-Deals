<?php
	session_start();
	$connect_db = mysqli_connect("localhost", "root", "", "web23") or die("Unable to connect");
	if(isset($_POST['submitValue'])){
		if(isset($_POST['submitAction'])){
			if(isset($_SESSION["Loggedin"])){
				if($_SESSION["Loggedin"] == false){
					if($_POST['submitAction'] == "signup"){
						signup($connect_db);
					}else if($_POST['submitAction'] == "login"){
						login($connect_db);
					}
				}else{
					echo "<span class='form-error'>You are already logged-in! Please log out to sign up or log in with a different account.</span>";
				}
			}else{
				if($_POST['submitAction'] == "signup"){
						signup($connect_db);
				}else if($_POST['submitAction'] == "login"){
						login($connect_db);
				}
			}
		}
	}else{
		session_destroy();
		session_unset();
		echo "<span class='form-error'>There was an unexpected error!</span>";
	}

	function signup($connect_db){	
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$repeatPassword = $_POST["repeatPassword"];

		$errorEmptyFields = false;
		$errorInvalidEmail = false;
		$errorRepeatedPassword = false;
		$errorInvalidPassword = false;
		$errorUsernameTaken = false;
		$errorFailedQuery = false;
		echo '<script> $("#username-signup, #email-signup, #password-signup, #repeat-password-signup").removeClass("input-error"); </script>';
		echo '<script> $("#username-signup, #email-signup, #password-signup, #repeat-password-signup").removeClass("login-signup-success"); </script>';
		if((empty($username)) || (empty($email)) || (empty($password)) || (empty($repeatPassword))){
			echo "<span class='form-error'>Please fill in all fields!</span>";
			$errorEmptyFields = true;
			echo '<script> $("#username-signup, #email-signup, #password-signup, #repeat-password-signup").addClass("input-error"); </script>';
		}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "<span class='form-error'>Please enter a valid e-mail address!</span>";
			$errorInvalidEmail = true;
			echo '<script> $("#email-signup").addClass("input-error"); </script>';
		}else if($password != $repeatPassword){
			echo "<span class='form-error'>The passwords you entered do not match!</span>";
			$errorRepeatedPassword = true;
			echo '<script> $("#password-signup, #repeat-password-signup").addClass("input-error"); </script>';
		}else if(validPsw($password) == false){
			echo "<span class='form-error'>Your password must contain at least 8 characters, 1 capital, 1 number, 1 symbol and no spaces!</span>";
			$errorInvalidPassword = true;
			echo '<script> $("#password-signup, #repeat-password-signup").addClass("input-error"); </script>';
		}else{
			$user = mysqli_query($connect_db, "SELECT * FROM users WHERE username = '$username'");
			if(mysqli_num_rows($user) > 0){
				echo "<span class='form-error'>Username already taken!</span>";
				$errorUsernameTaken = true;
				echo '<script> $("#username-signup").addClass("input-error"); </script>';
			}else{
				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
				$insert_query_content = "INSERT INTO users(username, password, email) VALUES('$username', '$hashedPassword', '$email')";
				$actual_query = mysqli_query($connect_db, $insert_query_content);
				if(!$actual_query){
					echo "<span class='form-error'>Oops! An unexpected database error occured!</span>";
					$errorFailedQuery = true;

				}else{
					echo "<span class='form-success'>You have signed up successfuly! Redirecting you in 25 seconds..</span>";
					echo '<script> $("#username-signup, #email-signup, #password-signup, #repeat-password-signup").addClass("login-signup-success"); </script>';
					echo '<script> setTimeout(function(){ window.location = "fe-login-signup.php";}, 25000); </script>';
				}
			}	
		}
		if(($errorEmptyFields == false) && ($errorInvalidEmail == false) && ($errorRepeatedPassword == false) && ($errorInvalidPassword == false) && ($errorUsernameTaken == false)){
			echo '<script> $("#username-signup, #email-signup, #password-signup, #repeat-password-signup").val(""); </script>';
		}
	}

	function login($connect_db){
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		echo '<script> $("#username-login, #password-login").removeClass("input-error"); </script>';
		echo '<script> $("#username-login, #password-login").removeClass("login-signup-success"); </script>';
		$errorWrongCredentials = false;
		$dbUserArray = mysqli_query($connect_db, "SELECT * FROM users WHERE username = '$username'");
		if(mysqli_num_rows($dbUserArray) > 0){
			$row = mysqli_fetch_assoc($dbUserArray);
			$hash = $row["password"];
			$dbUser = $row["username"];
			$dbUserType = $row["type"];
			if((!(password_verify($password, $hash))) || (!($username == $dbUser))){
				echo "<span class='form-error'>Wrong username or password!</span>";
				$errorWrongCredentials = true;
				echo '<script> $("#username-login, #password-login").addClass("input-error"); </script>';
			}else{
				echo "<span class='form-success'>You have logged in successfuly! Redirecting you in 5 seconds..</span>";
				echo '<script> $("#username-login, #password-login").addClass("login-signup-success"); </script>';
				$_SESSION["Loggedin"] = true;
				$_SESSION["Username"] = $dbUser;
				$_SESSION["Type"] = $dbUserType;
				echo '<script> setTimeout(function(){ window.location = "index.php";}, 5000); </script>';
			}
		}else{
			echo "<span class='form-error'>Wrong username or password!</span>";
			$errorWrongCredentials = true;
			echo '<script> $("#username-login, #password-login").addClass("input-error"); </script>';
		}
		if($errorWrongCredentials == false){
				echo '<script> $("#username-login, #password-login").val("");  </script>';
			}
	}
	
	function validPsw($password){
		define('expression', '~^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\d]).{8,}$~');
		if(preg_match(expression, $password)){
			return true;
		}else{
			return false;
		}
	}

	function successfulLogin(){


	}
?>





	

