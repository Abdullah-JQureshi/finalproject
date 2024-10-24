<?php
	require("admin_header.php");

	// Showing User Who Are Approved And Not Admin 

	$query = "SELECT * FROM user WHERE is_approved = 'Approved' AND role_id != 1 ORDER BY user_id DESC";
    $result = mysqli_query($connection, $query);

    // Updating User Setting Taking Query String And Checking It

    if(isset($_GET["action"]) && isset($_GET["id"])) {
        $id = intval($_GET["id"]);

        // User Inactive

        if($_GET["action"] == "inactive"){
            $query = "UPDATE user SET is_active='InActive' WHERE user_id ={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: user_setting.php?message=User InActive Successfully!&success=alert-warning");
            } else {
                header("Location: user_setting.php?message=User Has Not Been InActive Try Again !...&success=alert-danger");
            }
        } else if($_GET["action"] == "active"){

        	// User Active 

            $query = "UPDATE user SET is_active= 'Active' WHERE user_id={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: user_setting.php?message=User Active Successfully!&success=alert-success");
            } else {
                header("Location: user_setting.php?message=User Has Not Been Active Try Again !...&success=alert-danger");
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
				          <h1 class="text-dark display-4 fw-bold text-center mb-4">Users Setting</h1>
		                    <hr class="mb-5" />
		                    <table id="user_setting" class="table table-striped" style="width:100%">
		                        <thead>
		                        	<?php if(mysqli_num_rows($result) > 0 ){ ?>
		                            <tr>
		                                <th>ID No</th>
		                                <th>Image</th>
		                                <th>Full Name</th>
		                                <th>Email</th>
		                                <th>Request</th>
		                                <th>Status</th>
		                                <th>Created At</th>
		                                <th>Updated At</th>
		                                <th>Action</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <?php while($data = mysqli_fetch_assoc($result)){ ?>
		                            <tr>
		                                <td><?= $data['user_id']?></td>
		                                <td><img src="<?= $data['user_image']; ?>" class="img-fluid square me-2" width="50"></td>
		                                <td><?= $data['first_name']. " " . $data['last_name']?></td>
		                                <td><?= $data['email']?></td>
		                                <td><?= $data['is_approved']?></td>
		                                <td><?= $data['is_active'] ?></td>
		                                <td><?= $data['created_at']?></td>
		                                <td><?= $data['updated_at']?></td>
		                                <td>
		                                    <a class="btn btn-success btn-gradient"href="add_user.php?action=edit&user_id=<?= $data["user_id"]; ?>">Edit</a>
		                                    <?php if ($data['is_active'] == 'Active') { ?>
											    <a class="btn btn-danger btn-gradient" href="user_setting.php?action=inactive&id=<?=$data['user_id']?>">InActive</a>
											<?php } else { ?>
											    <a class="btn btn-success btn-gradient" href='user_setting.php?action=active&id=<?=$data['user_id']?>'>Active</a>
											<?php } ?>
		                                </td>
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
					 <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" ></script>
					 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
                    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
					    
					    <script type="text/javascript">
                            $(document).ready(function() {
                                $('#user_setting').DataTable({
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