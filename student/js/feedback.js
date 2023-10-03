$(document).ready(function() {
	$.ajax({
		url: 'backend/api/level?getall',
		type: 'GET',
		dataType: 'json'
	})
	.done(function(res) {
		showLevel(res.data);
	})
	.fail(function() {
		console.log("error");
	});

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
});


function showLevel(data){
	$("#level").html('<option value="">Select a Level</option>')
	for(let i in data){
		$("#level").append(`
			<option value="`+data[i].level_name+`">`+data[i].level_name+`</option>
		`);
	}
}

function showDept(data){
    let div = $("#dept");

    div.html('<option value="">Select Department</option>');

    var uniqueArray = [];

    for (var i = 0; i < data.length; i++) {
        var currentItem = data[i];
        var isDuplicate = false;

        for (var j = 0; j < uniqueArray.length; j++) {
            if (uniqueArray[j].department_name === currentItem.department_name) {
                isDuplicate = true;
                break;
            }
        }

        if (!isDuplicate) {
            uniqueArray.push(currentItem);
        }
    }

    for (var i = 0; i < uniqueArray.length; i++) {
        div.append('<option value="' + uniqueArray[i].department_name + '">' + uniqueArray[i].department_name + '</option>');
    }
}


$("#submit").click(function(event) {
	let name = $("#name").val();
	let level = $("#level").val();
	let dept = $("#dept").val();
	let msg = $("#msg").val();

	if(level == "" || dept == "" || msg == "" || name == ""){
		toastr.error("All fields are required");
	}
	else{
		let data = {
			name: name,
			level: level,
			dept: dept,
			msg: msg,
		};

		feedback(data);
	}
});

function feedback(data){
	$.ajax({
		url: 'backend/api/feedback',
		type: 'POST',
		dataType: 'json',
		data: {
			feedback: data
		}
	})
	.done(function(res){
		if(res == 200){
			toastr.success("Feedback Submitted!");
			setTimeout(function() {
				window.location.reload();
			}, 1000);
		}
	})
	.fail(function() {
		console.log("error");
	});
}