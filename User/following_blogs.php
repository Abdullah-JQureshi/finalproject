<?php

  // Only Login User Can See This Page Not Admin Or Guest

  session_start();
  if(!isset($_SESSION['user']['first_name']) && $_SESSION['user']['role_id'] != 2) {
        header('Location: login.php?message=Please Login First!&success=alert-warning');
    }elseif (isset($_SESSION['user']['first_name']) && $_SESSION['user']['role_id'] == 1) {
        	header('Location: index.php');
    }
	require("../require/header.php");
?>

<?php 
	require("search_bar.php");

	$user_id =  isset($_SESSION['user'])? $_SESSION['user']['user_id']: "";

	$limit = 3;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = ($page - 1) * $limit;

  // Showing Blog That Current User Is Following, Join Blog To Following Blog 

  $query = "SELECT blog.*, following_blog.*
          FROM blog
          INNER JOIN following_blog ON blog.blog_id = following_blog.blog_following_id
          WHERE blog_status = 'Active' AND following_blog.follower_id = '$user_id' AND following_blog.status = 'Followed'
          ORDER BY blog_id DESC LIMIT $start, $limit";
  $result = mysqli_query($connection, $query);

  if ($result->num_rows) {

?>

	<div class="mt-5">
	  <h1 class="text-center" id="blog">Following Blogs</h1>
	  <div class="mt-5 container text-center">
	      <div class="row align-items-stretch">
	      	<?php
	          $i = 1;
	          while ($data = mysqli_fetch_assoc($result)) {
	        ?>
	        <div class="col-md-4">
	          <div class="card h-100">
	            <img class="card-img-top" src="<?= $data['blog_background_image'] ?>" alt="">
	            <div class="card-body">
	              <h5 class="card-title"><?= $data['blog_title'] ?></h5>
	            </div>
	            <div class="card-footer d-flex justify-content-evenly">
	              <a href="show_blog.php?blog_id=<?= $data['blog_id']; ?>" class="btn btn-primary">See More</a>
              <?php

              // Showing That User Follow this Blog Or Not On Those Basis Of This It Should Show Button To Follow Or Unfollow

                $blog_id = $data['blog_id'];
                $query = "SELECT * FROM following_blog WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";
                $result2 = mysqli_query($connection, $query); 
                if($result2->num_rows){ 

                  $row = mysqli_fetch_assoc($result2);

                  if ($row['status'] == 'Followed') {
                    ?>
                    <a href="follow_process.php?action=unfollowed&user_id=<?= $user_id?>&blog_id=<?= $blog_id ?>" class="btn btn-secondary"><i class="fas fa-user-plus"></i> Unfollow</a>
                    <?php
                      }else{
                    ?>
                          <a href="follow_process.php?action=followed&user_id=<?= $user_id?>&blog_id=<?= $blog_id ?>" class="btn btn-primary"><i class="fas fa-user-plus"></i> Follow</a>
                    <?php
                    }
                }else{
                    ?>
                    <a href="follow_process.php?action=followed&user_id=<?= $user_id?>&blog_id=<?= $blog_id ?>" class="btn btn-primary"><i class="fas fa-user-plus"></i> Follow</a><?php
                }
              ?>
	            </div>
	          </div>
	        </div>
	        <?php
	          if ($i % 3 == 0) {
	            echo '</div><div class="row">';
	          }
	          $i++;
	          }
	        ?>
	      </div>
	    </div>
	<div class="mt-5">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">

          <!-- Pagination On The Basis Of Total Following Blog Where Blog Is Active And Follwing Blog Status Equal To Followed, Join Blog To Following Blog -->

        <?php
          $query = "SELECT COUNT(*) as num_rows FROM blog
          INNER JOIN following_blog ON blog.blog_id = following_blog.blog_following_id
          WHERE blog_status = 'Active' AND following_blog.follower_id = '$user_id' AND following_blog.status = 'Followed'";
          $result = mysqli_query($connection, $query);
          $data = mysqli_fetch_assoc($result);
          $num_pages = ceil($data['num_rows'] / $limit);

          for ($i = 1; $i <= $num_pages; $i++) {
            if ($i == $page) {
              echo '<li class="page-item active"><a class="page-link" href="following_blogs.php?page=' . $i . '">' . $i . '</a></li>';
            } else {
              echo '<li class="page-item"><a class="page-link" href="following_blogs.php?page=' . $i . '">' . $i . '</a></li>';
            }
          }
        ?>

        </ul>
      </nav>
    </div>

    <?php
    } else {
      echo "<div class= 'mt-5 text-center'><p>You Are Not Currently Following Any Blog</p></div>";
    }
  ?>

<?php
	require("../require/footer.php");
?>