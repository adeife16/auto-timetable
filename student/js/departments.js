$(document).ready(function() {
	getProg()
	getDept()
});

function getProg() {
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
}
function showProg(data){
	$select = $("#prog");

	$select.html('<option value="">Select Program</option>');

	for(let i in data){
		$select.append(`
			<option value="`+data[i].program_id+`">`+data[i].program_name+`</option>
		`);
	}
}

$("#prog").change(function(event) {
	let id = $(this).val();

	$.ajax({
		url: 'backend/api/level?getlevel='+id,
		type: 'GET',
		dataType: 'json'
	})
	.done(function(res) {
		showLevel(res.data);
	})
	.fail(function() {
		console.log("error");
	});
	
});

function showLevel(data){
	$("#level").html('<option value="">Select a Level</option>')
	for(let i in data){
		$("#level").append(`
			<option value="`+data[i].level_id+`">`+data[i].level_name+`</option>
		`);
	}
}

$("#submit").click(function(event) {
	let prog = $("#prog").val();
	let level = $("#level").val();
	let dept = $("#dept").val();

	if(prog != "" || level != "" || dept != ""){
		save(prog, level, dept);
	}
	else{
		toastr.error("Fill all form fields");
	}
});


function save(prog, level, dept){
	$.ajax({
		url: 'backend/api/department',
		type: 'POST',
		dataType: 'json',
		data: {
			prog: prog,
			level: level,
			dept: dept
		},
	})
	.done(function(res) {
		if(res == 200){
			toastr.success("Department Created");
			getDept();
		}
	})
	.fail(function() {
		console.log("error");
	});
	
}

function getDept(){
	$.ajax({
		url: 'backend/api/department?getall',
		type: 'GET',
		dataType: 'json',
		
	})
	.done(function(res){
		if(res.status == 200){
			showDept(res.data);
		}
	})
	.fail(function() {
		console.log("error");
	});
}


function showDept(data){
	let div = $("#proData");

	div.html("");

	for(let i in data){
		div.append(`
			<tr>
				<td>`+data[i].department_name+`</td>
				<td>`+data[i].program_name+`</td>
				<td>`+data[i].level_name+`</td>
				<td><button class="btn btn-warning edit" value="`+data[i].department_id+`">Edit</button>
				<td><button class="btn btn-danger delete" value="`+data[i].department_id+`">Delete</button>
			</tr>
		`);
	}
}