 <?php

    // Showing 3 Categories Who Are Active

    $user_id =  isset($_SESSION['user'])? $_SESSION['user']['user_id']: "";

    $query = "SELECT * FROM category WHERE category_status = 'Active' LIMIT 3";

    $result = mysqli_query($connection, $query);

    if ($result->num_rows) {
              
?>
 <div class="mt-5">
    <hr>
    <h1 class="text-center" id="categories">Popular Categories</h1>
    <div class="mt-5 container text-center">
      <div class="row align-items-stretch">
        <?php
          while ($data = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-md-4">
          <div class="card h-100">
            <img class="card-img-top" src="<?= $data['category_image']?>" alt="">
            <div class="card-body">
              <h5 class="card-title"><?= $data['category_title']?></h5>
              <p class="card-text"><?= $data['category_description']?></p>
            </div>
            <div class="card-footer">
              <a href="show_category.php?category_id=<?= $data['category_id'] ?>" class="btn btn-primary">See More</a>
            </div>
          </div>
        </div>
        <?php
            }
        ?>
      </div>
    </div>
    <div class="text-center">
      <br>
      <a href="categories.php" class="text-decoration-none">See More Categories</a>
    </div>
  </div>
  <?php
    }else{
      echo "No Records Found!";
    }
  ?>


<?php

    // Showing 3 Recent Posts Who Are Active, Join Post To Post Category To Category

    $query = "SELECT * FROM post INNER JOIN blog ON post.blog_id = blog.blog_id INNER JOIN post_category ON post.post_id = post_category.post_id INNER JOIN category ON post_category.category_id = category.category_id WHERE post_status = 'Active' AND category.category_status = 'Active' AND blog.blog_status = 'Active' ORDER BY post.created_at DESC LIMIT 3";

    $result = mysqli_query($connection, $query);

    if ($result->num_rows) {
              
?>

   <div class="mt-5">
    <hr>
    <h1 class="text-center" id="categories">Recent Posts</h1>
    <div class="mt-5 container text-center">
      <div class="row align-items-stretch">
        <?php
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
            }
        ?>
      </div>
    </div>
    <div class="text-center">
      <br>
      <a href="posts.php" class="text-decoration-none">See More Posts</a>
    </div>
  </div>
  <?php
    }else{
      echo "No Records Found!";
    }
  ?>

<?php

    // Showing 3 Active Blogs

    $query = "SELECT * FROM blog WHERE blog_status = 'Active' LIMIT 3";

    $result = mysqli_query($connection, $query);

    if ($result->num_rows) {
?>

<div class="mt-5">
    <hr>
    <h1 class="text-center" id="blog">Top Blogs</h1>
    <div class="mt-5 container text-center">
      <div class="row align-items-stretch">
        <?php
          while ($data = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-md-4">
          <div class="card h-100">
            <img class="card-img-top" src="<?= $data['blog_background_image']?>" alt="">
            <div class="card-body">
              <h5 class="card-title"><?= $data['blog_title']?></h5>
            </div>
            <div class="card-footer d-flex justify-content-evenly">
              <a href="show_blog.php?&blog_id=<?=$data['blog_id']?>" class="btn btn-primary">See More</a>
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
            }
        ?>
      </div>
    </div>
    <div class="text-center">
      <br>
      <a href="blog.php" class="text-decoration-none">See More Blogs</a>
    </div>
  </div>
  <?php
    } else {
      echo "No Records Found!";
    }
  ?>
