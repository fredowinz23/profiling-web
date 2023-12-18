<!-- https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/index.html -->
<?php
session_start();
include_once($ROOT_DIR . "config/database.php");
include_once($ROOT_DIR . "config/Models.php");

if (isset($_SESSION["user_session"])) {

  $user = $_SESSION["user_session"];
  $username = $user["username"];
  $account = account()->get("username='$username'");
  $role = $account->role;

  $success = get_query_string("success", "");
  $error = get_query_string("error", "");
}
else{
  header("Location: ../auth/login.php");
}

?>

<style media="screen">
  #sidebar{
    background: #e00b4e !important;
  }
  .btn-primary{
    background: #e00b4e !important;
  }
  .btn-primary:hover{
    background: red !important;
  }
</style>


<html lang="en">
  <head>
  	<title>Profiling</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=$ROOT_DIR;?>templates/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>

		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
        <img src="../templates/images/admin-logo.png" alt="" width="80%" style="margin:20px;">
      </center>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="index.php"><span class="fa fa-home"></span> Home</a>
          </li>
          <?php if ($role=="Admin"): ?>
            <li>
                <a href="accounts.php"><span class="fa fa-user"></span> Accounts</a>
            </li>
            <li>
                <a href="strands.php"><span class="fa fa-user"></span> Strands</a>
            </li>
            <li>
                <a href="my-records.php"><span class="fa fa-user"></span> Records</a>
            </li>
            <li>
                <a href="subjects.php"><span class="fa fa-user"></span> Subjects</a>
            </li>
            <li>
                <a href="classes.php"><span class="fa fa-user"></span> Classes</a>
            </li>
            <li>
                <a href="faculty-list.php"><span class="fa fa-user"></span>Faculty List</a>
            </li>
          <?php endif; ?>

          <?php if ($role=="Staff"): ?>
            <li>
                <a href="strands.php"><span class="fa fa-user"></span> Strands</a>
            </li>
            <li>
                <a href="subjects.php"><span class="fa fa-user"></span> Subjects</a>
            </li>
            <li>
                <a href="classes.php"><span class="fa fa-user"></span> Classes</a>
            </li>
            <li>
                <a href="teacher-attendance.php"><span class="fa fa-user"></span> Teacher Attendance</a>
            </li>
            <li>
                <a href="faculty-list.php"><span class="fa fa-user"></span>Faculty List</a>
            </li>
          <?php endif; ?>

          <?php if ($role=="Faculty"): ?>
            <li>
                <a href="my-classes.php"><span class="fa fa-user"></span>My Classes</a>
            </li>
              <li>
                  <a href="my-attendance.php"><span class="fa fa-user"></span>My Attendance</a>
              </li>
              <li>
                  <a href="my-records.php"><span class="fa fa-user"></span>Records</a>
                  <!-- Upload lesson plans -->
              </li>
              <li>
                  <a href="my-profile.php"><span class="fa fa-user"></span>My Profile</a>
              </li>
          <?php endif; ?>
          <li>
            <a href="../auth/process.php?action=user-logout"><span class="fa fa-sticky-note"></span> Logout</a>
          </li>
        </ul>

        <div class="footer">
        	<p>
					  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved </a>
					</p>
        </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><?=$account->firstName;?> <?=$account->lastName;?> (<?=$account->role?>)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../auth/process.php?action=user-logout">Log out</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
