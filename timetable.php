<?php 
	$title = "Timetable";
	require_once 'header.php';
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Generate Timetable</h1>
      </div>
      <div class="row justify-content-center m-3">
      	<div class="col-md-8">
      		<div class="card shadow py-2 h-100">
      			<div class="card-body">
      				<div class="prog-form ">
      					<form class="form">
      						<div class="form-group">
      							<span>Semester</span>
      							<select class="form-control" id="sem" required>
      								<option value="">Select Semester</option>
      								<option value="1">First Semester</option>
      								<option value="2">Second Semester</option>
      							</select>
      						</div>
      						<div class="form-group">
      							<button class="btn btn-success " type="button" id="submit">Generate</button>
      						</div>
      					</form>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
      <div class="row justify-content-center m-3">
      	<div class="col-md-12">
          <div class="card shadow h-100 py-2">
          	<div class="card-head p-3">
		        <h4 class="text-success">Generated Timetable For Semester <span class="sem"></span></h4>
	            <button class="btn btn-success float-right" id="export">Export to Excel</button>   
          	</div>
            <div class="card-body">
            	<div id="output" class="table-responsive">
			        <table class="table table-striped" id="dataTable" style="font-size: 12px">
			            <thead>
			            	<tr>
				                <th>Day</th>
				                <th>Time Slot</th>
				                <th>Classroom</th>
				                <th>Course</th>
				                <th>Department</th>
				                <th>Level</th>
				                <th>Lecturer</th>
			            	</tr>
			            </thead>
			            <tbody id="proData">
			            	
			            </tbody>
			        </table>
            	</div>
				<div id="timetableContainer"></div>
				<div id="timetableImageContainer"></div>
              </div>
            </div>
          </div>
      	</div>
      </div>
<?php 
	require_once 'footer.php';
?>