const file = document.querySelector('#pricesFile');
const form = document.querySelector('#upload-prices');
$('#uploadPricesSubmitFile').attr('disabled', true);
file.addEventListener('change', function() {
	if(file.files.length > 0){
		$('#uploadPricesSubmitFile').removeAttr('disabled');
	}else{
		$('#uploadPricesSubmitFile').attr('disabled', true);
	}
});
form.addEventListener('submit', function(event) {
	event.preventDefault();
	if(!file.value.length) return;
	var fileReader = new FileReader();
	fileReader.readAsText(file.files[0]);

	fileReader.onload = () => {
		var parsed_json = $.parseJSON(fileReader.result);
		var retrievedOuterInfoArray = [];
		var retrievedPricesArray = [];

		for(let i=0;i<parsed_json.data.length;i++) {
			var outerObject = {};
			var fetch_date = parsed_json.fetch_date;
			outerObject.fetch_date = fetch_date;
			outerObject.productName = parsed_json.data[i].name;
			outerObject.pricesObj = [];
			for(let j=0;j<parsed_json.data[i].prices.length;j++) {
				var pricesArray = [];
				pricesArray.push(parsed_json.data[i].prices[j].date);
				pricesArray.push(parsed_json.data[i].prices[j].price);
				outerObject.pricesObj.push(pricesArray);
			}
			retrievedOuterInfoArray.push(outerObject);
		}
		var ajax_query = $.ajax({
			type: "POST",
			url: "be-upload-prices.php",
			dataType: "text",
			data: {pricesData:JSON.stringify(retrievedOuterInfoArray)},
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