<?php 
	$title = "main";
	require_once 'header.php';
	if(!isset($_SESSION['reg']))
	{
		header('location: index.php');
	}
?>
<div class="row justify-content-center mt-5">
	<div class="col-md-8 col-sm-12">
		<div class="card  o-hidden border-0 shadow-lg">	
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-8">
						<h1 class="text-danger text-center">INSTRUCTIONS</h1>
						<p>
							<ol>
								<li>
									Ensure that your computer and internet connection are functioning properly.
								</li>
								<li>
									Do not logout if you're not through with the exam
								</li>
								<li>
									Attempt all questions.
								</li>
								<li>
									The system automatically submits when the time runs out
								</li>
								<li>
									Do not reload the page
								</li>
								<li>
									Only move to the next subject after you're through with the current one
								</li>
							</ol>
						</p>
						<div class="text-center">
							<button class="btn btn-success text-white" type="button" id="initExam">START</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	require_once 'footer.php';
?>