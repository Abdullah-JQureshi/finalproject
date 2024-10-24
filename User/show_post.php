<?php
  session_start();
	require("../require/header.php");

?>


<script>
	// Adding Comment Through AJAX

	function add_comment() {
		var post_id = document.getElementById('post_id').value;
		var user_id = document.getElementById('user_id').value;
		var comment = document.getElementById('comment').value;
		var ajax_request = null;

		if (window.XMLHttpRequest) {
			ajax_request = new XMLHttpRequest();
		}else{
			ajax_request = ActiveXObject("Microsoft.XMLHttp");
		}

		ajax_request.onreadystatechange = function(){
				if (ajax_request.readyState == 4 && ajax_request.status == 200 && ajax_request.statusText == 'OK') {
					document.getElementById('show_message').innerHTML = ajax_request.responseText;
				}
			}

		ajax_request.open("POST", "comment_process.php");
		ajax_request.setRequestHeader("content-type", "application/x-www-form-urlencoded");
		ajax_request.send("action=add_comment&post_id="+post_id+"&user_id="+user_id+"&comment="+comment);
		

	}
</script>

<?php

	// SHowing Post With The Help Of Query String, Join Post To Blog, Post To Post Category To Category, Post To Post Attachment

  $post_id = $_GET['post_id'];
  $user_id =  isset($_SESSION['user'])? $_SESSION['user']['user_id']: "";
  
 $query = "SELECT post.*, blog.blog_id, blog.blog_title, category.category_id, 
 					category.category_title, post_attachment.post_attachment_title, post_attachment.post_attachment_path
					FROM post
					LEFT JOIN blog ON post.blog_id = blog.blog_id
					LEFT JOIN post_category ON post.post_id = post_category.post_id
					LEFT JOIN category ON post_category.category_id = category.category_id
					LEFT JOIN post_attachment ON post.post_id = post_attachment.post_id
					WHERE post.post_id = '$post_id'";

  $result = mysqli_query($connection, $query);

  if ($result) {
    $data = mysqli_fetch_assoc($result);

?>
<div class="container mt-5">
	<div>
		<button type="button" class="btn btn-dark" onclick="window.history.back();">Back</button>
	</div>
	<div class="row align-items-start mt-5">
		<div class="col-lg-12 m-15px-tb">
			<article class="article">
				<div class="article-title text-center">
					<h2><?= $data['post_title']?></h2>
					<h5><?= $data['post_summary']?></h5>
					<br>
					<div class="media">
							<img src="<?= $data['featured_image']?>" style="width: 60%; height: 20%;">
					<div class="media-body">
						<br>
						<b><label>Blog: <a class="text-decoration-none" href="show_blog.php?blog_id=<?= $data['blog_id']?>"><?= $data['blog_title']?></a></label></b>
						<br>
						<b><label>Category: <a class="text-decoration-none" href="show_category.php?category_id=<?= $data['category_id']?>"><?= $data['category_title']?></a></label></b>
						<br>
						<span><?= $data['created_at']?></span>
					</div>
					</div>
				</div>
					<div class="article-content mt-5">
						<!-- nl2br Function For Same As In Database With Paragraph -->
								<p><?= nl2br($data['post_description']) ?></p>
					</div>
					<div>
						<?php if(isset($data['post_attachment_path'])){
							?>
							<a href="<?= $data['post_attachment_path']?>"><?= $data['post_attachment_title']?></a>
							<?php
						}?>
					</div>
			</article>
			<br><br>

			<!-- Showing Comments Who Are Active And Related To Post Also Showing Name And Image Of That User, Join Post Comment To User, Post Comment To Post   -->

			<?php
				$query = "SELECT post_comment.*, user.first_name, user.last_name, user.user_image
            FROM post_comment
            INNER JOIN user ON post_comment.user_id = user.user_id
            WHERE post_id = '$post_id' AND post_comment.is_active = 'Active' ORDER BY post_comment_id DESC";
				$result2 = mysqli_query($connection, $query);
				if ($result2->num_rows) {
			?>

			  <div class="container">
			    <div class="row d-flex justify-content-center">
			      <div class="col-md-12 col-lg-10">
			        <div class="card text-body">
			          <div class="card-body p-4">
			            <h4 class="mb-0">Recent comments</h4>
			            <br>
			            <?php 
					      		while($row = mysqli_fetch_assoc($result2)){
					      	?>
			            <div class="d-flex flex-start">
			              <img class="rounded-circle shadow-1-strong me-3"
			                src="<?= $row['user_image']?>" alt="" width="60"
			                height="60" />
			              <div>
			                <h6 class="fw-bold mb-1"><?= $row['first_name']." ".$row['last_name']?></h6>
			                <div class="d-flex align-items-center mb-3">
			                  <p class="mb-0">
			                    <?= $row['created_at']?>
			                  </p>
			                </div>
			                <p class="mb-0">
			                  <?= $row['comment']?>
			                </p>
			              </div>
			            </div>
			            <br>
			            <hr class="my-0" />
			            <br>
			            <?php }?>
			          </div>
			          </div>
			        </div>
			        <?php
						    } else {
						      echo "<div class= 'mt-5 text-center'><p>Post Don't Have Any Comment</p></div>";
						    }
						  ?>

						  <!-- Only Login User Can Comment  -->
			        
			        <?php
								if ($data['is_comment_allowed'] == 1){
								if (isset($_SESSION['user'])) {
							?>
							<div class="contact-form article-comment mt-5">
								<h4>Write Comment</h4>
									<!-- <form id="contact-form" method="POST" action="#"> -->
										<input type="hidden" name="post_id" id="post_id" value="<?= $post_id?>">
										<input type="hidden" name="user_id" id="user_id" value="<?= $user_id?>">
										<div class="row">
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<textarea name="comment" id="comment" placeholder="Your Comment" rows="4" class="form-control" required></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="send">
													<button id="comment_button" onclick="add_comment()" class="px-btn theme"><span>Submit</span> <i class="arrow"></i></button>
												</div>
											</div>
										</div>
									<!-- </form> -->
							</div>
							<?php 
								}
							}
							if (!isset($_SESSION['user']['user_id'])) {
						    	?>
						    	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						    		To Comment On This Post Login OR Signup First!. <a href="login.php" class="text-decoration-none">Login</a> | <a href="register.php" class="text-decoration-none">Signup</a></p>
						    	<?php
						    }
						    ?>
							<div id="show_message">
							</div>
			      </div>
			    </div>
			  </div>
			  

			
		</div>

	</div>
</div>

<?php
    } else {
      echo "No Records Found!";
    }
  ?>

<?php
	require("../require/footer.php");
?>