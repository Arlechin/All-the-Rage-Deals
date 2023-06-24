const file = document.querySelector('#productsFile');
const form = document.querySelector('#upload-products');
$('#uploadProdSubmitFile').attr('disabled', true);
file.addEventListener('change', function() {
	if(file.files.length > 0){
		$('#uploadProdSubmitFile').removeAttr('disabled');
	}else{
		$('#uploadProdSubmitFile').attr('disabled', true);
	}
});
form.addEventListener('submit', function(event) {
	event.preventDefault();
	if(!file.value.length) return;
	var fileReader = new FileReader();
	fileReader.readAsText(file.files[0]);

	fileReader.onload = function() {
		var parsed_json = $.parseJSON(fileReader.result);
		var retrievedProductsArray = [];
		for(let i=0;i<parsed_json.products.length;i++){
			var prodObject = {};
			prodObject.prodScrapedId = parsed_json.products[i].id;
			prodObject.prodName = parsed_json.products[i].name;
			prodObject.prodCategory = parsed_json.products[i].category;
			prodObject.prodSubcategory = parsed_json.products[i].subcategory;
			retrievedProductsArray.push(prodObject);
		}
		var ajax_query = $.ajax({
			type: "POST",
			url: "be-upload-products.php",
			dataType: "text",
			data: {prodData:JSON.stringify(retrievedProductsArray)},
			success: function(response){
				console.log(response);
			}
		});

		ajax_query.done(function(response){
			alert("Data sent!");
			window.location.assign("fe-upload-products.php");
		});

		ajax_query.fail(function(){
			alert("Data NOT sent!");
		});
	}
});