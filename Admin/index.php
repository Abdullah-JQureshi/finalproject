<?php
	require("admin_header.php");
?>

<!-- Showing All Data That Admin Want To See About User, Post, Blog, Categories, Comments, Feedbacks -->

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
				              <h5 class="card-title">Total Users</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`user_id`) AS total_user
												FROM
												    user";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['total_user']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-3">
				          <div class="card h-100 bg-success text-white">
				            <div class="card-body">
				              <h5 class="card-title">Approved Users</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`user_id`) AS approved_user
												FROM
												    user WHERE is_approved = 'Approved'";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['approved_user']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-3">
				          <div class="card h-100 bg-primary text-white">
				            <div class="card-body">
				              <h5 class="card-title">Pending Users</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`user_id`) AS pending_user
												FROM
												    user WHERE is_approved = 'Pending'";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['pending_user']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-3">
				          <div class="card h-100 bg-danger text-white">
				            <div class="card-body">
				              <h5 class="card-title">Rejected Users</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`user_id`) AS rejected_user
												FROM
												    user WHERE is_approved = 'Rejected'";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['rejected_user']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				      </div>
				    </div>

				<div class="mt-5 container text-center">
				      <div class="row align-items-stretch">
				        <div class="col-md-3">
				          <div class="card h-100 bg-success text-white">
				            <div class="card-body">
				              <h5 class="card-title">Active Users</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`user_id`) AS active_user
												FROM
												    user WHERE is_approved = 'Approved' AND is_active = 'Active' ";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['active_user']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-3">
				          <div class="card h-100 bg-warning text-white">
				            <div class="card-body">
				              <h5 class="card-title">In-Active Users</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`user_id`) AS in_active_user
												FROM
												    user WHERE is_approved = 'Approved' AND is_active = 'InActive' ";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['in_active_user']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-3">
				          <div class="card h-100 bg-secondary text-white">
				            <div class="card-body">
				              <h5 class="card-title">Total Blogs</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`blog_id`) AS total_blog
												FROM
												    blog";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['total_blog']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-3">
				          <div class="card h-100 bg-secondary text-white">
				            <div class="card-body">
				              <h5 class="card-title">Total Posts</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`post_id`) AS total_post
												FROM
												    post";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['total_post']?></p>
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
				      	<div class="col-md-3">
				          <div class="card h-100 bg-secondary text-white">
				            <div class="card-body">
				              <h5 class="card-title">Total Categories</h5>
				              <br>
				              <?php
				            		$query = "SELECT
												    COUNT(`category_id`) AS total_categories
												FROM
												    category";
									$result = mysqli_query($connection, $query);
									if ($result) {
										$data = mysqli_fetch_assoc($result);
				            	?>
				              <p class="card-text"><?= $data['total_categories']?></p>
				              <?php }?>
				              <br>
				            </div>
				          </div>
				        </div>
				        <div class="col-md-3">
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
		</div>
	</div>


