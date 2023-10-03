$(document).ready(function() {
	$("#cmd").hide();
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
	let level = $("#level").val();
	let dept = $("#dept").val();
	let sem = $("#sem").val();

	if(level == "" || dept == "" || sem == ""){
		toastr.error("All fields are required");
	}
	else{
		let data = {
			level: level,
			dept: dept,
			sem: sem,
		};

		download(data);
	}
});



function download(data){
	$.ajax({
		url: 'backend/api/timetable',
		type: 'POST',
		dataType: 'json',
		data: {
			download: data
		}
	})
	.done(function(res){
		if(res.status == 200){
			toastr.success("Success");
			var scheduleData = res.data;
			console.log(scheduleData);
	        // Function to populate the timetable
	        function populateTimetable() {
	        	let dept = scheduleData[0].department;
	        	let level = scheduleData[0].level;
	        	let sem = scheduleData[0].semester;
	        	$(".title").html("Timetable for "+dept+" "+level+" Semester "+sem);
	            for (var i = 0; i < scheduleData.length; i++) {
	                var schedule = scheduleData[i];
	                var dayCellIndex = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'].indexOf(schedule.day);
	                var timeCellIndex = ['8:00 AM - 10:00 AM', '10:00 AM - 12:00 PM', '12:00 PM - 2:00 PM', '2:00 PM - 4:00 PM', '4:00 PM - 6:00 PM'].indexOf(schedule.time);
	                
	                if (dayCellIndex !== -1 && timeCellIndex !== -1) {
	                    var cell = $('tr').eq(timeCellIndex + 1).find('td').eq(dayCellIndex + 1);
	                    // Append course and class information to the cell
	                    cell.html(schedule.course + '<br>' + schedule.class);
	                }
	            }
	        }
	        // Call the function to populate the timetable
	        populateTimetable();
	        $("#cmd").show();
		}
	})
	.fail(function() {
		console.log("error");
	});
}



document.addEventListener('DOMContentLoaded', function() {
    var convertToImageBtn = document.getElementById('cmd');
    var downloadImageLink = document.getElementById('downloadImageLink');
    var elementToCapture = document.querySelector('#display');

    convertToImageBtn.addEventListener('click', function() {
        // Use html2canvas to capture the HTML element as an image
        html2canvas(elementToCapture).then(function(canvas) {
            // Convert the captured canvas to a data URL
            var imgData = canvas.toDataURL('image/png');

            // Set the data URL as the source of the download link
            downloadImageLink.href = imgData;

            // Specify the filename for the downloaded image
            downloadImageLink.download = 'timetable.png';

            // Display the download link
            downloadImageLink.click();
        });
    });
});