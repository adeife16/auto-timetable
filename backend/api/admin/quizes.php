<?php 
	session_start();
	$title = "Quizes";
	require_once 'header.php';
	if(!isset($_SESSION['email']) || $_SESSION['email'] == "")
	{
	  header('location: index.php');
	}
?>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
    	<h1 class="h3 mb-0 text-gray-800">Quizes <span id="topicName"></span></h1>
	</div>

<div class="row justify-content-center">
  <div class="col-xl-8 col-md-8">
    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Quizes</h6>
            </div>
          <div class="card-body">
              <div class="table-responsive">
              	<table class="table table-striped">
                  <tr>
                    <thead>
                      <td>SN</td>
                      <td>Course Code</td>
                      <td>Course Title</td>
                      <td>Topic</td>
                      <td>Action</td>
                    </thead>
                  </tr>
                  <tbody id="quizTable">
                    
                  </tbody>
                </table>
              <div id="action">
              	<button class="btn btn-success" id="create-quiz" data-toggle="modal" data-target="#addModal">Create Quiz</button>
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
                  <h5 class="modal-title" id="exampleModalLabel">Delete Quiz?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body"><span style="color: red;">Quiz will be deleted.This action cannot be undone.</span></div>
              <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <button class="btn btn-danger" id="delete-confirm" value="">Delete</a></button>
              </div>
          </div>
      </div>
  </div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create a Quiz</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body">
              	<form class="form" id="create-quiz-form" method="post" action="">
              		<div class="form-group">
              			<span for="course">Course</span>
              			<select class="form-control" id="course" name="course">
              				
              			</select>
              		</div>
              		<div class="form-group">
              			<span for="topic">Topic</span>
              			<select class="form-control" id="topic" name="topic">
              				<option value="">Select Topic</option>
              			</select>
              		</div>
              		<div class="form-group">
              			<button type="button" class="btn btn-success" id="submit">Submit</button>
              		</div>
              	</form>
              </div>
          </div>
      </div>
  </div>



<?php 
	require_once 'footer.php';
?>