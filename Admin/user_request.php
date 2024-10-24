<?php
	require("admin_header.php");

	// Showing User Who are in Pending With Status Inactive

	$query = "SELECT * FROM user WHERE is_approved = 'Pending' AND is_active = 'InActive' ORDER BY user_id DESC";
    $result = mysqli_query($connection, $query);

    // Updating User Setting Taking Query String And Checking It

    if(isset($_GET["action"]) && $_GET["action"] == "approved"){

    	// Approving User And Changing It's Status To Active

        $query = "UPDATE user SET is_approved = 'Approved', is_active='Active' WHERE user_id =".$_GET["user_id"];
        $result = mysqli_query($connection, $query);
        
        if($result){   
            header("Location: user_request.php?message=User Approved Successfully!&success=alert-success");
        }else{   
            header("Location: user_request.php?message=User Has Not Been Approved Try Again !...&success=alert-danger");
        }
    }else if(isset($_GET["action"]) && $_GET["action"] == "rejected"){

    	// Rejecting User

        $query = "UPDATE user SET is_approved = 'Rejected', is_active= 'InActive' WHERE user_id=".$_GET["user_id"];
        $result = mysqli_query($connection, $query);
        
        if($result){   
            header("Location: user_request.php?message=User Rejected Successfully!&success=alert-success");
        }else{   
            header("Location: user_request.php?message=User Has Not Been Rejected Try Again !...&success=alert-danger");
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
				          <h1 class="text-dark display-4 fw-bold text-center mb-4">Users Request</h1>
		                    <hr class="mb-5" />
		                    <h2 id="pending_users" class="text-dark text-center mb-4">Pending Users</h2>
		                    <table class="table table-striped user_request" style="width:100%">
		                        <thead>
		                        	<?php if($result->num_rows > 0 ){ ?>
		                            <tr>
		                                <th>ID No</th>
		                                <th>Image</th>
		                                <th>Full Name</th>
		                                <th>Email</th>
		                                <th>Request</th>
		                                <th>Status</th>
		                                <th>Created At</th>
		                                <th>Action</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	<?php while($data = mysqli_fetch_assoc($result)){ ?>
		                            <tr>
		                                <td><?= $data['user_id']?></td>
		                                <td><img src="<?= $data['user_image']; ?>" class="img-fluid square me-2" width="50"></td>
		                                <td><?= $data['first_name']. " " . $data['last_name']?></td>>
		                                <td><?= $data['email']?></td>
		                                <td><?= $data['is_approved']?></td>
		                                <td><?= $data['is_active'] ?></td>
		                                <td><?= $data['created_at']?></td>
		                                <td>
		                                    <a href="user_request.php?action=approved&user_id=<?= $data['user_id'] ?>" class="btn btn-success">Approve</a>
		                                    <a href="user_request.php?action=rejected&user_id=<?= $data['user_id'] ?>" class="btn btn-danger">Reject</a>
		                                </td>
		                            </tr>
		                            <?php }?>
		                        </tbody>
		                        <?php }  else {?>
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
                                $('.user_request').DataTable({
                                    responsive: true
                                });
                            });
                        </script>

                        <!-- Showing Rejected User Table -->
					   <?php
					   		$query = "SELECT * FROM user WHERE is_approved = 'Rejected' AND is_active = 'InActive' ORDER BY user_id DESC";
    						$result2 = mysqli_query($connection, $query);

					   ?>

					   <hr class="mb-5" />
		                    <h2 id="rejected_users" class="text-dark text-center mb-4">Rejected Users</h2>
		                    <table class="table table-striped user_request" style="width:100%">
		                        <thead>
		                        	<?php if($result2->num_rows > 0 ){ ?>
		                            <tr>
		                                <th>ID No</th>
		                                <th>Image</th>
		                                <th>Full Name</th>
		                                <th>Email</th>
		                                <th>Request</th>
		                                <th>Status</th>
		                                <th>Created At</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        	<?php while($data2 = mysqli_fetch_assoc($result2)){ ?>
		                            <tr>
		                                <td><?= $data2['user_id']?></td>
		                                <td><img src="<?= $data2['user_image']; ?>" class="img-fluid square me-2" width="50"></td>
		                                <td><?= $data2['first_name']. " " . $data2['last_name']?></td>
		                                <td><?= $data2['email']?></td>
		                                <td><?= $data2['is_approved']?></td>
		                                <td><?= $data2['is_active'] ?></td>
		                                <td><?= $data2['created_at']?></td>
		                            </tr>
		                            <?php }?>
		                        </tbody>
		                        <?php  } else {?>
		                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
		                            <div>
		                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
		                                <p class="message text-center"><?= "<h3 align='center'>No User Record Found</h3>";?></p>
		                            </div>
		                        </div>
		                        <?php } ?>
		                    </table>
				          </div>
				        </div>
				        </div>
				      </div>
			</div>
		</div>
	</div>