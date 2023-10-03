<?php 
	session_start();
	$title = "Section";
	require_once 'header.php';
	if(!isset($_SESSION['email']) || $_SESSION['email'] == "")
	{
		header('location: index.php');
	}
?>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800">Create Sections</h1>
	</div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">All Subject</h6>
                </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select class="form-control" id="subject">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" id="create-section">Create Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

	<div class="row justify-content-center">
		<div class="col-xl-8 col-md-8">
			<div class="card shadow mb-4">
            	<div class="card-header py-3">
                	<h6 class="m-0 font-weight-bold text-primary">All Sections</h6>
            	</div>
            <div class="card-body">
                <div class="table-responsive">
                	 <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
        	                <tr>
        	                	<th> S/N</th>
        	                	<th>Subject Name</th>
                                <th>Section</th>
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