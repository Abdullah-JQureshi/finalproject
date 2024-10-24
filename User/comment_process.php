<?php
  session_start();
	require("../require/database_connection.php");

	// Not Admin Or Nor Guest Can Access It

	if(!isset($_SESSION['user']['first_name']) && $_SESSION['user']['role_id'] != 2) {
        header('Location: login.php?message=Please Login First!&success=alert-warning');
    }

    // Adding Comment With All Values That Ajax Send

if (isset($_POST['action']) && $_POST['action'] == 'add_comment') {
	$query = "INSERT INTO post_comment(post_id, user_id, comment) VALUES ('".$_POST['post_id']."', '".$_POST['user_id']."', '".$_POST['comment']."')";

	$result = mysqli_query($connection, $query);

	if ($result) {
		echo "Comment Done Successfully";
	}else{
		echo "Can't Comment Error In System!";
	}
}

?>