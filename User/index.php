<?php

	// Requiring All Things That I want To Show On My Main Page Basically It's a Glimpse Of Website

	session_start();
	require("../require/header.php");
?>

<?php 
	require("slider.php");  
?>

<?php 
	require("search_bar.php");  
?>

<?php 
	require("post_card.php");  
?>

<?php
	require("../require/footer.php");
?>