<?php
  session_start();
	require("../require/database_connection.php");

	// Checking That If It's Contain Query String Or Not If Not Then It Should Redirect User To Main Page

if (isset($_POST['action']) && $_POST['action'] == 'add_feedback') {

	// Checking If Session Is Set Then It Will Send Feedback Through User ID 

	if (isset($_SESSION['user']) && isset($_SESSION['user']['user_id'])) {

		$query = "INSERT INTO user_feedback(user_id, feedback) VALUES ('".$_POST['user_id']."', '".$_POST['feedback']."')";

		$result = mysqli_query($connection, $query);

		if ($result) {
			echo "Feedback Sent Successfully";
		}else{
			echo "Feedback Didn't Sent!";
		}
		
	}else{

		// If Session Is Not Set Then It Will Send Feedback Through User Name And User Email That Guest Has Provided

		$query = "INSERT INTO user_feedback(user_name, user_email, feedback) VALUES ('".$_POST['user_name']."', '".$_POST['user_email']."', '".$_POST['feedback']."')";

		$result = mysqli_query($connection, $query);

		if ($result) {
			echo "Feedback Sent Successfully";
		}else{
			echo "Feedback Didn't Sent!";
		}

	}
}else{
	header("location: index.php");
}

?>