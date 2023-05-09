const file = document.querySelector('#myFile');
const form = document.querySelector('#upload');

form.addEventListener('submit', function() {
	event.preventDefault();
	if(!file.value.length) return;
	var fileReader = new FileReader();
	fileReader.readAsText(file.files[0]);

	fileReader.onload = function() {
		var parsed_json = $.parseJSON(fileReader.result);
		var retrieved_data_array = [];
		for(let i=0;i<parsed_json.length;i++) {
			var fileObject = {};
			fileObject.id = parsed_json[i].id;
			fileObject.name = parsed_json[i].properties.name;
			fileObject.shopType = parsed_json[i].properties.shop;
			fileObject.lat = parsed_json[i].geometry.coordinates[0];
			fileObject.lng = parsed_json[i].geometry.coordinates[1];
			//fileObject.address = parsed_json[i].properties["addr:street"] + " " + parsed_json[i].properties["addr:housenumber"] + ", " + parsed_json[i].properties["addr:postcode"] + ", " + parsed_json[i].properties["addr:city"];
			if(fileObject.shopType == undefined){
				fileObject.shopType = "";
			}
			if(fileObject.name == undefined){
				fileObject.name = "";
			}
			if(parsed_json[i].properties["addr:street"] != undefined){
				fileObject.address = parsed_json[i].properties["addr:street"];
				if(parsed_json[i].properties["addr:housenumber"] != undefined){
					fileObject.address = fileObject.address + " " + parsed_json[i].properties["addr:housenumber"];
					if(parsed_json[i].properties["addr:postcode"] != undefined){
						fileObject.address = fileObject.address + ", " + parsed_json[i].properties["addr:postcode"];
					}
					if(parsed_json[i].properties["addr:city"] != undefined){
						fileObject.address = fileObject.address + ", " + parsed_json[i].properties["addr:city"];
					}
				}
			}else{
				fileObject.address = "";
			}
			retrieved_data_array.push(fileObject);
		}
		var ajax_query = $.ajax({
			type: "POST",
			url: "be-upload-stores.php",
			dataType: "text",
			data: {data:JSON.stringify(retrieved_data_array)},
			success: function(data){
				console.log(data);
			}
		});

		ajax_query.done(function(data){
			alert("Data sent!");
			console.log(data);
			window.location.assign("fe-upload-stores.php");
		});
		
		ajax_query.fail(function(){
			alert("Data NOT sent!");
		});
	}
});

const deleteButtonId = document.getElementById('delete_stores_btn');
deleteButtonId.onclick = function(){
	if(confirm("Are you sure you want to wipe the data?")){
		$deletion_query=$.ajax({
			type: "POST",
			url: "be-delete-stores.php",
			dataType: "text",
			data: {booleanVal: true},
			success:function(response){
				console.log(response);
			}
		});
		$deletion_query.done(function(response){
			alert("Stores data wiped successfully!");
			window.location.assign("fe-upload-stores.php");
		});
		$deletion_query.fail(function(){
			alert("Request to the server failed!");
		});
	}
}

