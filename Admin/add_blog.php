<?php

    // Admin Header
	require("admin_header.php");

    // Add Blog

    if(isset($_POST['add_blog'])){

            $dir = "../Blog_Image";
            if(!is_dir($dir)){
                if(!mkdir($dir)){
                    echo "Could Not Create Directory!!";
                }
            }

            extract($_POST);
            $user_id = $_SESSION['user']['user_id'];
            $tmp_name = $_FILES["blog_background_image"]["tmp_name"];
            $blog_background_image = time()."_".$_FILES["blog_background_image"]["name"];
            $path = $dir."/".$blog_background_image;

            if(move_uploaded_file($tmp_name,$path)){

                $query = "INSERT INTO blog(`user_id`,`blog_title`, `post_per_page`,`blog_background_image`,`blog_status`) VALUES('$user_id','$blog_title', '$post_per_page', '$path', '$blog_status')";

                if($result = mysqli_query($connection, $query)){
                    header("Location: add_blog.php?message=Blog Added Successfully!&success=alert-success"); 
                }
                else{
                    header("Location: add_blog.php?message=Blog Didn't Added!&success=alert-warning"); 
                }
            }else{echo "Invalid";}
        }else if(isset($_POST['update_blog'])){

            // Update Blog

                    $dir = "../Blog_Image";
                    if(!is_dir($dir)){
                        if(!mkdir($dir)){
                            echo "Could Not Create Directory!!";
                        }
                    }

                    extract($_POST);
                    $tmp_name = $_FILES["blog_background_image"]["tmp_name"];
                    $blog_background_image = time()."_".$_FILES["blog_background_image"]["name"];
                    $path = $dir."/".$blog_background_image;

            // If Admin Want To Update Blog Cover Image

                    if(!empty($tmp_name)){
                        if(move_uploaded_file($tmp_name,$path)){
                            $query = "UPDATE blog SET blog_title = '$blog_title', post_per_page = '$post_per_page', blog_background_image = '$path', blog_status = '$blog_status', updated_at = NOW() WHERE blog_id = '$blog_id' ";

                            if($result = mysqli_query($connection, $query)){
                                header("Location: blog_setting.php?message=Blog Updated Successfully!&success=alert-success");
                            }
                            else{
                                header("Location: blog_setting.php?message=Blog Didn't Updated!&success=alert-warning");
                            }
                        }else{echo "Invalid";}
                    } else {

                        // If Admin Want To Update Blog Cover Image

                        $query = "UPDATE blog SET blog_title = '$blog_title', post_per_page = '$post_per_page', blog_status = '$blog_status', updated_at = NOW() WHERE blog_id = '$blog_id' ";

                        if($result = mysqli_query($connection, $query)){
                            header("Location: blog_setting.php?message=Blog Updated Successfully!&success=alert-success");
                        }
                        else{
                            header("Location: blog_setting.php?message=Blog Didn't Updated!&success=alert-warning");
                        }
                    }
                }

        // Updating Blog Taking Query String And Checking It

        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['blog_id'])) {
            $blog_id = $_GET['blog_id'];
            $query = "SELECT * FROM blog WHERE blog_id = $blog_id";
            $result = mysqli_query($connection, $query);
            $edit_data = mysqli_fetch_assoc($result);
        }
        // mysqli_close($connection);
?>


	<div class="container-fluid">
		<div class="row">
				<?php
					require("admin_right_sidebar.php");
				?>
			<div class="col-sm-10 p-5 d-flex justify-content-center">
                    <div class="col-sm-6" id="add-blogs">

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
                                echo ($_GET['action'] == 'edit')?'Update Blog':'Add Blog';
                            }else{ echo "Add Blog";}?></h1>

                        <input type="hidden" name="blog_id" value="<?= isset($edit_data['blog_id']) ? $edit_data['blog_id'] : ""?>">
                                
                        <div>
                            <label for="title">Title</label><br/>
                            <input type="text" id="title" name="blog_title" value="<?= isset($edit_data['blog_title']) ? $edit_data['blog_title'] : ""?>"  class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                        </div>

                        <div>
                            <label for="per-page">Post Per Page</label><br/>
                            <input type="text" id="per-page" name="post_per_page" value="<?= isset($edit_data['post_per_page']) ? $edit_data['post_per_page'] : ""?>"  class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                        </div>
                                    
                        <div class="mb-3">
                            <label for="cover_image">Cover Image</label><br/>
                            <input type="file" name="blog_background_image" id="cover_image" class="w-100 mb-1 mt-1 ps-2" style="height:40px;">
                            <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                    ?>
                                <p>Don't Select If you Don't Want To Change.</p>
                            <?php }
                            ?>
                        </div>

                        <div class="mb-3">
                            <label for="blog-status" class="me-4">Blog Status:</label>
                            <input type="radio" name="blog_status" value="Active" <?php if (isset($edit_data['blog_status'])) {
                                    echo ($edit_data['blog_status'] == 'Active') ? 'checked' : "";
                                }?> required><label class="ms-1 me-3">Active</label>
                            <input type="radio" name="blog_status" value="Inactive" <?php if (isset($edit_data['blog_status'])) {
                                    echo ($edit_data['blog_status'] == 'InActive') ? 'checked' : "";
                                }?>><label class="ms-1">Inactive</label>
                        </div>

                        <div>
                            <input type="submit" value="<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'Update Blog':'Add Blog';
                            }else{ echo "Add Blog";}?>" name="<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'update_blog':'add_blog';
                            }else{ echo "add_blog";}?>" class="btn btn-dark btn-gradient w-100" style="height:40px;">
                            <input type="reset" value="CANCEL" name="cancel" class="btn btn-light btn-gradient w-100" style="height:40px;">
                        </div>
                    </form>
                </div>
		</div>
	</div>