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
});

function showProg(data){
	let div = $("#proData");
	
	div.html('');
	for(let i in data){
		$("#proData").append(`
			<tr>
				<td>`+data[i].program_name+`</td>
				<td><button class="btn btn-warning edit" value="`+data[i].program_id+`">Edit</button>
				<td><button class="btn btn-danger delete" value="`+data[i].program_id+`">Delete</button>
			</tr>
		`);
	}
}
