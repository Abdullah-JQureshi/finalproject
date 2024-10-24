<?php
  session_start();
  require("../require/header.php");
?>

<?php
  require("search_bar.php");
?>

<?php
  $limit = 3;
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = ($page - 1) * $limit;

  // Showing All Active Categories Recent One First 

  $query = "SELECT * FROM category WHERE category_status = 'Active' ORDER BY category_id DESC LIMIT $start, $limit";
  $result = mysqli_query($connection, $query);

  if ($result->num_rows) {
?>

<div class="mt-5">
  <h1 class="text-center" id="categories">Categories</h1>
  <div class="mt-5 container text-center">
    <div class="row">

    <?php
      $i = 1;
      while ($data = mysqli_fetch_assoc($result)) {
    ?>

      <div class="col-md-4">
        <div class="card h-100">
          <img class="card-img-top" src="<?= $data['category_image']; ?>" alt="<?= $data['category_title']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $data['category_title']; ?></h5>
            <p class="card-text"><?= $data['category_description']; ?></p>
          </div>
          <div class="card-footer">
            <a href="show_category.php?category_id=<?= $data['category_id']; ?>" class="btn btn-primary">See More</a>
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
</div>

<div class="mt-5">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">

      <!-- Pagination On The Basis Of Total Active Categories -->

    <?php
      $query = "SELECT COUNT(*) as num_rows FROM category WHERE category_status = 'Active'";
      $result = mysqli_query($connection, $query);
      $data = mysqli_fetch_assoc($result);
      $num_pages = ceil($data['num_rows'] / $limit);

      for ($i = 1; $i <= $num_pages; $i++) {
        if ($i == $page) {
          echo '<li class="page-item active"><a class="page-link" href="categories.php?page=' . $i . '">' . $i . '</a></li>';
        } else {
          echo '<li class="page-item"><a class="page-link" href="categories.php?page=' . $i . '">' . $i . '</a></li>';
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
