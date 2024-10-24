<?php
	require("admin_header.php");

    // Showing All Categories

	$query = "SELECT * FROM category ORDER BY category_id DESC";

    $result = mysqli_query($connection, $query);

    // Updating Category Setting Taking Query String And Checking It

    if(isset($_GET["action"]) && isset($_GET["id"])) {
        $id = intval($_GET["id"]);

        // Category Inactive

        if($_GET["action"] == "inactive"){
            $query = "UPDATE category SET category_status='InActive' WHERE category_id ={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: category_setting.php?message=Category InActive Successfully!&success=alert-warning");
            } else {
                header("Location: category_setting.php?message=Category Has Not Been InActive Try Again !...&success=alert-danger");
            }
        } else if($_GET["action"] == "active"){

            // Category Active

            $query = "UPDATE category SET category_status= 'Active' WHERE category_id={$id}";
            $result = mysqli_query($connection, $query);

            if($result){
                header("Location: category_setting.php?message=Category Active Successfully!&success=alert-success");
            } else {
                header("Location: category_setting.php?message=Category Has Not Been Active Try Again !...&success=alert-danger");
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
				          <h1 class="text-dark display-4 fw-bold text-center mb-4">Category Setting</h1>
		                    <hr class="mb-5" />
		                    <table id="category_setting" class="table table-striped" style="width:100%">
		                        <thead>
		                        	<?php if(mysqli_num_rows($result) > 0 ){ ?>
		                            <tr>
		                                <th>ID No</th>
		                                <th>Title</th>
		                                <th>Description</th>
		                                <th>Image</th>
		                                <th>Status</th>
		                                <th>Created At</th>
                                        <th>Updated At</th>
		                                <th>Action</th>
		                            </tr>
		                        </thead>
		                        <tbody>
                                   <?php while($data = mysqli_fetch_assoc($result)){ ?>
                                    <tr>
                                        <td><?= $data['category_id']?></td>
                                        <td><?= $data['category_title']?></td>
                                        <td><?= $data['category_description']?></td>
                                        <td><img src="<?= $data['category_image']; ?>" class="img-fluid square me-2" width="50"></td>
                                        <td><?= $data['category_status']?></td>
                                        <td><?= $data['created_at']?></td>
                                        <td><?= $data['updated_at']?></td>
                                        <td><a class="btn btn-success btn-gradient"href="add_category.php?action=edit&category_id=<?= $data["category_id"]; ?>">Edit</a>
                                            <?php if ($data['category_status'] == 'Active') { ?>
                                                <a class="btn btn-danger btn-gradient" href="category_setting.php?action=inactive&id=<?=$data['category_id']?>">InActive</a>
                                            <?php } else { ?>
                                                <a class="btn btn-success btn-gradient" href='category_setting.php?action=active&id=<?=$data['category_id']?>'>Active</a>
                                            <?php } ?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                <?php }   else {?>
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
                                $('#category_setting').DataTable({
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