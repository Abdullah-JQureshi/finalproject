<?php
	require("admin_header.php");

	// Showing All Feedbacks , Join User Feedback To User

	$query = "SELECT following_blog.*, user.first_name, user.last_name, blog.blog_title
            FROM following_blog
            INNER JOIN user ON following_blog.follower_id = user.user_id
            INNER JOIN blog ON following_blog.blog_following_id = blog.blog_id
            ORDER BY follow_id DESC";

    $follower_result = mysqli_query($connection, $query);
?>

    <div class="container-fluid">
        <div class="row">
                <?php
                    require("admin_right_sidebar.php");
                ?>
            <div class="col-10">
                <div class="mt-5 container text-center">
                      <div class="row align-items-stretch">
                        <div class="col-md-3">
                          <div class="card h-100 bg-secondary text-white">
                            <div class="card-body">
                              <h5 class="card-title">Blogs Followers</h5>
                              <br>
                              <?php
                                    $query = "SELECT
                                                    COUNT(DISTINCT follower_id) AS total_follower
                                                FROM
                                                    following_blog";
                                    $result = mysqli_query($connection, $query);
                                    if ($result) {
                                        $data = mysqli_fetch_assoc($result);
                                ?>
                              <p class="card-text"><?= $data['total_follower']?></p>
                              <?php }?>
                              <br>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mt-5">
                    <div class="mt-5 container text-center">
                      <div class="row align-items-stretch">
                        <div class="col-md-12">
                        <h1>Followers Setting</h1>
                        <hr class="mb-5" />
                          <table  id="follow_id" class="table table-striped" style="width:100%">
                            <thead>
                                <?php if($follower_result->num_rows){ ?>
                                <tr>
                                    <th>Follow ID</th>
                                    <th>Name</th>
                                    <th>Blog Following</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($data = mysqli_fetch_assoc($follower_result)){ ?>
                            <tr>
                                        <td><?= $data['follow_id']?></td>
                                        <td><?= $data['first_name']. " " . $data['last_name']?></td>
                                        <td><?= $data['blog_title']?></td>
                                        <td><?= $data['status']?></td>
                                        <td><?= $data['created_at']?></td>
                                        <td><?= $data['updated_at']?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <?php  }  else {?>
                                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                    <div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <p class="message text-center"><?= "<h3 align='center'>No Feedback Found</h3>";?></p>
                                    </div>
                                </div>
                                <?php } ?>
                            </table>
                     <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" ></script>
                     <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
                    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
                        
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('#follow_id').DataTable({
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