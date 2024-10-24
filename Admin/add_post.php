<?php

    // Admin Header
    require("admin_header.php");

    // Add Post

    if(isset($_POST['add_post'])){

        $attachment_dir = "../Post_Attachment";
        if(!is_dir($attachment_dir)){
            if(!mkdir($attachment_dir)){
                echo "Could Not Create Directory!!";
            }
        }

        // Attachment In Array

        $attachment_paths = [];
        $attachment_titles = [];

        foreach ($_FILES['attachment']['name'] as $key => $value) {
            $attachment_tmp_name = $_FILES['attachment']['tmp_name'][$key];
            $attachment_name = time() . "_" . $_FILES['attachment']['name'][$key];
            $attachment_path = $attachment_dir . "/" . $attachment_name;

            if (move_uploaded_file($attachment_tmp_name, $attachment_path)) {
                $attachment_paths[] = $attachment_path;
                $attachment_titles[] = $_POST['attachment_title'][$key];
            }
        }

        // Post Featured Image

        extract($_POST);
        $user_id = $_SESSION['user']['user_id'];

        $featured_image_tmp_name = $_FILES['featured_image']['tmp_name'];
        $featured_image_name = time() . "_" . $_FILES['featured_image']['name'];
        $featured_image_folder = "../Post_Image";
        if (!is_dir($featured_image_folder)) {
            if(!mkdir($featured_image_folder)){
                echo "Could Not Create Directory!!";
            }
        }

        $featured_image_path = $featured_image_folder . "/" . $featured_image_name;
        if (!move_uploaded_file($featured_image_tmp_name, $featured_image_path)) {
            echo "Invalid Image Upload.";
        }


        $query = "INSERT INTO post(`blog_id`,`post_title`, `post_summary`,`post_description`,`featured_image`, `post_status`, `is_comment_allowed`) VALUES(?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "isssssi", $blog_id, $post_title, $post_summary, $post_description, $featured_image_path, $post_status, $is_comment_allowed);


        if(mysqli_stmt_execute($stmt)){

            // Last Insert ID That Should Be Post ID

            $last_id = mysqli_insert_id($connection);

            if (isset($_POST['category']) && is_array($_POST['category'])) {
                foreach ($_POST['category'] as $category_id) {
                    $category_id = intval($category_id);
                    $category_query = "INSERT INTO post_category (`post_id`, `category_id`) VALUES ('$last_id', '$category_id')";
                    $result = mysqli_query($connection, $category_query);
                }
            } else {
                echo "No categories selected.";
            }

            // Inserting Multiple Attachments

            for ($i = 0; $i < count($attachment_paths); $i++) {
                $attachment_query = "INSERT INTO post_attachment (`post_id`, `post_attachment_title`, `post_attachment_path`) VALUES ('$last_id', '{$attachment_titles[$i]}', '{$attachment_paths[$i]}')";
                $result = mysqli_query($connection, $attachment_query);
            }

            header("Location: add_post.php?message=Post Added Successfully!&success=alert-success");
        }
        else{
            echo "Error: " . mysqli_error($connection);
    die();
            header("Location: add_post.php?message=Post Didn't Added!&success=alert-warning");
        }

    }else if (isset($_POST['update_post'])) {

        // Updating Post

            $post_id = $_POST['post_id'];

            $attachment_dir = "../Post_Attachment";
                if(!is_dir($attachment_dir)){
                    if(!mkdir($attachment_dir)){
                        echo "Could Not Create Directory!!";
                    }
                }

            $featured_image_folder = "../Post_Image";
                if (!is_dir($featured_image_folder)) {
                    if(!mkdir($featured_image_folder)){
                        echo "Could Not Create Directory!!";
                    }
                }

            $attachment_paths = [];
            $attachment_titles = [];

            foreach ($_FILES['attachment']['name'] as $key => $value) {
                $attachment_tmp_name = $_FILES['attachment']['tmp_name'][$key];
                $attachment_name = time() . "_" . $_FILES['attachment']['name'][$key];
                $attachment_path = $attachment_dir . "/" . $attachment_name;

                if (move_uploaded_file($attachment_tmp_name, $attachment_path)) {
                    $attachment_paths[] = $attachment_path;
                    $attachment_titles[] = $_POST['attachment_title'][$key];
                }
            }

            extract($_POST);
            $user_id = $_SESSION['user']['user_id'];

            // If Admin Want To Update Post Featured Image

            if (!empty($_FILES['featured_image']['name'])) {
                $featured_image_tmp_name = $_FILES['featured_image']['tmp_name'];
                $featured_image_name = time() . "_" . $_FILES['featured_image']['name'];
                $featured_image_path = $featured_image_folder . "/" . $featured_image_name;

                if (move_uploaded_file($featured_image_tmp_name, $featured_image_path)) {
                    $query = "UPDATE post SET `blog_id` = ?, `post_title` = ?, `post_summary` = ?, `post_description` = ?, `featured_image` = ?, `post_status` = ?, `is_comment_allowed` = ?, updated_at = NOW() WHERE post_id = ?";
                    $stmt = mysqli_prepare($connection, $query);
                    mysqli_stmt_bind_param($stmt, "issssssi", $blog_id, $post_title, $post_summary, $post_description, $featured_image_path, $post_status, $is_comment_allowed, $post_id);
                   $result = mysqli_stmt_execute($stmt);
                } else {
                    echo "Invalid Image Upload.";
                }
            } else {

                // If Admin Didn't Want To Update Post Featured Image

                $query = "UPDATE post SET `blog_id` = ?, `post_title` = ?, `post_summary` = ?, `post_description` = ?, `post_status` = ?, `is_comment_allowed` = ?, updated_at = NOW() WHERE post_id = ?";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "isssssi", $blog_id, $post_title, $post_summary, $post_description, $post_status, $is_comment_allowed, $post_id);
                $result = mysqli_stmt_execute($stmt);
            }

            if ($result) {

                // Last Insert ID Will Be Post ID To Add Data In Category And Attachment Table

                    $last_id = mysqli_insert_id($connection);

                    if (!empty($attachment_paths)) {
                        for ($i = 0; $i < count($attachment_paths); $i++) {
                            $attachment_query = "INSERT INTO post_attachment (`post_id`, `post_attachment_title`, `post_attachment_path`) VALUES ('$last_id', '{$attachment_titles[$i]}', '{$attachment_paths[$i]}')";
                            $result = mysqli_query($connection, $attachment_query);
                        }
                    }

                    if (isset($_POST['category']) && is_array($_POST['category'])) {
                        foreach ($_POST['category'] as $category_id) {
                            $category_id = intval($category_id);
                            $category_query = "INSERT INTO post_category (`post_id`, `category_id`) VALUES ('$last_id', '$category_id')";
                            $result = mysqli_query($connection, $category_query);
                        }
                    } else {
                        echo "No categories selected.";
                    }

                    header("Location: post_setting.php?message=Post Updated Successfully!&success=alert-success");
                }
            else{
                echo "Error: " . mysqli_error($connection);
    die();
                header("Location: post_setting.php?message=Post Didn't Updated!&success=alert-warning");
            }
        }

        // Updating Post Taking Query String And Checking It

    if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];

            // Join For Post To Blog, Post To Post Category To Category , Post To Post Attachment

            $query = "SELECT post.post_id AS ID_No,
                     blog.blog_id AS Blog_ID,
                     blog.blog_title AS Blog_Name,
                     GROUP_CONCAT(category.category_id SEPARATOR ', ') AS Category_IDs,
                     GROUP_CONCAT(category.category_title SEPARATOR ', ') AS Category,
                     post.post_title AS Post_Title,
                     post.post_summary AS Post_Summary,
                     post.post_description AS Post_Description,
                     post.featured_image AS Post_Image,
                     GROUP_CONCAT(post_attachment.post_attachment_title SEPARATOR ', ') AS Post_Attachment,
                     post.post_status AS Post_Status,
                     post.is_comment_allowed AS Comment_Allowed,
                     post.created_at AS Created_At
                     FROM post INNER JOIN blog ON post.blog_id = blog.blog_id INNER JOIN post_category ON post.post_id = post_category.post_id INNER JOIN category ON post_category.category_id = category.category_id INNER JOIN post_attachment ON post.post_id = post_attachment.post_id WHERE post.post_id = {$post_id}";
            $result = mysqli_query($connection, $query);
            $edit_data = mysqli_fetch_assoc($result);
        }

    // mysqli_close($connection);
     $user_id = $_SESSION['user']['user_id']
