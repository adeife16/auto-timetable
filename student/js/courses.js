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

	// lectureres
	$.ajax({
		url: 'backend/api/lecturer?getall',
		type: 'GET',
		dataType: 'json',
		
	})
	.done(function(res){
		if(res.status == 200){
			$("#lect").html('<option value="">Select Lecturer</option>');
			for(let i in res.data){
				$("#lect").append(`
					<option value="`+res.data[i].lecturer_id+`">`+res.data[i].lecturer_name+`</option>
				`);
			}
		}
	})
	.fail(function() {
		console.log("error");
	});
	

	// Courses
	getCourses();
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

$("#level").change(function(event) {
	let level = $(this).val();
	let prog = $("#prog").val();

		getDept(level, prog);

});

function getDept(level, prog){
	$.ajax({
		url: 'backend/api/department?getdept='+level+'&prog='+prog,
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
	let div = $("#dept");

	div.html('<option value="">Select Department</option>');

	for(let i in data){
		div.append(`
			<option value=`+data[i].department_id+`>`+data[i].department_name+`</option>
		`);
	}
}

$("#submit").click(function(event) {
	let level = $("#level").val();
	let dept = $("#dept").val();
	let sem = $("#sem").val();
	let lect = $("#lect").val();
	let code = $("#ccode").val();
	let ctitle = $("#ctitle").val();

	let data = {
		level: level,
		dept: dept,
		sem: sem,
		lect: lect,
		code: code,
		title: ctitle
	};

	save(data);
});


function save(data){
	$.ajax({
		url: 'backend/api/course',
		type: 'POST',
		dataType: 'json',
		data: {save: data},
	})
	.done(function(res){
		if(res == 200){
			toastr.success("Course Created");
			getCourses();
		}
	})
	.fail(function() {
		console.log("error");
	});
}

function getCourses() {
	$.ajax({
		url: 'backend/api/course?getall',
		type: 'GET',
		dataType: 'json',
		
	})
	.done(function(res) {
		if(res.status == 200){
			showCourses(res.data);
		}
	})
	.fail(function() {
		console.log("error");
	});
	
}

function showCourses(data){
	$("#proData").html('');

	for(let i in data){
		$("#proData").append(`
			<tr>
				<td>`+data[i].course_code+`</td>
				<td>`+data[i].course_name+`</td>
				<td>`+data[i].department_name+`</td>
				<td>`+data[i].level_name+`</td>
				<td>`+data[i].semester_name+`</td>
				<td>`+data[i].lecturer_name+`</td>
				<td>
					<button class="btn btn-danger delete" value="`+data[i].course_id+`">Delete</button>
				</td>

			</tr>
		`);
	}

}

setTimeout(function() {
	let table = new DataTable('#display');
}, 3000);

$(document).on('click', '.delete', function(event) {
	event.preventDefault();
	id = $(this).val();
	$.ajax({
		url: 'backend/api/course',
		type: 'POST',
		dataType: 'json',
		data: {delete: id},
	})
	.done(function(res){
		if(res == 200){
			toastr.success('Course Deleted');
			getCourses();
		}
	})
	.fail(function() {
		console.log("error");
	});
	
});