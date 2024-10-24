<?php

    // Admin Header
	require("admin_header.php");

    // Add Category

    if(isset($_POST['add_category'])){

            $dir = "../Category_Image";
            if(!is_dir($dir)){
                if(!mkdir($dir)){
                    echo "Could Not Create Directory!!";
                }
            }

            extract($_POST);
            $tmp_name = $_FILES["category_image"]["tmp_name"];
            $category_image = time()."_".$_FILES["category_image"]["name"];
            $path = $dir."/".$category_image;

            if(move_uploaded_file($tmp_name,$path)){

                $query = "INSERT INTO category(`category_title`, `category_description`,`category_image`,`category_status`) VALUES('".htmlspecialchars($category_title)."','".htmlspecialchars($category_description)."', '$path', '$category_status')";

                if($result = mysqli_query($connection, $query)){
                    header("Location: add_category.php?message=Category Added Successfully!&success=alert-success"); 
                }
                else{
                    header("Location: add_category.php?message=Category Didn't Added!&success=alert-warning"); 
                }
            }else{echo "Invalid";}
        }else if(isset($_POST['update_category'])){

                // Update Blog

                    $dir = "../Category_Image";
                    if(!is_dir($dir)){
                        if(!mkdir($dir)){
                            echo "Could Not Create Directory!!";
                        }
                    }

                    extract($_POST);
                    $tmp_name = $_FILES["category_image"]["tmp_name"];
                    $category_image = time()."_".$_FILES["category_image"]["name"];
                    $path = $dir."/".$category_image;

                    if(!empty($tmp_name)){

                        // If Admin Want To Update Category Image

                        if(move_uploaded_file($tmp_name,$path)){
                            $query = "UPDATE category SET category_title = '$category_title', category_description = '$category_description', category_image = '$path', category_status = '$category_status',updated_at = NOW() WHERE category_id = '$category_id' ";

                            if($result = mysqli_query($connection, $query)){
                                header("Location: category_setting.php?message=Category Updated Successfully!&success=alert-success");
                            }
                            else{
                                header("Location: category_setting.php?message=Category Didn't Updated!&success=alert-warning");
                            }
                        }else{echo "Invalid";}
                    } else {

                        // If Admin Don't Want To Update Category Image

                        $query = "UPDATE category SET category_title = '$category_title', category_description = '$category_description', category_status = '$category_status', updated_at = NOW() WHERE category_id = '$category_id' ";

                            if($result = mysqli_query($connection, $query)){
                                header("Location: category_setting.php?message=Category Updated Successfully!&success=alert-success");
                            }
                            else{
                                header("Location: category_setting.php?message=Category Didn't Updated!&success=alert-warning");
                            }
                    }
                }

        // Updating Category Taking Query String And Checking It

        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $query = "SELECT * FROM category WHERE category_id = $category_id";
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
                    <div class="col-sm-6" id="add-category">

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
                                echo ($_GET['action'] == 'edit')?'Update Category':'Add Category';
                            }else{ echo "Add Category";}?></h1>

                        <input type="hidden" name="category_id" value="<?= isset($edit_data['category_id']) ? $edit_data['category_id'] : ""?>">
                                
                        <div>
                            <label for="title">Title</label>
                            <input type="text" id="title" name="category_title" value="<?= isset($edit_data['category_title']) ? $edit_data['category_title'] : ""?>" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                        </div>

                        <div>
                            <label for="description">Description</label>
                            <textarea name="category_description" id="description" class="w-100 mb-3 mt-1 ps-2" required ><?= isset($edit_data['category_description']) ? $edit_data['category_description'] : ""?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cover_image">Category Image</label>
                            <input type="file" name="category_image" id="cover_image" class="w-100 mb-1 mt-1 ps-2" style="height:40px;">
                            <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                    ?>
                                <p>Don't Select If you Don't Want To Change.</p>
                            <?php }
                            ?>
                        </div>
                                    
                        <div class="mb-3">
                            <label for="category-status" class="me-4">Category Status:</label>
                            <input type="radio" name="category_status" value="Active" <?php if (isset($edit_data['category_status'])) {
                                    echo ($edit_data['category_status'] == 'Active') ? 'checked' : "";
                                }?> required ><label class="ms-1 me-3">Active</label>
                            <input type="radio" name="category_status" value="InActive" <?php if (isset($edit_data['category_status'])) {
                                    echo ($edit_data['category_status'] == 'InActive') ? 'checked' : "";
                                }?>><label class="ms-1">Inactive</label>
                        </div>

                        <div>
                            <input type="submit" value="<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'Update Category':'Add Category';
                            }else{ echo "Add Category";}?>" name="<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'update_category':'add_category';
                            }else{ echo "add_category";}?>" class="btn btn-dark btn-gradient w-100" style="height:40px;">
                            <input type="reset" value="CANCEL" name="cancel" class="btn btn-light btn-gradient w-100" style="height:40px;">
                        </div>
                    </form>
                </div>
		</div>
	</div>