?>

<div class="container-fluid">
    <div class="row">
            <?php
                require("admin_right_sidebar.php");
            ?>
        <div class="col-sm-10 p-5 d-flex justify-content-center">
            <div class="col-sm-6" id="add-posts">

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
                                echo ($_GET['action'] == 'edit')?'Update Post':'Add Post';
                            }else{ echo "Add Post";}?></h1>
                    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {?>
                    <input type="hidden" name="post_id" value="<?= isset($edit_data['ID_No']) ? $edit_data['ID_No'] : ""?>">
                <?php } ?>

                <!-- Selecting Blog All Blog Of That Admin Will come -->
                    <div class="mb-3">
                        <label for="title">Blog</label>
                        <select id="blog" name="blog_id" class="form-select" required >
                            <option selected disabled>Select Blog</option>
                            <?php
                                $query = "SELECT blog_id, blog_title FROM blog WHERE user_id = $user_id";
                                $result = mysqli_query($connection, $query);
                                if ($result->num_rows > 0) {
                                    while ($blog = mysqli_fetch_assoc($result)) {
                                        $is_selected = ($blog['blog_id'] == $edit_data['Blog_ID']) ? 'selected' : '';
                                        echo "<option value='{$blog['blog_id']}' {$is_selected}>{$blog['blog_title']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <!-- Selecting Category -->

                    <div class="mb-3">
                        <label for="title">Category</label>
                        <select id="category" name="category[]" class="form-select" required >
                            <option selected disabled>Select Category</option>
                            <?php
                                $query = "SELECT category_id, category_title FROM category";
                                $result = mysqli_query($connection, $query);
                                if ($result->num_rows > 0) {
                                    $category_ids = explode(", ", $edit_data['Category_IDs']);
                                    while ($category = mysqli_fetch_assoc($result)) {
                                        $is_selected = (in_array($category['category_id'], $category_ids)) ? 'selected' : '';
                                        echo "<option value='{$category['category_id']}' {$is_selected}>{$category['category_title']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="title">Post Title</label>
                        <input type="text" id="title" name="post_title" value="<?= isset($edit_data['Post_Title']) ? $edit_data['Post_Title'] : ""?>" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                    </div>

                    <div class="mb-3">
                        <label for="summary">Post Summary</label>
                        <input type="text" id="summary" name="post_summary" value="<?= isset($edit_data['Post_Summary']) ? $edit_data['Post_Summary'] : ""?>" class="w-100 mb-3 mt-1 ps-2" style="height:40px;" required />
                    </div>

                    <div class="mb-3">
                        <label for="description">Post Description</label>
                        <textarea name="post_description" id="description" class="w-100 mb-3 mt-1 ps-2" required ><?= isset($edit_data['Post_Description']) ? $edit_data['Post_Description'] : ""?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="cover_image">Featured Image</label>
                        <input type="file" name="featured_image" id="cover_image" class="w-100 mb-1 mt-1 ps-2" style="height:40px;">
                        <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                    ?>
                                <p>Don't Select If you Don't Want To Change.</p>
                        <?php }
                        ?>
                    </div>

                    <div class="mb-3">
                        <label for="content">Attachment:</label>
                        <?php for ($i = 0; $i < 2; $i++){ ?>
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="attachment_title[]" placeholder="Enter attachment's title">
                                <input type="file" class="form-control mt-2" name="attachment[]" multiple >
                                <?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                    ?>
                                <p>Don't Select If you Don't Want To Change.</p>
                        <?php }
                        ?>
                            </div>
                        <?php } ?>
                        
                    </div>

                    <div class="mb-3">
                        <label for="post-status" class="me-4">Post Status:</label>
                        <input type="radio" name="post_status" value="Active" <?php if (isset($edit_data['Post_Status'])) {
                                    echo ($edit_data['Post_Status'] == 'Active') ? 'checked' : "";
                                }?> required ><label class="ms-1 me-3">Active</label>
                        <input type="radio" name="post_status" value="InActive" <?php if (isset($edit_data['Post_Status'])) {
                                    echo ($edit_data['Post_Status'] == 'InActive') ? 'checked' : "";
                                }?>><label class="ms-1">Inactive</label>
                    </div>

                    <div class="mb-3">
                        <label for="comment-status" class="me-4">Comments Allowed:</label>
                        <input type="radio" name="is_comment_allowed" value="1" <?php if (isset($edit_data['Comment_Allowed'])) {
                                    echo ($edit_data['Comment_Allowed'] == '1') ? 'checked' : "";
                                }?> required ><label class="ms-1 me-3">Yes</label>
                        <input type="radio" name="is_comment_allowed" value="0" <?php if (isset($edit_data['Comment_Allowed'])) {
                                    echo ($edit_data['Comment_Allowed'] == '0') ? 'checked' : "";
                                }?>><label class="ms-1">No</label>
                    </div>

                    <div>
                        <input type="submit" value="<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'Update Post':'Add Post';
                            }else{ echo "Add Post";}?>" name="<?php if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                echo ($_GET['action'] == 'edit')?'update_post':'add_post';
                            }else{ echo "add_post";}?>" class="btn btn-dark btn-gradient w-100" style="height:40px;">
                        <input type="reset" value="CANCEL" name="cancel" class="btn btn-light btn-gradient w-100" style="height:40px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
