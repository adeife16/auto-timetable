<?php 
	$title = "Feedback";
	require_once 'header.php';
?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Feedback and Complaints</h1>
      </div>
      <div class="row justify-content-center m-3">
      	<div class="col-md-8">
      		<div class="card shadow py-2 h-100">
      			<div class="card-body">
      				<div class="prog-form ">
      					<form class="form">
      						<div class="form-group">
      							<span>Name</span>
      							<input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
      						</div>
      						<div class="form-group">
      							<span>Level</span>
      							<select class="form-control" id="level" required>
      								
      							</select>
      						</div>
      						<div class="form-group">
      							<span>Department</span>
      							<select class="form-control" id="dept" required>
      								
      							</select>
      						</div>
      						<div class="form-group">
      							<span>Message</span>
      							<textarea class="form-control" id="msg" required></textarea>
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

<?php 
	require_once 'footer.php';
?>