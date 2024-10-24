<?php

  // If Session Not Set It Will Not Show That Page And You Can't Direct Access That Page

  session_start();
  if (!isset($_GET['user_id'])) {
    header("location: index.php");
  } else {

    require("../require/header.php");

    if (!isset($_SESSION['user'])) {
      header("location: index.php");
    }

    if (isset($_POST['update_profile'])) {

      // Updating Profile 

      $dir = "../User_Image";
      if(!is_dir($dir)){
        if(!mkdir($dir)){
          echo "Could Not Create Directory!!";
        }
      }

      extract($_POST);
      $tmp_name = $_FILES["user_image"]["tmp_name"];
      $user_image = time()."_".$_FILES["user_image"]["name"];
      $path = $dir."/".$user_image;

      if(!empty($tmp_name)){

        // If User Want To Change Profile Than It Will Work

        if(move_uploaded_file($tmp_name,$path)){
          $query = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', gender = '$gender', date_of_birth = '$date_of_birth', user_image = '$path', address = '$address', updated_at = NOW() WHERE user_id = '$user_id' ";

          if($result = mysqli_query($connection, $query)){
            header("Location: profile.php?message=Profile Updated Successfully!&success=alert-success");
          }
            else{
              header("Location: profile.php?message=Profile Didn't Updated!&success=alert-warning");
            }
          }else{echo "Invalid";}
        } else {

          // If User Don't Want To Change Profile Than It Will Work

        $query = "UPDATE user SET first_name = '$first_name', last_name = '$last_name', email = '$email', gender = '$gender', date_of_birth = '$date_of_birth', address = '$address', updated_at = NOW() WHERE user_id = '$user_id' ";

          if($result = mysqli_query($connection, $query)){
            header("Location: profile.php?message=Profile Updated Successfully!&success=alert-success");
          }
          else{
            header("Location: profile.php?message=Profile Didn't Updated!&success=alert-warning");
          }
        }
  }

  // Selecting Data Of That User

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
              <p><span>If You Don't Want To Change Profile Than Don't Upload Image</span></p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="user_id" value="<?= $user_id?>">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">First Name</p>
              </div>
              <div class="col-sm-9">
                <input type="text" name="first_name" value="<?= $data['first_name']?>" required>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Last Name</p>
              </div>
              <div class="col-sm-9">
                <input type="text" name="last_name" value="<?= $data['last_name']?>" required>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <input type="email" name="email" value="<?= $data['email']?>" required>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <input type="radio" name="gender" value="Male" <?= ($data['gender'] == "Male")? 'checked' : ""?> required required><label>Male</label>
                <input type="radio" name="gender" value="Female" <?= ($data['gender'] == "Female")? 'checked' : ""?>><label>Female</label>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Date Of Birth</p>
              </div>
              <div class="col-sm-9">
                <input type="date" name="date_of_birth" value="<?= $data['date_of_birth']?>">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Profile Picture</p>
              </div>
              <div class="col-sm-9">
                <input type="file" name="user_image"><p>Don't Select If you Don't Want To Change.</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <textarea name="address" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required required><?= $data['address']?> </textarea>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12 d-flex justify-content-center">
                <input type="submit" name="update_profile" value="Update Profile" class="btn btn-primary">
              </div>
            </div>
            </form>
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
  }
?>

<?php
  require("../require/footer.php");
?>
