<?php
	require("admin_header.php");

	// Showing All Feedbacks , Join User Feedback To User

	$query = "SELECT user_feedback.*, user.first_name, user.last_name, user.email
            FROM user_feedback
            LEFT JOIN user ON user_feedback.user_id = user.user_id
            ORDER BY feedback_id DESC";

    $feedback_result = mysqli_query($connection, $query);
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
				              <h5 class="card-title">Total Feedbacks</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`feedback_id`) AS total_feedback
												FROM
												    user_feedback";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['total_feedback']?></p>
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
				        <h1>Feedback Setting</h1>
				        <hr class="mb-5" />
				          <table  id="feedback_id" class="table table-striped" style="width:100%">
					        <thead>
					        	<?php if($feedback_result->num_rows){ ?>
					            <tr>
					                <th>Feedback ID</th>
					                <th>User Name</th>
					                <th>Guest User Name</th>
					                <th>User Email</th>
					                <th>Guest User Email</th>
					                <th>Feedback</th>
					                <th>Created At</th>
					            </tr>
					        </thead>
					        <tbody>
					            <?php while($data = mysqli_fetch_assoc($feedback_result)){ ?>
					        <tr>
		                                <td><?= $data['feedback_id']?></td>
		                                <td><?= $data['first_name']. " " . $data['last_name']?></td>
		                                <td><?= $data['user_name']?></td>
		                                <td><?= $data['email']?></td>
		                                <td><?= $data['user_email'] ?></td>
		                                <td><?= $data['feedback']?></td>
		                                <td><?= $data['created_at']?></td>
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
                                $('#feedback_id').DataTable({
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