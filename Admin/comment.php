<?php
	require("admin_header.php");

	// Showing Comment With User Name And Image, Join Post Comment To Post , Post Comment To user.

	$query = "SELECT post_comment.*, post.post_title, user.first_name, user.last_name, user.user_image
            FROM post_comment
            INNER JOIN post ON post_comment.post_id = post.post_id
            INNER JOIN user ON post_comment.user_id = user.user_id
            ORDER BY post_comment_id DESC";

    $comment_result = mysqli_query($connection, $query);

    // Updating Comment Setting Taking Query String And Checking It

    if(isset($_GET["action"]) && isset($_GET["id"])) {
        $id = intval($_GET["id"]);

        // Comment Inactive

        if($_GET["action"] == "inactive"){
            $query = "UPDATE post_comment SET is_active='InActive' WHERE post_comment_id ={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: comment.php?message=Comment InActive Successfully!&success=alert-warning");
            } else {
                header("Location: comment.php?message=Comment Has Not Been InActive Try Again !...&success=alert-danger");
            }
        } else if($_GET["action"] == "active"){

        	// Comment Active

            $query = "UPDATE post_comment SET is_active= 'Active' WHERE post_comment_id ={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: comment.php?message=Comment Active Successfully!&success=alert-success");
            } else {
                header("Location: comment.php?message=Comment Has Not Been Active Try Again !...&success=alert-danger");
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
				<div class="mt-5 container text-center">
				      <div class="row align-items-stretch">
				        <div class="col-md-4">
				          <div class="card h-100 bg-secondary text-white">
				            <div class="card-body">
				              <h5 class="card-title">Total Comments</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`post_comment_id`) AS total_comments
												FROM
												    post_comment";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['total_comments']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4">
				          <div class="card h-100 bg-secondary text-white">
				            <div class="card-body">
				              <h5 class="card-title">Active Comments</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`post_comment_id`) AS active_comments
												FROM
												    post_comment WHERE is_active = 'Active' ";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['active_comments']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-4">
				          <div class="card h-100 bg-secondary text-white">
				            <div class="card-body">
				              <h5 class="card-title">In-Active Comments</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`post_comment_id`) AS in_active_comments
												FROM
												    post_comment WHERE is_active = 'InActive' ";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['in_active_comments']?></p>
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
				        	<?php 
			                    if(isset($_GET['message']) && isset($_GET['success'])){ ?>
			                        <div class="alert <?= $_GET['success']?> alert-dismissible fade show" role="alert">
			                            <div>
			                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button> 
			                                <h3 class="message text-center"><?= $_GET['message'];?></h3>
			                            </div>
			                        </div>
			                    <?php } ?>
				        <h1>Comments Setting</h1>
				        <hr class="mb-5" />
				          <table  id="comment_id" class="table table-striped" style="width:100%">
					        <thead>
					        	<?php if(mysqli_num_rows($comment_result) > 0 ){ ?>
					            <tr>
					                <th>Comment ID</th>
					                <th>Post Title</th>
					                <th>User Name</th>
					                <th>User Image</th>
					                <th>Comment</th>
					                <th>Comment Status</th>
					                <th>Created At</th>
					                <th>Action</th>
					            </tr>
					        </thead>
					        <tbody>
					            <?php while($data = mysqli_fetch_assoc($comment_result)){ ?>
					        <tr>
		                                <td><?= $data['post_comment_id']?></td>
		                          		<td><?= $data['post_title']?></td>
		                                <td><?= $data['first_name']. " " . $data['last_name']?></td>
		                                <td><img src="<?= $data['user_image']; ?>" class="img-fluid square me-2" width="50"></td>
		                                <td><?= $data['comment']?></td>
		                                <td><?= $data['is_active'] ?></td>
		                                <td><?= $data['created_at']?></td>
		                                <td>
		                                    <?php if ($data['is_active'] == 'Active') { ?>
											    <a class="btn btn-danger btn-gradient" href="comment.php?action=inactive&id=<?=$data['post_comment_id']?>">InActive</a>
											<?php } else { ?>
											    <a class="btn btn-success btn-gradient" href='comment.php?action=active&id=<?=$data['post_comment_id']?>'>Active</a>
											<?php } ?>
		                                </td>
		                            </tr>
		                            <?php }?>
		                        </tbody>
		                        <?php  }  else {?>
		                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
		                            <div>
		                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
		                                <p class="message text-center"><?= "<h3 align='center'>No Comment Found</h3>";?></p>
		                            </div>
		                        </div>
		                        <?php } ?>
		                    </table>
					 <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" ></script>
					 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
                    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
					    
					    <script type="text/javascript">
                            $(document).ready(function() {
                                $('#comment_id').DataTable({
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