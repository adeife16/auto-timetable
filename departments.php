<?php 
	$title = "Departments";
	require_once 'header.php';
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Departments</h1>
      </div>
      <div class="row justify-content-center m-3">
      	<div class="col-md-8">
      		<div class="card shadow py-2 h-100">
      			<div class="card-body">
      				<div class="prog-form ">
      					<form class="form">
      						<div class="form-group">
      							<span>Program</span>
      							<select class="form-control" id="prog">
      								
      							</select>
      						</div>
      						<div class="form-group">
      							<span>Level</span>
      							<select class="form-control" id="level">

      							</select>
      						</div>
      						<div class="form-group">
      							<span>Department Name</span>
      							<input type="text" class="form-control" name="dept" id="dept" placeholder="Ex. Computer Engineering" required>
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
      	<div class="col-md-8">
          <div class="card shadow h-100 py-2">
            <div class="card-body">
            	<div class="table-responsive">
            		<table class="table">
	            		<thead>
	            			<tr>
	            				<th>Department</th>
	            				<th>Program</th>
	            				<th>Level</th>
	            				<th>Action</th>
	            			</tr>
	            		</thead>
	            		<tbody id="proData">
	            			<tr align="center">
	            				<td colspan='5' class="text-danger">No Program available</td>
	            			</tr>
	            		</tbody>
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