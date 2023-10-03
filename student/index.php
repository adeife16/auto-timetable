<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="" style="background: #26901b;">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-8">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <div class="col-lg-9 text-center pt-3">
              	<img src="img/logo.png" width="200" height="200">
              </div>
              <div class="col-lg-6">
                <div class="p-3">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Student Login</h1>
                  </div>
                  <p class="text-danger text-center alert"></p>
                  <form class="user form" id="login-form" action="" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="matric" aria-describedby="emailHelp" name="matric" placeholder="Enter Matric No">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="pass" name="pass" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="button" id="login" class="btn btn-success btn-user btn-block">
                      Login
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script type="text/javascript">
  	$(document).ready(function() {
  		$("#login").click(function(event) {
  			event.preventDefault();

			let formdata = new FormData(document.getElementById("login-form"));

  			$.ajax({
  				url: 'backend/api/login',
  				type: 'POST',
  				dataType: 'json',
  				data: formdata,
		 		contentType: false,
				processData: false
  			})
  			.done(function(res){
  				if(res.status == 200){
  					setTimeout(function() {
  						window.location.replace("timetable.php");
  					}, 1000);
  				}
  				else{
  					$(".alert").html("Invalid Email or Password");
  				}
  			})
  			.fail(function() {
  				console.log("error");
  			})
  			
  		});
  	});
  </script>	

</body>

</html>