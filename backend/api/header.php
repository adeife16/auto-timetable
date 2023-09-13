<?php
  session_start();
  if(!isset($_SESSION['name']))
  {
    header('location: index.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title><?php echo $title; ?></title>
</head>
<body style="overflow-x: hidden;">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="images/logo.png" class="img-profile" style="width: 100px; height: 100px;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Welcome <?php echo $_SESSION['name']; ?></a>
      </li>
<!--       <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li> -->
    </ul>
        <a class="btn btn-success text-white  float-right" href="logout.php">Logout<span class="sr-only"></span></a>
    </form>
  </div>
</nav>