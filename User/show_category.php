<?php
  session_start();
	require("../require/header.php");
?>

<?php 
  require("search_bar.php");  
?>

<?php

  // SHowing Specific Category Active Post Who Have Active Blog And Active Category With The Help Of Query String, Join Post To Blog, Post To Post Category To Category

  $limit = 3;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = ($page - 1) * $limit;

  $category_id = $_GET['category_id'];

  $query = "SELECT post.*, category.category_title, category.category_image, category.category_description
            FROM post INNER JOIN blog ON post.blog_id = blog.blog_id INNER JOIN post_category ON post.post_id = post_category.post_id INNER JOIN category ON post_category.category_id = category.category_id
            WHERE post_category.category_id = '$category_id' AND post_status = 'Active' AND category.category_status = 'Active' AND blog.blog_status = 'Active'
            ORDER BY post.post_id DESC LIMIT $start, $limit";
  $result = mysqli_query($connection, $query);

  if ($result->num_rows) {
    $data = mysqli_fetch_assoc($result);
?>

<div class="mt-5">
	<div>
		<button type="button" class="btn btn-dark m-5" onclick="window.history.back();">Back</button>
	</div>
    <h1 class="text-center" id="categories"><?= $data['category_title']; ?></h1>
    <br>
        <p><?= nl2br($data['category_description']) ?></p>
      <div class="card h-100 card-large">
        <img class="card-img-top" src="<?= $data['category_image']; ?>" alt="<?= $data['category_title']; ?>" style = "height: 80%;">
        </div>
        <br>
    <h2 class="text-center">Related Posts</h2>
    <div class="mt-5">
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

        <!-- Making Pagination Work From Counting All Category Active Post Who Have Active Blog And Active Category With The Help Of Query String, Join Post To Blog, Post To Post Category To Category -->

      <?php
        $query = "SELECT COUNT(*) as num_rows
                  FROM post INNER JOIN blog ON post.blog_id = blog.blog_id INNER JOIN post_category ON post.post_id = post_category.post_id INNER JOIN category ON post_category.category_id = category.category_id
                  WHERE post_category.category_id = '$category_id' AND post_status = 'Active' AND category.category_status = 'Active' AND blog.blog_status = 'Active'";
        $result = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($result);
        $num_pages = ceil($data['num_rows'] / $limit);
        for ($i = 1; $i <= $num_pages; $i++) {
          if ($i == $page) {
            echo '<li class="page-item active"><a class="page-link" href="show_category.php?category_id=' . $category_id . '&page=' . $i . '">' . $i . '</a></li>';
          } else {
            echo '<li class="page-item"><a class="page-link" href="show_category.php?category_id=' . $category_id . '&page=' . $i . '">' . $i . '</a></li>';
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