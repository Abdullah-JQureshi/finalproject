<?php
    session_start();
    require("../require/header.php");

    // If User Login It Can't Acces Login Page

    if(isset($_SESSION['user'])){
        header("Location: index.php");
    }
    if(isset($_POST['login'])){
        
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Checking If Input Email And Password Matches From DataBase

        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($connection, $query);

        // If Empty Input Fields

        if(empty($_POST['email']) || empty($_POST['password'])){
            header("Location: login.php?message=Please Enter Email and Password First!&success=alert-warning");
            exit();
        }

        if($result->num_rows){
                
            $data = mysqli_fetch_assoc($result);

            $_SESSION["user"] = $data;

            // If User Is Approved And Active And Role Is Admin Then It Should Redirect It To Admin Page

            if($_SESSION["user"]["role_id"] == 1 && $_SESSION["user"]["is_approved"] == "Approved" && $_SESSION["user"]["is_active"] == "Active"){
                header("Location: ../admin/index.php");
            }
            else if($_SESSION["user"]["role_id"] == 2){

                // If User Has Inactive Status
                    
                if($_SESSION["user"]["is_active"]=="InActive"){

                    // If User Is Approved and Has Inactive Status

                    if($_SESSION["user"]["is_approved"] == "Approved"){
                        unset($_SESSION["user"]);
                        header("Location: login.php?message=Your Account is Inactive Please Contact Admin!&success=alert-warning");
                    }
                    else if($_SESSION["user"]["is_approved"] == "Pending"){

                        // If User Is In Pending and Has Inactive Status

                        unset($_SESSION["user"]);
                        header("Location: login.php?message=Your Account is in Pending!&success=alert-warning");
                    }
                    else if($_SESSION["user"]["is_approved"] == "Rejected"){

                        // If User Is Rejected and Has Inactive Status

                        unset($_SESSION["user"]);
                        header("Location: login.php?message=Your Account is Rejected By Admin!&success=alert-danger");
                    }  
                }
                else{
                    header("Location: index.php");
                }
            }  
                
        }else{
            header("Location: login.php?message=Incorrect Email Or Password&success=alert-danger");
            exit();
        }     
    }
?>


    <style>
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-top: 50px;
        }

        @media (max-width: 576px) {
            .form-container {
                margin-top: 20px;
            }
        }
    </style>


<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-container">
                <h1 class="text-center mb-4">Login</h1>
                <?php 
                        if(isset($_GET['message']) && isset($_GET['success'])){ ?>
                        <div class="alert <?php echo $_GET['success'];?> alert-dismissible fade show" role="alert">
                            <div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <p class="message text-center"><?php echo $_GET['message'];?></p>
                            </div>
                        </div>
                <?php } ?>
                <p class="mt-3 text-center">Don't have an account? <a href="register.php" class="text-decoration-none">Sign up now</a></p>
                <form method="POST" action="#">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                            Forgot Password?
                        </button>

                        <div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
                            <div class="modal-dialog" style="width: 300px;">
                                <div class="modal-content text-center">
                                    <div class="modal-header h5 text-white bg-primary justify-content-center">
                                        Forgot Password
                                    </div>
                                    <div class="modal-body px-5">
                                        <p class="py-2">
                                            Enter your email address and we'll send you an email with instructions to reset your password.
                                        </p>
                                        <div class="form-outline">
                                            <input type="email" id="typeEmail" class="form-control my-3" placeholder="Enter Your Email" />
                                        </div>
                                        <button type="button" class="btn btn-primary w-100" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                                            Reset password
                                        </button>
                                        <div class="d-flex justify-content-between mt-4">
                                            <a class="" href="login.php">Login</a>
						                    <a class="" href="register.php">Register</a>
						                </div>
						            </div>
						        </div>
						    </div>
						</div>
                    </div>
                    <div class="mb-3 text-center">
                    	<input type="submit" name="login" value="Login" class="btn btn-dark btn-gradient w-100">
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
