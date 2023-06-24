<script>
	$(document).ready(function() {
		let nothingness = "nothingness";
		let everythingness = "everythingness";
		const submenu_ajax = $.ajax({
			type: 'POST',
			url: 'be-inject-html.php',
			dataType: "text",
			data: {nothing: nothingness, everything: everythingness}
		}).done(function(response){
			var parsedResponse = $.parseJSON(response);
			query_done(parsedResponse);
		});
			
		function query_done(parsedResponse){
			if(typeof parsedResponse.loggedin !== 'undefined'){
				if(parsedResponse.loggedin == true){
					let loggedin = parsedResponse.loggedin;
					let	username = parsedResponse.username;
					let	type = parsedResponse.type;
					if(type == "user"){
						//show sub-menu
						const sub_menu = document.getElementById('sub-menu-menu');
						let html_sub_menu = '<div class="user-info"><img src="./images/user.png"><h3></h3></div><hr><a href="fe-user-edit-profile.php" class="sub-menu-link"><img src="./images/edit.png"><p>Edit profile</p><span>></span></a><a href="be-logout.php" class="sub-menu-link"><img src="./images/logout.png" id="logout-img"><p>Log out</p><span>></span></a>';
						sub_menu.insertAdjacentHTML("afterbegin", html_sub_menu);
						$(".user-info h3").html("Logged in as: " + username);
						//show side-nav to user
						const side_nav_container = document.getElementById('side-nav-container');
						let html_side_nav_user = '<div class="side-nav-user"><a href="#" class="side-nav-user-logo"><img src="./images/ATRD-logo-cut.png" class="side-nav-user-logo-img"><img src="./images/ATRD-small-logo.png" class="side-nav-user-logo-icon"></a><ul class="side-nav-user-links"><li><a href="fe-deal-map-user.php"><i class="fa-solid fa-map-location-dot"></i><p>Deal Map</p></a></li><li><a href="#"><i class="fa-solid fa-coins"></i><p>My Tokens</p></a></li><li><a href="#"><i class="fa-solid fa-star-half-stroke"></i><p>My Score</p></a></li><div class="side-nav-user-link-active"></div></ul></div>';
						side_nav_container.insertAdjacentHTML("afterbegin", html_side_nav_user);
					}else if(type == "admin"){
						//show sub-menu
						const sub_menu = document.getElementById('sub-menu-menu');
						let html_sub_menu = '<div class="user-info"><img src="./images/admin.png"><h3></h3></div><hr><a href="fe-admin-edit-profile.php" class="sub-menu-link"><img src="./images/edit.png"><p>Edit profile</p><span>></span></a><a href="be-logout.php" class="sub-menu-link"><img src="./images/logout.png" id="logout-img"><p>Log out</p><span>></span></a>';
						sub_menu.insertAdjacentHTML("afterbegin", html_sub_menu);
						$(".user-info h3").html("Logged in as: " + username);	
						//show side-nav to admin
						const side_nav_container = document.getElementById('side-nav-container');
						let html_side_nav_admin = '<div class="side-nav-admin"><a href="#" class="side-nav-admin-logo"><img src="./images/ATRD-logo-cut.png" class="side-nav-admin-logo-img"><img src="./images/ATRD-small-logo.png" class="side-nav-admin-logo-icon"></a><ul class="side-nav-admin-links"><li><a href="fe-upload-products.php"><i class="fa-solid fa-upload"></i><p>Upload Products</p></a></li><li><a href="fe-upload-stores.php"><i class="fa-solid fa-upload"></i><p>Upload Stores</p></a></li><li><a href="fe-visualize-statistics.php"><i class="fa-solid fa-chart-column"></i><p>Statistics</p></a></li><li><a href="fe-leaderboard.php"><i class="fa-solid fa-trophy"></i><p>Leaderboard</p></a></li><li><a href="fe-deal-map-admin.php"><i class="fa-solid fa-map-location-dot"></i><p>Deal Map</p></a></li><div class="side-nav-admin-link-active"></div></ul></div>';
						side_nav_container.insertAdjacentHTML("afterbegin", html_side_nav_admin);
						//upload products 
						if(window.location.pathname == "/webproject/fe-upload-products.php"){
							// upload categories
							if(parsedResponse.addCategories == false){
								let modulePath = "./upload-categories-script.js";
								import(modulePath);
								const upload_categories_container = document.getElementById('upload-categories-container');
								let html_upload_cat_admin = '<h3>Choose the json file containing the categories/subcategories you want to upload.</h3><form id="upload-categories-subcategories"><input type="file" id="categoriesFile" name="catFilename"><input type="submit" id="uploadCatSubmitFile" accept=".json"></form>';
								upload_categories_container.insertAdjacentHTML("afterbegin", html_upload_cat_admin);
							// add more categories to the existing
							}else{
								let modulePath = "./upload-more-categories-script.js";
								import(modulePath);
								const upload_categories_container = document.getElementById('upload-categories-container');
								let html_add_more_cat_admin = '<h3>Choose the json file containing the categories/subcategories you want to add to the already existing ones.</h3><form id="add-more-categories-subcategories"><input type="file" id="moreCategoriesFile" name="moreCatFilename"><input type="submit" id="addMoreCatSubmitFile" accept=".json" value="Add more"></form>';
								upload_categories_container.insertAdjacentHTML("afterbegin", html_add_more_cat_admin);
							}
							//upload products
							if(parsedResponse.addProducts == false){
								let modulePath = "./upload-products-script.js";
								import(modulePath);
								const upload_products_container = document.getElementById('upload-products-container');
								let html_upload_prod_admin = '<h3>Choose the json file containing the products you want to upload.</h3><form id="upload-products"><input type="file" id="productsFile" name="prodFilename"><input type="submit" id="uploadProdSubmitFile" accept=.json"></form>';
								upload_products_container.insertAdjacentHTML("afterbegin",html_upload_prod_admin);
							// add more products to the existing
							}else{
								let modulePath = "./upload-products-script.js";
								import(modulePath);
								const upload_products_container = document.getElementById('upload-products-container');
								let html_add_more_prod_admin = '<h3>Choose the json file containing the products you want to add to the already existing ones.</h3><form id="upload-products"><input type="file" id="productsFile" name="prodFilename"><input type="submit" id="uploadProdSubmitFile" accept=".json" value="Add more"></form>';
								upload_products_container.insertAdjacentHTML("afterbegin",html_add_more_prod_admin);
							}
							// upload prices
							if(parsedResponse.addPrices == false){
								let modulePath = "./upload-prices-script.js";
								import(modulePath);
								const upload_prices_container = document.getElementById('upload-prices-container');
								let html_upload_prices_admin = '<h3>Choose the json file containing the product prices you want to upload.</h3><form id="upload-prices"><input type="file" id="pricesFile" name="pricesFilename"><input type="submit" id="uploadPricesSubmitFile" accept=".json"></form>';
								upload_prices_container.insertAdjacentHTML("afterbegin",html_upload_prices_admin);
							// add more prices to the existing
							}else{
								let modulePath = "./upload-prices-script.js";
								import(modulePath);
								const upload_prices_container = document.getElementById('upload-prices-container');
								let html_add_more_prices_admin = '<h3>Choose the json file containing the product prices you want to add to the already existing ones.</h3><form id="upload-prices"><input type="file" id="pricesFile" name="pricesFilename"><input type="submit" id="uploadPricesSubmitFile" accept=".json" value="Add more"></form>';
								upload_prices_container.insertAdjacentHTML("afterbegin",html_add_more_prices_admin);
							}
						}
					}
				}
			}else{
				const sub_menu = document.getElementById('sub-menu-menu');
				let html_sub_menu = '<div class="user-info"><img src="./images/down-right-arrow.png"><h3>Please log in or sign up!</h3></div><hr><a href="fe-login-signup.php" class="sub-menu-link"><img src="./images/login.png"><p>Log-in/Sign-up</p><span>></span></a>';
				sub_menu.insertAdjacentHTML("afterbegin", html_sub_menu);
			}
		}
	});
</script>