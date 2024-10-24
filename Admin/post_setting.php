<?php
    require("admin_header.php");

    $user_id = $_SESSION['user']['user_id'];

    // Showing All Post It's Related Category And Blog , Join Post To Blog, Post To Post Category To Category. 

    $query = "SELECT post.post_id AS ID_No,
                     blog.blog_title AS Blog_Name,
                     category.category_title AS Category,
                     post.post_title AS Post_Title,
                     post.post_summary AS Post_Summary,
                     post.post_description AS Post_Description,
                     post.featured_image AS Post_Image,
                     post.post_status AS Post_Status,
                     post.is_comment_allowed AS Comment_Allowed,
                     post.created_at AS Created_At,
                     post.updated_at AS Updated_At
                     FROM post INNER JOIN blog ON post.blog_id = blog.blog_id INNER JOIN post_category ON post.post_id = post_category.post_id INNER JOIN category ON post_category.category_id = category.category_id 
                         WHERE blog.user_id = '$user_id'
                         ORDER BY post.post_id DESC";


    $result = mysqli_query($connection, $query);

    // Updating Post Setting Taking Query String And Checking It

    if(isset($_GET["action"]) && isset($_GET["id"])) {
        $id = intval($_GET["id"]);

        // Post Inactive

        if($_GET["action"] == "inactive"){
            $query = "UPDATE post SET post_status='InActive' WHERE post_id ={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: post_setting.php?message=Post InActive Successfully!&success=alert-warning");
            } else {
                header("Location: post_setting.php?message=Post Has Not Been InActive Try Again !...&success=alert-danger");
            }
        } else if($_GET["action"] == "active"){

            // Post Active

            $query = "UPDATE post SET post_status= 'Active' WHERE post_id={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: post_setting.php?message=Post Active Successfully!&success=alert-success");
            } else {
                header("Location: post_setting.php?message=Post Has Not Been Active Try Again !...&success=alert-danger");
            }
        }
    }
?>

    <div class="container-fluid">
        <div class="row">
                <?php
                    require("admin_right_sidebar.php");
                ?>
            <div class="col-10">
                <div class="mt-5">
                    <div class="mt-5 container text-center">
                      <div class="row align-items-stretch">
                        <div class="col-md-12">
                            <?php 
                                if(isset($_GET['message']) && isset($_GET['success'])){ ?>
                                    <div class="alert <?= $_GET['success']?> alert-dismissible fade show" role="alert">
                                        <div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button> 
                                            <h3 class="message text-center"><?= $_GET['message'];?></h3>
                                        </div>
                                    </div>
                                <?php } ?>
                          <h1 class="text-dark display-4 fw-bold text-center mb-4">Post Setting</h1>
                            <hr class="mb-5" />
                            <table id="post_setting" class="table table-striped" style="width:100%">
                                <thead align="center">
                                    <?php if(mysqli_num_rows($result) > 0 ){ ?>
                                    <tr>
                                        <th>ID No</th>
                                        <th>Blog Name</th>
                                        <th>Category</th>
                                        <th>Post Title</th>
                                        <th>Post Summary</th>
                                        <th>Post Description</th>
                                        <th>Post Image</th>
                                        <th>Post Status</th>
                                        <th>Comment Allowed</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php while($data = mysqli_fetch_assoc($result)){ ?>
                                    <tr>
                                        <td><?= $data['ID_No']?></td>
                                        <td><?= $data['Blog_Name']?></td>
                                        <td><?= $data['Category']?></td>
                                        <td><?= $data['Post_Title']?></td>
                                        <td><?= $data['Post_Summary']?></td>
                                        <td><?= $data['Post_Description']?></td>
                                        <td><img src="<?= $data['Post_Image']; ?>" class="img-fluid square me-2" width="50"></td>
                                        <td><?= $data['Post_Status']?></td>
                                        <td><?= ($data['Comment_Allowed'] == 1 ? "Yes" : "No")?></td>
                                        <td><?= $data['Created_At']?></td>
                                        <td><?= $data['Updated_At']?></td>
                                        <td><a class="btn btn-success btn-gradient"href="add_post.php?action=edit&post_id=<?= $data["ID_No"]; ?>">Edit</a>
                                            <?php if ($data['Post_Status'] == 'Active') { ?>
                                                <a class="btn btn-danger btn-gradient" href="post_setting.php?action=inactive&id=<?=$data['ID_No']?>">InActive</a>
                                            <?php } else { ?>
                                                <a class="btn btn-success btn-gradient" href='post_setting.php?action=active&id=<?=$data['ID_No']?>'>Active</a>
                                            <?php } ?></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                                <?php  }  else {?>
                                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                    <div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <p class="message text-center"><?= "<h3 align='center'>No User Record Found</h3>";?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </table>
                     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
                        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#post_setting').DataTable({
                                    responsive: true
                                });
                            });
                        </script>
                          </div>
                        </div>
                        </div>
                      </div>
            </div>
        </div>
    </div>