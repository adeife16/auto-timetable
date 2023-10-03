<?php 
	$title = "Result";
	require_once 'header.php';
?>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800"> View All Results <span id="courseName"></span></h1>
	</div>
	<div class="row justify-content-center">
		<div class="col-xl-12 col-md-12">
			<div class="card shadow mb-4">
            	<div class="card-header py-3">
                	<h6 class="m-0 font-weight-bold text-primary">All Subjects</h6>
            	</div>
            <div class="card-body">
                <div class="mb-2 ">
                 <button class="btn btn-primary float-right" id="export">Export to Excel</button>       
                </div>
                <div class="table-responsive mt-3 pt-3">
                	 <table class="table" style="font-size: x-small;" id="dataTable" width="100%" cellspacing="0">
                        <thead>
        	                <tr>
        	                	<th>Registeration No</th>
        	                	<th>Full Name</th>
        	                	<th>Mathematics</th>
        	                	<th>English Language</th>
        	                	<th>General Science</th>
        	                	<th>Current Affairs</th>
        	                	<th>Mark Obtainable</th>
                                <th>Mark Obtained</th>
                                <th>Average</th>
                                <th>Examination Date</th>
                                <th>Remark</th>
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