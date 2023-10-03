$(document).ready(function() {
	$.ajax({
		url: 'backend/api/program?getall',
		type: 'GET',
		dataType: 'json',
	})
	.done(function(res){
		if(res.status == 200){
			showProg(res.data);
		}
	})
	.fail(function() {
		console.log("error");
	});


	$.ajax({
		url: 'backend/api/level?getall',
		type: 'GET',
		dataType: 'json',
		
	})
	.done(function(res){
		if(res.status == 200){
 			showLevel(res.data);
		}
	})
	.fail(function() {
		console.log("error");
	});
});


function showProg(data){
	$select = $("#prog");

	$select.html('<option value="">Select Program</option>');

	for(let i in data){
		$select.append(`
			<option value="`+data[i].program_id+`">`+data[i].program_name+`</option>
		`);
	}
}


function showLevel(data){
	let div = $("#proData");

	div.html("");

	for(let i in 	data){
		div.append(`
			<tr>
				<td>`+data[i].level_name+`</td>
				<td>`+data[i].program_name+`</td>
				<td><button class="btn btn-warning edit" value="`+data[i].level_id+`">Edit</button>
				<td><button class="btn btn-danger delete" value="`+data[i].level_id+`">Delete</button>
			</tr>
		`);
	}
}