<?php
    session_start();
    require("../require/header.php");
    if(isset($_SESSION['user'])){
        header("Location: index.php");
    }

    require('server_side_validation.php');

    // Checking If All Fields Validation Is Working And $data Is True Then It will Work

    if($data??''){

            $dir = "../User_Image";
            if(!is_dir($dir)){
                if(!mkdir($dir)){
                    echo "Could Not Create Directory!!";
                }
            }

            extract($_POST);
            $tmp_name = $_FILES["user_image"]["tmp_name"];
            $user_image = time()."_".$_FILES["user_image"]["name"];
            $path = $dir."/".$user_image;

            if(move_uploaded_file($tmp_name,$path)){

                $query = "INSERT INTO USER(`first_name`, `last_name`, `email`, `password`, `gender`, `date_of_birth`,`user_image`,`address`) VALUES('$first_name', '$last_name', '$email', '$password', '$gender', '$date_of_birth', '$path', '$address')";

                if($result = mysqli_query($connection, $query)){
                    header("Location: login.php?message=Registration Successfull!&success=alert-success"); 
                    exit();
                }
                else{
                    echo "Error : " . $query . "<br>" . mysqli_error($connection);
                }
            }else{echo "Invalid";}
        }  
        mysqli_close($connection);

?>



    <style>
        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            margin-top: 50px;
        }

        @media (max-width: 576px) {
            .form-container {
                margin-top: 20px;
            }
        }
        span{
            color: red;
        }
    </style>

<!-- If Any Field Empty Or Not As Required Then Form Will Not Submit Or Insert Record In DataBase And All Fields Will Hold Thier Value -->

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-container">
                <h1 class="text-center mb-4">Signup</h1>
                <p class="text-center">Already Have An Account? <a href="login.php" class="text-decoration-none">Login Now</a></p>
                <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return validate()">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" value="<?= $first_name??""; ?>" class="form-control" id="first_name">
                        <span class="mb-3" id="first_name_msg"><?=  $first_name_msg??"";  ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="<?=  $last_name_??"";  ?>" class="form-control" id="last_name">
                        <span class="mb-3" id="last_name_msg"><?=  $last_name_msg??"";  ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" id="email" value="<?=  $email??"";  ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                        <span class="mb-3" id="email_msg"><?=  $email_msg??"";  ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" value="<?=  $password??"";  ?>" id="password" class="form-control" id="exampleInputPassword1">
                        <span class="mb-3" id="password_msg"><?=  $password_msg??"";  ?></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender:</label>&nbsp;
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?= (isset($gender) && $gender == "Male")?'checked':'';  ?>>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?= (isset($gender) && $gender == "Female")?'checked':'';  ?>>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <span class="mb-3" id="gender_msg"><?=  $gender_msg??"";  ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date Of Birth</label>
                        <input type="date" name="date_of_birth" value="<?=  $date_of_birth??"";  ?>" class="form-control" id="date_of_birth">
                        <span class="mb-3" id="date_of_birth_msg"><?=  $date_of_birth_msg??"";  ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="user_image" class="form-label">Upload Image</label>
                        <input type="file" name="user_image" class="form-control" id="user_image">
                        <span class="mb-3" id="user_image_msg"><?=  $user_image_msg??"";  ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" class="form-control" id="address"><?=  $address??"";  ?></textarea>
                        <span class="mb-3" id="address_msg"><?=  $address_msg??"";  ?></span>
                    </div>
                    <div class="mb-3 text-center">
                        <input type="submit" name="signup" value="Signup" class="btn btn-dark btn-gradient w-100">
                        <input type="reset" class="btn btn-tertiary" value="Cancel">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
<?php
    require("../require/footer.php");
?>

