$(document).ready(function() {
	$.ajax({
		url: 'backend/api/semester?getall',
		type: 'GET',
		dataType: 'json'
	})
	.done(function(res) {
		if(res.status == 200){
			showSem(res.data)
		}
	})
	.fail(function() {
		console.log("error");
	});
	
});


function showSem(data){
	let div = $("#proData");

	div.html("");

	for(let i in 	data){
		div.append(`
			<tr>
				<td>`+data[i].semester_name+`</td>
				<td><button class="btn btn-danger delete" value="`+data[i].semester_id+`">Delete</button></td>
			</tr>
		`);
	}
}