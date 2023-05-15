<script>
	$(document).ready(function() {
		$("form").each(function(){
			$(this).bind("submit", function(event){
				event.preventDefault();
				var formHTML = event.target;
				var submitAction =  formHTML.name;
				var submitValue = document.getElementById("submit").value;
				if(submitAction == "signup"){
					var username = document.getElementById("username-signup").value;
					var password = document.getElementById("password-signup").value;
					var repeatPassword = document.getElementById("repeat-password-signup").value;
					var email = document.getElementById("email-signup").value;
					$(".form-message").load("be-login-signup.php", {
						'username': username,
						'password': password,
						'repeatPassword': repeatPassword,
						'email': email,
						'submitValue': submitValue,
						'submitAction': submitAction
					});
				}else if(submitAction == "login"){
					var username = document.getElementById("username-login").value;
					var password = document.getElementById("password-login").value;
					$(".form-message").load("be-login-signup.php", {
						'username': username,
						'password': password,
						'submitValue': submitValue,
						'submitAction': submitAction
					});
				}
			});
		});
	});
</script>