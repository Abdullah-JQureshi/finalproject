<?php

if (isset($_POST['signup'])) {
    $flag = true;
    extract($_POST);

    $user_image = $_FILES['user_image'];

    // Pattern For Name
    $alpha_pattern = "/^[A-Z]{1}[a-z]{2,}$/";

    // Pattern For Email
    $email_pattern = "/^[a-z]+\d*[@]{1}[a-z]+[.]{1}(com|net){1}$/";



    // Span message
    $first_name_msg = null;
    $last_name_msg = null;
    $email_msg = null;
    $password_msg = null;
    $gender_msg = null;
    $address_msg = null;
    $date_of_birth_msg = null;
    $user_image_msg = null;


    // First Name Validation
    if ($first_name == "") {
        $flag = false;
        $first_name_msg = "First Name is Required!";
    } else {
        $first_name_msg = "";
        if (!preg_match($alpha_pattern, $first_name)) {
            $flag = false;
            $first_name_msg = "First Name Should Be Like Ali/Ahmed";
        }
    }


    // Last Name Validation
    if ($last_name == "") {
        $flag = false;
        $last_name_msg = "Last Name is Required!";
    } else {
        $last_name_msg = "";
        if (!preg_match($alpha_pattern, $last_name)) {
            $flag = false;
            $last_name_msg = "First Name Should Be Like Khan/Shaikh";
        }
    }


    // Email Validation
	if($email == ""){
    $flag = false;
    $email_msg = "Email is Required!";
	} else {
	    if (!preg_match($email_pattern, $email)) {
	        $flag = false;
	        $email_msg = "Email Be Like ali20@gmail.com";
	    }
	}


	// Password Validation
	if ($password == "") {
		$flag = false;
		$password_msg = "Password is Required!";
	}else{
		$password_msg = "";
	}



	// Gender Validation
	if (!isset($gender)) {
		$flag = false;
		$gender_msg = "Gender is Required!";
	}else{
		$gender_msg = "";
	}


	// Address Validation
	if ($address == "") {
		$flag = false;
		$address_msg = "Address is Required!";
	}else{
		$address_msg = "";
	}


	// DateOfBirth Validation
	if ($date_of_birth == "") {
		$flag = false;
		$date_of_birth_msg = "Date of Birth is Required!";
	}else{
		$date_of_birth_msg = "";
	}


	// Image Validation
	if ($user_image == "") {
		$flag = false;
		$user_image_msg = "Profile Picture is Required!";
	}else{
		$user_image_msg = "";
	}



		if ($flag == true){
			$data = true;
			return $data;		
		}else{
			return false;
		}
}
?>