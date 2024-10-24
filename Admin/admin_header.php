<?php
	session_start();
	require("../require/database_connection.php");

	// Session Maintainance Only Admin Can Access It
	
	  if(!isset($_SESSION['user']['first_name']) && $_SESSION['user']['role_id'] != 1) {
	        header('Location: ../User/login.php?message=Please Login First!&success=alert-warning');
	    }elseif (isset($_SESSION['user']['first_name']) && $_SESSION['user']['role_id'] == 2) {
        	header('Location: ../User/index.php');
    } elseif (isset($_SESSION['user']) && (isset($_SESSION['user']['role_id'])) && $_SESSION['user']['role_id'] ==1) { 
                $user_name = $_SESSION['user']['first_name'] . " " .  $_SESSION['user']['last_name']; 
                $user_image = $_SESSION['user']['user_image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sports Blogging</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
 	<script type="text/javascript" src="jquery.min.js" ></script>
	<link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<script type="text/javascript" src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</head>
<body>
				<nav class="navbar navbar-expand-lg sticky-top bg-dark py-3 navbar-dark flex-md-nowrap">
				    <div class="container-fluid px-4">
				        <a class="navbar-brand text-light" href="../User/index.php">Sports Blogging</a> 
				        
				        <div class="dropdown ms-auto ms-sm-auto pt-2 d-flex align-items-center">
				            <a href="#" class=" text-light text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
				                <img src="<?= $user_image; ?>" class="rounded-circle img-fluid me-2" style="height: 50px; width: 50px;">
              					<small><?= $user_name; ?></small>
				            </a>
				            <ul class="dropdown-menu dropdown-menu-end">
				            	<li><a class="dropdown-item" href="index.php">Dashboard</a></li>
				                <li><a class="dropdown-item" href="../User/profile.php">Profile</a></li>
				                <li><a class="dropdown-item" href="../User/change_password.php">Change Password</a></li>
				                <li><hr class="dropdown-divider"></li>
				                <li><a class="dropdown-item" href="../User/logout.php">Logout</a></li>
				            </ul>
				        </div>
		
				    </div>
				</nav>
<?php }
?>