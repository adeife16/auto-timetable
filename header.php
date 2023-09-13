<?php 
	session_start();
  require_once 'config.php';
  if(!isset($_SESSION['user_id']))
  {
    header('Location: index');
  }
	ob_start();
	// include_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="css/material/css/materialdesignicons.min.css"> 
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="css/toastr.css">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: rgb(4 110 32);">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
        <img src="img/logo.png" width="80" height="80" class="pt-2 mt-2 mb-3">
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $web_link. "dashboard";?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">


      <li class="nav-item">
        <a class="nav-link" href="<?php echo $web_link. "programs"; ?>">
          <i class="fas fa-fw fa-graduation-cap"></i>
          <span>Programs</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $web_link. "levels"; ?>">
          <i class="fas fa-fw fa-layer-group"></i>
          <span>Levels</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $web_link. "semesters"; ?>">
          <i class="fas fa-fw fa-clock"></i>
          <span>Semesters</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $web_link. "departments"; ?>">
          <i class="fas fa-fw fa-building"></i>
          <span>Departments</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $web_link. "courses"; ?>">
          <i class="fas fa-fw fa-book"></i>
          <span>Courses</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $web_link. "timetable"; ?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Timetable</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $web_link. "download"; ?>">
          <i class="fas fa-fw fa-download"></i>
          <span>Download Timetable</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
<!--         <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-users"></i>
            <span>Moderators</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Login Screens:</h6>
              <a class="collapse-item" href="login.html">Login</a>
              <a class="collapse-item" href="register.html">Register</a>
              <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Other Pages:</h6>
              <a class="collapse-item" href="404.html">404 Page</a>
              <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
          </div>
        </li> -->



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">




            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name']; ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo $web_link. "profile"; ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo $web_link. "logout"; ?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

            <!-- Begin Page Content -->
      <div class="container-fluid">