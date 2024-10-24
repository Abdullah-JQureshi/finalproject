<?php
	// Database Will Be In Header So We Don't Have To Require It EveryWhere

	require("database_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sports Blogging</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<script type="text/javascript" src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="style.css">
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script type="text/javascript" src="client_side_validation.js"></script>
</head>
<body>

	<!-- Navbar For Those Who Are Not Registered -->

	<?php
	if (!isset($_SESSION['user']) && (!isset($_SESSION['user']['role_id']))) { 
?>
				<nav class="navbar navbar-expand-lg sticky-top bg-dark py-3">
				  	<div class="container-fluid">
				    	<a class="navbar-brand text-light" href="index.php">Sports Blogging</a>
				    		<button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				      			<span class="navbar-toggler-icon text-light"></span>
				    		</button>
				    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
				      		<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
					        	<li class="nav-item px-3">
					          		<a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
					        	</li>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="Categories.php">Categories</a>
					        	</li>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="posts.php">All Posts</a>
					        	</li>

					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="blog.php">Blogs</a>
					        	</li>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="about.php">About</a>
					        	</li>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="feedback.php">Feedback</a>
					        	</li>
				      		</ul>
						      	<a href="login.php" class="btn btn-outline-light">Login</a> &nbsp;&nbsp;
						      	<a href="register.php" class="btn btn-outline-light">Signup</a>
				    </div>
				  </div>
				</nav>

				<!-- Navbar For Login Users -->

<?php } elseif (isset($_SESSION['user']) && (isset($_SESSION['user']['role_id']))) { 
                $user_name = $_SESSION['user']['first_name'] . " " .  $_SESSION['user']['last_name']; 
                $user_image = $_SESSION['user']['user_image'];
  ?>

  				<nav class="navbar navbar-expand-lg sticky-top bg-dark py-3">
				  	<div class="container-fluid">
				    	<a class="navbar-brand text-light" href="index.php">Sports Blogging</a>
				    		<button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				      			<span class="navbar-toggler-icon text-light"></span>
				    		</button>
				    	<div class="collapse navbar-collapse" id="navbarSupportedContent">
				      		<ul class="navbar-nav mx-auto mb-2 mb-lg-0">
					        	<li class="nav-item px-3">
					          		<a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
					        	</li>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="Categories.php">Categories</a>
					        	</li>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="posts.php">All Posts</a>
					        	</li>

					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="blog.php">Blogs</a>
					        	</li>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="about.php">About</a>
					        	</li>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="feedback.php">Feedback</a>
					        	</li>
					        	
					        	<!-- Following Blog For Only Login User Not For Admin -->

					        	<?php if ( $_SESSION['user']['role_id'] == 2) {	
								            ?>
					        	<li class="nav-item px-3">
					          		<a class="nav-link text-light" href="following_blogs.php">Following Blogs</a>
					        	</li>
					        	<?php
								        }?>
				      		</ul>
								      	<a class="nav-link dropdown-toggle text-light float-end" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								            <img src="<?= $user_image; ?>" class="rounded-circle img-fluid me-2" style="height: 50px; width: 50px;">
              								<small><?= $user_name; ?></small>
								          </a>
								          <ul class="dropdown-menu dropdown-menu-end">
								          	<?php if ( $_SESSION['user']['role_id'] == 1) {	
								            ?>
								            <li><a class="dropdown-item" href="../admin/index.php">Dashboard</a></li>
								            <?php
								        }?>
								            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
								            <li><a class="dropdown-item" href="change_password.php">Change Password</a></li>
								            <li><hr class="dropdown-divider"></li>
								            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
								          </ul>
				    </div>
				  </div>
				</nav>

				<?php } ?>

