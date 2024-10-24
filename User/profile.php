<?php
  session_start();
	require("../require/header.php");

  // Only Login User Can Access It

  if (!isset($_SESSION['user'])) {
    header("location: index.php");
  }

  // Showing Login User Data

  $user_id =  isset($_SESSION['user'])? $_SESSION['user']['user_id']: "";

  $query = "SELECT * FROM user WHERE user_id = '$user_id'";

  $result = mysqli_query($connection, $query);

  if ($result->num_rows) {
    $data = mysqli_fetch_assoc($result);
?>

<section>
  <div class="container py-5">
    <div class="row">
      <?php if(isset($_GET['message'])){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <div>
           <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="message text-center"><?php echo $_GET['message'];?></p>
          </div>
        </div>
      <?php } ?>
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="<?= $data['user_image']?>" class="rounded-circle img-fluid" style="height: 150px; width: 150px;">
            <h5 class="my-3"><?= $data['first_name']." ". $data['last_name']?></h5>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $data['first_name']." ". $data['last_name']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $data['email']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $data['gender']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Date Of Birth</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $data['date_of_birth']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $data['address']?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12 d-flex justify-content-center">
                <a href="edit_profile.php?action=edit&user_id=<?= $user_id?>" class="btn btn-primary">Edit Profile</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
    } else {
      echo "No Records Found!";
    }
  ?>

<?php
	require("../require/footer.php");
?>