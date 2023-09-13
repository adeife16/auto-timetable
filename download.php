<?php 
	$title = "Download";
	require_once 'header.php';
?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table, th, td {
        border: 1px solid black;
        font-size: 8px;
        text-align: center !important;
        color: black;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }
</style>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Download Timetable</h1>
      </div>
      <div class="row justify-content-center m-3">
      	<div class="col-md-8">
      		<div class="card shadow py-2 h-100">
      			<div class="card-body">
      				<div class="prog-form ">
      					<form class="form">
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
      							<button class="btn btn-success " type="button" id="submit">Submit</button>
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
          	<div class="card-head p-2">
          		<a id="downloadImageLink" style="display: none;">Download Image</a>
          		<button id="cmd" class="btn btn-success float-right" type="button"><i class="fas fa-fw fa-download"></i>Download</button>
          	</div>
            <div class="card-body" id="display">
            	<h4 class="title"></h4>
						 <table>
				        <thead>
				            <tr>
				                <th>Time</th>
				                <th>Monday</th>
				                <th>Tuesday</th>
				                <th>Wednesday</th>
				                <th>Thursday</th>
				                <th>Friday</th>
				            </tr>
				        </thead>
				        <tbody>
				            <!-- Create rows for each time slot -->
				            <tr>
				                <td>8:00 AM</td>
				                <td></td> <!-- Monday 8:00 AM - 10:00 AM -->
				                <td></td> <!-- Tuesday 8:00 AM - 10:00 AM -->
				                <td></td> <!-- Wednesday 8:00 AM - 10:00 AM -->
				                <td></td> <!-- Thursday 8:00 AM - 10:00 AM -->
				                <td></td> <!-- Friday 8:00 AM - 10:00 AM -->
				            </tr>
				            <tr>
				                <td>10:00 AM</td>
				                <td></td> <!-- Monday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Tuesday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Wednesday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Thursday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Friday 10:00 AM - 12:00 PM -->
				            </tr>
				            <tr>
				                <td>12:00 PM</td>
				                <td></td> <!-- Monday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Tuesday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Wednesday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Thursday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Friday 10:00 AM - 12:00 PM -->
				            </tr>
				            <tr>
				                <td>2:00 PM</td>
				                <td></td> <!-- Monday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Tuesday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Wednesday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Thursday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Friday 10:00 AM - 12:00 PM -->
				            </tr>
				            <tr>
				                <td>4:00 PM</td>
				                <td></td> <!-- Monday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Tuesday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Wednesday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Thursday 10:00 AM - 12:00 PM -->
				                <td></td> <!-- Friday 10:00 AM - 12:00 PM -->
				            </tr>
				        </tbody>
						 </table>
              </div>
            </div>
          </div>
      	</div>
      </div>

<?php 
	require_once 'footer.php';
?>