const file = document.querySelector('#moreCategoriesFile');
const form = document.querySelector('#add-more-categories-subcategories');
$('#addMoreSubmitFile').attr('disabled',true);
file.addEventListener('change', function() {
	if(file.files.length > 0){
		$('#addMoreSubmitFile').removeAttr('disabled');
	}else{
		$('#addMoreSubmitFile').attr('disabled',true);
	}
});
form.addEventListener('submit', function() {
	event.preventDefault();
	if(!file.value.length) return;
	var fileReader = new FileReader();
	fileReader.readAsText(file.files[0]);
	fileReader.onload = function() {
		var parsed_json = $.parseJSON(fileReader.result);
		var retrievedCategoriesArray = [];
		var retrievedSubcategoriesArray = [];
		for(let i=0;i<parsed_json.categories.length;i++){
			var catObject = {};
			for(let j=0;j<parsed_json.categories[i].subcategories.length;j++){
				var subCatObject = {};
				subCatObject.subName = parsed_json.categories[i].subcategories[j].name;
				subCatObject.subId = parsed_json.categories[i].subcategories[j].uuid;
				subCatObject.catId = parsed_json.categories[i].id;
				retrievedSubcategoriesArray.push(subCatObject);
			}
			catObject.catName = parsed_json.categories[i].name;
			catObject.catId = parsed_json.categories[i].id;
			retrievedCategoriesArray.push(catObject);
		}
		var ajax_query = $.ajax({
			type: "POST",
			url: "be-upload-more-categories.php",
			dataType: "text",
			data: {catData:JSON.stringify(retrievedCategoriesArray), subData:JSON.stringify(retrievedSubcategoriesArray)},
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
})