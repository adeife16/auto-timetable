<?php
	session_start();
	$title = 'View Subjects';
	require_once 'header.php';
	if(!isset($_SESSION['email']) || $_SESSION['email'] == "")
	{
		header('location: index.php');
	}
?>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800">View  all Subjects</h1>
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
        	                	<th> S/N</th>
        	                	<th>Subject Name</th>
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Course?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><span style="color: red;">This action cannot be undone.</span></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" id="delete-confirm" value="">Delete</a>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" action="" method="post" id="course-edit">

                    </form>

                </div>
                <div class="modal-footer" id="edit-form-action">

                </div>
            </div>
        </div>
    </div>
<?php
	require_once 'footer.php';
?>
