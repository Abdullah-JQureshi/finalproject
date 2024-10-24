<?php
	require("admin_header.php");

    // Adding User

    if(isset($_POST['add_user'])){

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

            if(move_uploaded_file($tmp_name,$path)){

                $query = "INSERT INTO USER(`role_id`,`first_name`, `last_name`, `email`, `password`, `gender`, `date_of_birth`,`user_image`,`address`) VALUES('$role','$first_name', '$last_name', '$email', '$password', '$gender', '$date_of_birth', '$path', '$address')";

                if($result = mysqli_query($connection, $query)){
                    header("Location: add_user.php?message=User Added Successfully!&success=alert-success"); 
                }
                else{
                    header("Location: add_user.php?message=User Didn't Added!&success=alert-warning");
                }
            }else{echo "Invalid";}
        }else if(isset($_POST['update_user'])){

            // Updating User

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
                    // If Admin Want to Change User Image

                    if(move_uploaded_file($tmp_name,$path)){
                        $query = "UPDATE user SET role_id = '$role', first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', gender = '$gender', date_of_birth = '$date_of_birth', user_image = '$path', address = '$address', updated_at = NOW() WHERE user_id = '$user_id' ";

                        if($result = mysqli_query($connection, $query)){
                            header("Location: user_setting.php?message=User Updated Successfully!&success=alert-success");
                        }
                        else{
                            header("Location: user_setting.php?message=User Didn't Updated!&success=alert-warning");
                        }
                    }else{echo "Invalid";}
                } else {

                    // If Admin Don't Want to Change User Image
                    
                    $query = "UPDATE user SET role_id = '$role', first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', gender = '$gender', date_of_birth = '$date_of_birth', address = '$address', updated_at = NOW() WHERE user_id = '$user_id' ";

                    if($result = mysqli_query($connection, $query)){
                        header("Location: user_setting.php?message=User Updated Successfully!&success=alert-success");
                    }
                    else{
                        header("Location: user_setting.php?message=User Didn't Updated!&success=alert-warning");
                    }
                }
            }   
        // Updating User Taking Query String And Checking It        

        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $query = "SELECT * FROM user WHERE user_id = $user_id";
            $result = mysqli_query($connection, $query);
            $edit_data = mysqli_fetch_assoc($result);
        }

        mysqli_close($connection);
?>


	<div class="container-fluid">
		<div class="row">
				<?php
					require("admin_right_sidebar.php");
				?>
			<div class="col-sm-10 p-5 d-flex justify-content-center">
                    <div class="col-sm-6">

                        <!-- For Message -->

                    <?php if(isset($_GET['message'])){ ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <p class="message text-center"><?php echo $_GET['message'];?></p>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Same Form For Updating And Adding Just Changing Type Submit Name for Update and Giving Values to All fields through query Above-->
                    
                    <form method="POST" action="#" class="shadow rounded p-4 bg-white" enctype="multipart/form-data">
                        <h1 class="text-center fw-bold text-dark"><?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'Update User':'Add User';
                            }else{ echo "Add User";}?></h1>
                        <input type="hidden" name="user_id" value="<?= isset($edit_data['user_id']) ? $edit_data['user_id'] : ""?>">
                        <div class="row d-flex">       
                            <div class="col-12">
                                <label>First Name</label>
                                <input type="text" name="first_name" value="<?= isset($edit_data['first_name']) ? $edit_data['first_name'] : ""?>" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                            </div>
                        </div>
            			
            			<div class="row d-flex">
                            <div class="col-12">
                                <label>Last Name</label>
                                <input type="text" name="last_name" value="<?= isset($edit_data['last_name']) ? $edit_data['last_name'] : ""?>" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                            </div>
                        </div>
                            
                        <div class="row d-flex">    
                            <div class="col-12">
                                <label>Email</label>
                                <input type="email" name="email" value="<?= isset($edit_data['email']) ? $edit_data['email'] : ""?>" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                            </div>
                        </div>
                
                		<div class="row d-flex">
                            <div class="col-12">
                                <label>Password</label>
                                <input type="password" name="password" value="<?= isset($edit_data['password']) ? $edit_data['password'] : ""?>" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                            </div>
                        </div>
                
                        <div class="row d-flex">
                            <div class="col-12">
                                <label>Date of Birth</label>
                                <input type="date" name="date_of_birth" value="<?= isset($edit_data['date_of_birth']) ? $edit_data['date_of_birth'] : ""?>" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                            </div>
                        </div>
                            
                        <div class="row d-flex">
                            <div class="col-12">
                                <label>Address</label>
                                <textarea name="address" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required><?= isset($edit_data['address']) ? $edit_data['address'] : ""?></textarea>
                            </div>
                        </div>


                        <div class="row d-flex">
                            <div class="col-12">
                                <label>Gender</label>
                                <select name="gender" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required >
                                        <option selected disabled>Select Gender</option>
                                        <option value="Male" <?= ($edit_data['gender'] == 'Male') ? 'selected' : ""?>>Male</option>
                                        <option value="Female" <?= ($edit_data['gender'] == 'Female') ? 'selected' : ""?>>Female</option>
                                </select>
                            </div>
                        </div>

                    	<div class="row d-flex">
                            <div class="col-12">
                                <label>User Image</label>
                                <input type="file" name="user_image" value="<?= isset($edit_data['user_image']) ? $edit_data['user_image'] : ""?>" class="w-100 mb-3 mt-1" style="height:40px;">
                                <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                    ?>
                                <p>Don't Select If you Don't Want To Change.</p>
                                <?php }
                                ?>
                            </div>
                        </div>

                        <div class="row d-flex">
                            <div class="col-12 mb-3">
                                <label class="me-4">Role: </label>
                                <input type="radio" name="role" value="1" <?php if (isset($edit_data['role_id'])) {
                                    echo ($edit_data['role_id'] == '1') ? 'checked' : "";
                                }?> required ><label class="ms-1 me-3">Admin</label>
                                <input type="radio" name="role" value="2" <?php if (isset($edit_data['role_id'])) {
                                    echo ($edit_data['role_id'] == '2') ? 'checked' : "";
                                }?>><label class="ms-1">User</label>
                            </div>
                        </div>
            
                        <div>
                            <input type="submit" value="<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'Update User':'Add User';
                            }else{ echo "Add User";}?>" name="<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'update_user':'add_user';
                            }else{ echo "add_user";}?>" class="btn btn-dark btn-gradient w-100" style="height:40px;">
                            <input type="reset" value="CANCEL" name="cancel" class="btn btn-light btn-gradient w-100" style="height:40px;">
                        </div>
                    </form>
                </div>
		</div>
	</div>