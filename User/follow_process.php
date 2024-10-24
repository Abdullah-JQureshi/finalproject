<?php

	// Guest Can't Access It

  session_start();
	require("../require/database_connection.php");

	if(!isset($_SESSION['user']['user_id'])) {
        header('Location: login.php?message=Please Login First!&success=alert-warning');
    }

    // Seeing First If Query String Has User ID And Blog ID Then Proceed It

if (isset($_REQUEST['user_id']) && isset($_REQUEST['blog_id']) &&  $_SESSION['user']['role_id'] != 1) {
	$user_id = $_GET['user_id'];
	$blog_id = $_GET['blog_id'];

	// Selecting If Previously User Follow OR Unfollow That Blog Or Not

	$query = "SELECT * FROM following_blog WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";

	$result = mysqli_query($connection, $query);

	if ($result->num_rows) {

		// If Result True Then It Check What Query String Contain Follow Or Unfollow

		if ($_GET['action'] == "followed") {

			// For Following Blog

			$query = "UPDATE following_blog SET status = 'Followed', updated_at = NOW() WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";

			$result = mysqli_query($connection, $query);
			if($result){
				header("location: show_blog.php?blog_id=$blog_id&message=Blog Followed Successfully!&success=alert-success");
			}else{
				echo "Can't Perform Action";
			}

			
		}else if($_GET['action'] == "unfollowed"){

			// For Unfollowing Blog

			$query = "UPDATE following_blog SET status = 'Unfollowed', updated_at = NOW() WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";

			$result = mysqli_query($connection, $query);
			if($result){
				header("location: show_blog.php?blog_id=$blog_id&message=Blog Unfollowed Successfully!&success=alert-success");
			}else{
				echo "Can't Perform Action";
			}
		}
		
	}else{

		// If User Don't Have Any Record Of Following That Blog Then It Will Insert Data And Follow That Blog

		$query = "INSERT INTO following_blog(follower_id, blog_following_id) VALUES('$user_id', '$blog_id' )";
		$result = mysqli_query($connection, $query);

		if($result){
			header("location: show_blog.php?blog_id=$blog_id&message=Blog Followed Successfully!&success=alert-success");
		}else{
				echo "Can't Perform Action";
			}
	}
}else{
	$blog_id = $_GET['blog_id'];
	header("location: show_blog.php?blog_id=$blog_id&message=Admin Can't Follow Blog!&success=alert-warning");
}

?>