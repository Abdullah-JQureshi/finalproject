<?php
	  session_start();
	require("../require/header.php");

	// If User Not Login It will Redirect It To Main PAge

	if (!isset($_SESSION['user'])) {
		header("location: index.php");
	}

	$user_id =  isset($_SESSION['user'])? $_SESSION['user']['user_id']: "";

	// Changing Password

	if (isset($_POST['change_password'])) {
		
		extract($_POST);

		// Selecting User Record Where User ID Match With Current Login User ID

		$query = "SELECT * FROM user WHERE user_id = '$user_id'";
		$result = mysqli_query($connection, $query);

		if($result->num_rows){
			$data = mysqli_fetch_assoc($result);

			// After Resulting True It Will Check If Current Password Equal To User Current Password 

			if ($data['password'] == $current_password) {

				// Then It Will Check If New Password Equal To User Repeat Password Then Update Password
				
				if ($new_password == $repeat_password) {
					$query = "UPDATE user SET password = '$new_password' WHERE user_id = '$user_id'";
					$result = mysqli_query($connection, $query);

					if ($result) {
						header("location: change_password.php?message=Password Changed Successfully!&success=alert-success");
					}
				}else{
					header("location: change_password.php?message=New Password And Repeat Password Didn't Match!&success=alert-warning");
				}				
			}else{
				header("location: change_password.php?message=Current Password Didn't Match!&success=alert-warning");
			}
		}else{
			echo "User Not Found!";
		}
	}
?>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4 ">
				<div class="card login-form mt-5 align-items-center">
					<div class="card-body">
						<h3 class="card-title text-center mb-3">Change password</h3>
						<?php 
	                        if(isset($_GET['message']) && isset($_GET['success'])){ ?>
	                        <div class="alert <?php echo $_GET['success'];?> alert-dismissible fade show" role="alert">
	                            <div>
	                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	                                <p class="message text-center"><?php echo $_GET['message'];?></p>
	                            </div>
	                        </div>
	                	<?php } ?>
						<div class="card-text">
							<form action="#" method="POST">
								<input type="hidden" name="user_id" value="<?= $user_id?>">
								<div class="form-group mb-3">
									<label for="exampleInputEmail1" class="mb-1">Current password</label>
									<input type="password" name="current_password" class="form-control form-control-sm" required>
								</div>
								<div class="form-group mb-3" class="mb-1">
									<label for="exampleInputEmail1">New password</label>
									<input type="password" name="new_password" class="form-control form-control-sm" required>
								</div>
								<div class="form-group mb-4" class="mb-1">
									<label for="exampleInputEmail1">Repeat password</label>
									<input type="password" name="repeat_password" class="form-control form-control-sm" required>
								</div>
								<div class="d-grid gap-2">
									<input type="submit" name="change_password" value="Confirm" class="btn btn-primary btn-block submit-btn mb-3">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>

<?php
	require("../require/footer.php");
?>