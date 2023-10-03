<?php 
	$title = "Courses";
	require_once 'header.php';
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Courses</h1>
      </div>
      <div class="row justify-content-center m-3">
      	<div class="col-md-8 col-sm-12">
      		<div class="card shadow py-2 h-100">
      			<div class="card-body">
      				<div class="prog-form ">
      					<form class="form">
      						<div class="form-group">
      							<span>Program</span>
      							<select class="form-control" id="prog" required>
      								
      							</select>
      						</div>
      						<div class="form-group">
      							<span>Level</span>
      							<select class="form-control" id="level" required>

      							</select>
      						</div>
      						<div class="form-group">
      							<span>Department Name</span>
      							<select class="form-control" id="dept" required>
      								
      							</select>
      						</div>
      						<div class="form-group">
      							<span>Semester</span>
      							<select class="form-control" id="sem" required>
      								<option value="">Select Semester</option>
      								<option value="1">First Semester</option>
      								<option value="2">Second Semester</option>
      							</select>
      						</div>
      						<div class="form-group">
      							<span>Lecturer</span>
      							<select class="form-control" id="lect">
      								
      							</select>
      						</div>
      						<div class="form-group">
      							<span>Course Code</span>
      							<input type="text" name="ccode" id="ccode" class="form-control" placeholder="Ex. CTE 415" required>
      						</div>
      						<div class="form-group">
      							<span>Course Title</span>
      							<input type="text" name="ctitle" id="ctitle" class="form-control" placeholder="Ex. Circuit Theory" required>
      						</div>
      						<div class="form-group">
      							<button class="btn btn-success " type="button" id="submit">Submit</button>
      						</div>
      					</form>
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
      <div class="row justify-content-center m-3">
      	<div class="col-md-12 col-sm-12">
          <div class="card shadow h-100 py-2">
            <div class="card-body">
            	<div class="table-responsive">
            		<table class="table" id="display">
	            		<thead>
	            			<tr>
	            				<th>Course Code</th>
	            				<th>Course Title</th>
	            				<th>Department</th>
	            				<th>Level</th>
	            				<th>Semester</th>
	            				<th>Lecturer</th>
	            				<th>Action</th>
	            			</tr>
	            		</thead>
	            		<tbody id="proData">
	            			<tr align="center">
	            				<td colspan='5' class="text-danger">No Program available</td>
	            			</tr>
	            		</tbody>
	            		<tfoot>
            				<tr>
	            				<th>Course Code</th>
	            				<th>Course Title</th>
	            				<th>Department</th>
	            				<th>Level</th>
	            				<th>Semester</th>
	            				<th>Lecturer</th>
	            				<th>Action</th>
	            			</tr>
	            		</tfoot>
            		</table>
            	</div>
              </div>
            </div>
          </div>
      	</div>
      </div>

<?php 
	require_once 'footer.php';
?>