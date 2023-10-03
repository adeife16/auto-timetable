<?php 
	$title = "Students";
	require_once 'header.php';
?>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800"> View All Students <span id="courseName"></span></h1>
	</div>
	<div class="row justify-content-center">
		<div class="col-xl-8 col-md-8">
			<div class="card shadow mb-4">
            	<div class="card-header py-3">
                	<h6 class="m-0 font-weight-bold text-primary">All Subjects</h6>
            	</div>
            <div class="card-body">
                <div class="table-responsive">
                	 <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
        	                <tr>
        	                	<th>Registeration No</th>
        	                	<th>First Name</th>
        	                	<th>Last Name</th>
        	                	<th>Action</th>
        	                </tr>
        	            </thead>
        	            <tbody id="display">

        	            </tbody>
        	        </table>
                </div>
            </div>
        </div>
	</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form" action="" method="post" id="stud-edit">
 						<div class="form-group">
							<label for="regno">Registeration Number</label>
							<input type="text" name="regno" class="form-control" id="regno" disabled>
						</div>
						<div class="form-group">
							<label for="fname">First Name</label>
							<input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
						</div>
						<div class="form-group">
							<label for="lname">Last Name</label>
							<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name">
						</div>
						<div class="form-group">
							<button class="btn btn-primary" id="update">Update</button>
						</div>
                </form>

            </div>
            <div class="modal-footer" id="edit-form-action">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Student Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            	<h5 class="text-danger">This action is irreversible!</h5>
            </div>
            <div class="modal-footer" id="edit-form-action">
            	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            	<button class="btn btn-danger" id="delete-confirm">Confirm Delete</button>
            </div>
        </div>
    </div>
</div>


<?php 
	require_once 'footer.php';
?>