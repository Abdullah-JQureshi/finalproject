<?php
    require("admin_header.php");

    $user_id = $_SESSION['user']['user_id'];

    // Showing All Blog Related To Login Admin, Join Blog To User

    $query = "SELECT blog.user_id AS User_ID,
                      blog.blog_id AS ID_No,
                      CONCAT(user.first_name, ' ', user.last_name) AS Added_By,
                      blog.blog_title AS Title,
                      blog.blog_background_image AS Cover_Image,
                      blog.post_per_page AS Post_Per_Page,
                      blog.blog_status AS Status,
                      blog.created_at AS Created_At,
                      blog.updated_at AS Updated_At
               FROM blog
               INNER JOIN user
               ON blog.user_id = user.user_id WHERE blog.user_id = '$user_id' ORDER BY blog.blog_id DESC";

    $result = mysqli_query($connection, $query);

    // Updating Blog Setting Taking Query String And Checking It 

    if(isset($_GET["action"]) && isset($_GET["id"])) {
        $id = intval($_GET["id"]);

        // Blog Inactive 

        if($_GET["action"] == "inactive"){
            $query = "UPDATE blog SET blog_status='InActive' WHERE blog_id ={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: blog_setting.php?message=Blog InActive Successfully!&success=alert-warning");
            } else {
                header("Location: blog_setting.php?message=Blog Has Not Been InActive Try Again !...&success=alert-danger");
            }
        } else if($_GET["action"] == "active"){

            // Blog Active

            $query = "UPDATE blog SET blog_status= 'Active' WHERE blog_id={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: blog_setting.php?message=Blog Active Successfully!&success=alert-success");
            } else {
                header("Location: blog_setting.php?message=Blog Has Not Been Active Try Again !...&success=alert-danger");
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
                          <h1 class="text-dark display-4 fw-bold text-center mb-4">Blog Setting</h1>
                            <hr class="mb-5" />
                            <table id="blogs_setting" class="table table-striped" style="width:100%">
                                <thead align="center">
                                    <?php if(mysqli_num_rows($result) > 0 ){ ?>
                                    <tr>
                                        <th>ID No</th>
                                        <th>Added By</th>
                                        <th>Title</th>
                                        <th>Cover Image</th>
                                        <th>Post Per Page</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php while($data = mysqli_fetch_assoc($result)){ ?>
                                    <tr>
                                        <td><?= $data['ID_No']?></td>
                                        <td><?= $data['Added_By']?></td>
                                        <td><?= $data['Title']?></td>
                                        <td><img src="<?= $data['Cover_Image']; ?>" class="img-fluid square me-2" width="50"></td>
                                        <td><?= $data['Post_Per_Page']?></td>
                                        <td><?= $data['Status']?></td>
                                        <td><?= $data['Created_At']?></td>
                                        <td><?= $data['Updated_At']?></td>
                                        <td><a class="btn btn-success btn-gradient"href="add_blog.php?action=edit&blog_id=<?=$data["ID_No"]?>">Edit</a>
                                            <?php if ($data['Status'] == 'Active') { ?>
                                                <a class="btn btn-danger btn-gradient" href="blog_setting.php?action=inactive&id=<?=$data['ID_No']?>">InActive</a>
                                            <?php } else { ?>
                                                <a class="btn btn-success btn-gradient" href='blog_setting.php?action=active&id=<?=$data['ID_No']?>'>Active</a>
                                            <?php } ?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <?php }   else {?>
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
                        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#blogs_setting').DataTable({
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