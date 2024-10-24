<?php
  session_start();
	require("../require/header.php");
?>

<?php 
  require("search_bar.php");  

  $user_id =  isset($_SESSION['user'])? $_SESSION['user']['user_id']: "";
?>

<?php

  $blog_id = $_GET['blog_id'];

  // Selecting Post Per Page To Show On A Blog

  $query = "SELECT post_per_page FROM blog WHERE blog_id = '$blog_id'";
  $result = mysqli_query($connection, $query);
  $post_per_page = mysqli_fetch_assoc($result);

  $limit = isset($post_per_page['post_per_page']) ? $post_per_page['post_per_page'] : 10;

  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = ($page - 1) * $limit;

  // SHowing Specific Blog Aactive Post Who Have Active Blog And Active Category With The Help Of Query String, Join Post To Blog, Post To Post Category To Category Where Post Are Active

  
  $query = "SELECT post.*, blog.blog_id, blog.blog_title, blog.blog_background_image, 
            category.category_title
            FROM post INNER JOIN blog ON post.blog_id = blog.blog_id INNER JOIN post_category ON post.post_id = post_category.post_id INNER JOIN category ON post_category.category_id = category.category_id
            WHERE blog.blog_id = '$blog_id' AND post_status = 'Active' AND category.category_status = 'Active' AND blog.blog_status = 'Active'
            ORDER BY post.post_id DESC LIMIT $start, $limit";
  $result = mysqli_query($connection, $query);

  if ($result->num_rows) {
    $data = mysqli_fetch_assoc($result);
?>

<div class="mt-5">
  <?php if(isset($_GET['message'])){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <p class="message text-center"><?php echo $_GET['message'];?></p>
        </div>
    </div>
  <?php } ?>
	<div>
		<button type="button" class="btn btn-dark m-5" onclick="window.history.back();">Back</button>
	</div>
	<div class="d-flex justify-content-center align-items-center">
	  	<h1 class="text-center" id="categories"><?= $data['blog_title']; ?></h1>
	  	<?php

              // Showing That User Follow this Blog Or Not On Those Basis Of This It Should Show Button To Follow Or Unfollow

                $blog_id = $data['blog_id'];
                $query = "SELECT * FROM following_blog WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";
                $result2 = mysqli_query($connection, $query); 
                if($result2->num_rows){ 

                  $row = mysqli_fetch_assoc($result2);

                  if ($row['status'] == 'Followed') {
                    ?>
                    <a href="follow_process.php?action=unfollowed&user_id=<?= $user_id?>&blog_id=<?= $blog_id ?>" class="btn btn-secondary ms-5"><i class="fas fa-user-plus"></i> Unfollow</a>
                    <?php
                      }else{
                    ?>
                          <a href="follow_process.php?action=followed&user_id=<?= $user_id?>&blog_id=<?= $blog_id ?>" class="btn btn-primary ms-5"><i class="fas fa-user-plus"></i> Follow</a>
                    <?php
                    }
                }else{
                    ?>
                    <a href="follow_process.php?action=followed&user_id=<?= $user_id?>&blog_id=<?= $blog_id ?>" class="btn btn-primary ms-5"><i class="fas fa-user-plus"></i> Follow</a><?php
                }
              ?>
	</div>
        <br>
  <div class="card h-100 card-large">
        <img class="card-img-top" src="<?= $data['blog_background_image']; ?>" alt="<?= $data['blog_title']; ?>" style = "height: 80%;">
  </div>
        <br>
    <h2 class="text-center">Related Posts</h2>
    <div class="mt-5 container text-center">
      <div class="row align-items-stretch">
        <?php
            $i = 1;

            // Fetching Data Multiple Time To Use MYSQLI DATA SEEK Function Data Of $result and Second Paramaeter Means Row 0

            mysqli_data_seek($result, 0);
            while ($data = mysqli_fetch_assoc($result)) {
          ?>
            <div class="col-md-4">
            <div class="card h-100">
              <img class="card-img-top" src="<?= $data['featured_image']?>" alt="">
              <div class="card-body">
                <h5 class="card-title"><?= $data['post_title']?></h5>
                <p class="card-text"><?= $data['post_summary']?></p>
                <div class="d-flex justify-content-between">
                  <p><?= $data['created_at']?></p>
                  <p class="float-end"><?= $data['category_title']?></p>
                </div>
              </div>
              <div class="card-footer">
                <a href="show_post.php?post_id=<?= $data['post_id'] ?>" class="btn btn-primary">See More</a>
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
      <?php

      // Pagination Counting Blog Aactive Post Who Have Active Blog And Active Category With The Help Of Query String, Join Post To Blog, Post To Post Category To Category Where Post Are Active

        $query = "SELECT COUNT(*) as num_rows
                  FROM post INNER JOIN blog ON post.blog_id = blog.blog_id INNER JOIN post_category ON post.post_id = post_category.post_id INNER JOIN category ON post_category.category_id = category.category_id
            WHERE blog.blog_id = '$blog_id' AND post_status = 'Active' AND category.category_status = 'Active' AND blog.blog_status = 'Active'";
        $result = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($result);
        $num_pages = ceil($data['num_rows'] / $limit);
        for ($i = 1; $i <= $num_pages; $i++) {
          if ($i == $page) {
            echo '<li class="page-item active"><a class="page-link" href="show_blog.php?blog_id=' . $blog_id . '&page=' . $i . '">' . $i . '</a></li>';
          } else {
            echo '<li class="page-item"><a class="page-link" href="show_blog.php?blog_id=' . $blog_id . '&page=' . $i . '">' . $i . '</a></li>';
          }
        }
      ?>
      </ul>
    </nav>
  </div>

  <?php
    } else {
      echo "No Records Found!";
    }
  ?>

<?php
	require("../require/footer.php");
?>