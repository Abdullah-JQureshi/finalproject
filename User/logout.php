<?php

    // Destroying Session And Unsetting It So It Can Not Hold Any Data 

    session_start();
    require ("../require/database_connection.php");
    
    if(!isset($_SESSION['user']['user_id'])) {
        header('Location: login.php?message=Please Login First!');
    }

    unset($_SESSION);

    session_destroy();
    
    header("Location: login.php?message=Your Accout has been Logout Successfully!&success=alert-success");
?>