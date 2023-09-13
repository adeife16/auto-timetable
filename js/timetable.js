$(document).ready(function() {
	$("#submit").click(function(event) {
		let sem = $("#sem").val();
        if(sem == ""){
            toastr.error("Select a semester")
        }
        else{
            $(".sem").html(sem);
		  generate(sem);
        }
	});
});


function generate(sem){
	$.ajax({
		url: 'backend/api/timetable?generate='+sem,
		type: 'GET',
		dataType: 'json',
	})
	.done(function(res){

        // $("#output").html(res);
        if(res.status == 200){
            console.log(res.data);
            toastr.success("Timetable Generated");
            showTable(res.data)
        }
	})
	.fail(function() {
		console.log("error");
	});
	
}

function showTable(data){
    var tbody = document.getElementById("proData");
    tbody.innerHTML = "";
    for (let i in data) {
        var row = document.createElement("tr");
        row.innerHTML = `
            <td>${data[i].day}</td>
            <td>${data[i].time}</td>
            <td>${data[i].class}</td>
            <td>${data[i].course}</td>
            <td>${data[i].department}</td>
            <td>${data[i].level}</td>
            <td>${data[i].lecturer}</td>
        `;
        tbody.appendChild(row);
    }

    let table = new DataTable('#display');
}

$("#export").click(function() {
    let today = new Date();
    let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    let time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    let dateTime = date+' '+time;
    exportExcel('xlsx', 'Timetable', true, dateTime);
});

function exportExcel(type, fn, dl, dt) {
    var elt = document.getElementById('dataTable');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "timetable" });

    if (dl) {
        var wbout = XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' });
        var dataUrl = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' + wbout;
        var link = document.createElement('a');
        link.href = dataUrl;
        link.download = fn + '_' + dt + '.' + (type || 'xlsx');
        link.click();
    } else {
        XLSX.writeFile(wb, fn + '_' + dt + '.' + (type || 'xlsx'));
    }
}