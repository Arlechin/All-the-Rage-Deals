const file = document.querySelector('#categoriesFile');
const form = document.querySelector('#upload-categories-subcategories');
$('#uploadCatSubmitFile').attr('disabled', true);
file.addEventListener('change', function() {
	if(file.files.length > 0){
		$('#uploadCatSubmitFile').removeAttr('disabled');
	}else{
		$('#uploadCatSubmitFile').attr('disabled', true);
	}
});
form.addEventListener('submit', function() {
	event.preventDefault();
	if(!file.value.length) return;
	var fileReader = new FileReader();
	fileReader.readAsText(file.files[0]);

	fileReader.onload = function(event) {
		var parsed_json = $.parseJSON(fileReader.result);
		var retrievedCategoriesArray = [];
		var retrievedSubcategoriesArray = [];
		var catLft = 1;
		var catRgt = 0;
		var subLft = 0;
		var subRgt = 0;
		for(let i=0;i<parsed_json.categories.length;i++){
			var catObject = {};
			subLft = catLft;
			for(let j=0;j<parsed_json.categories[i].subcategories.length;j++){
				var subCatObject = {};
				subLft = subLft + 1;
				subRgt = subLft + 1;
				subCatObject.subLeft = subLft;
				subCatObject.subRight = subRgt;
				subCatObject.subName = parsed_json.categories[i].subcategories[j].name;
				subCatObject.subId = parsed_json.categories[i].subcategories[j].uuid;
				subCatObject.catId = parsed_json.categories[i].id;
				retrievedSubcategoriesArray.push(subCatObject);
				subLft = subLft + 1;
			}
			catRgt = ((parsed_json.categories[i].subcategories.length) * 2) + catLft + 1;
			catObject.catLeft = catLft;
			catLft = catRgt + 1;
			catObject.catRight = catRgt;
			catObject.catName = parsed_json.categories[i].name;
			catObject.catId = parsed_json.categories[i].id;
			retrievedCategoriesArray.push(catObject);
		}
		var ajax_query = $.ajax({
			type: "POST",
			url: "be-upload-categories.php",
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