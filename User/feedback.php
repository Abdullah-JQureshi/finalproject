<?php
  session_start();
	require("../require/header.php");
?>


<?php 
	require("slider.php");  
    $user_id =  isset($_SESSION['user'])? $_SESSION['user']['user_id']: "";
?>

<script>

    // Adding Feedback Through AJAX

    function add_feedback() {

        // Checking If All Fields Have Value Or Not Because When User Login It Don't Have All Fields Available

        var user_id = document.getElementById('user_id') ? document.getElementById('user_id').value : '';
        var user_name = document.getElementById('user_name') ? document.getElementById('user_name').value : '';
        var user_email = document.getElementById('user_email') ? document.getElementById('user_email').value : '';
        var feedback = document.getElementById('feedback') ? document.getElementById('feedback').value : '';
        var ajax_request = null;

        if (window.XMLHttpRequest) {
            ajax_request = new XMLHttpRequest();
        }else{
            ajax_request = ActiveXObject("Microsoft.XMLHttp");
        }

        ajax_request.onreadystatechange = function(){
                if (ajax_request.readyState == 4 && ajax_request.status == 200 && ajax_request.statusText == 'OK') {
                    document.getElementById('show_message').innerHTML = ajax_request.responseText;
                }
            }

        ajax_request.open("POST", "feedback_process.php");
        ajax_request.setRequestHeader("content-type", "application/x-www-form-urlencoded");
        ajax_request.send("action=add_feedback&user_id="+user_id+"&user_name="+user_name+"&user_email="+user_email+"&feedback="+feedback);
        

    }
</script>

        <div class="container">
		  <div class="contact-form article-comment mt-5">
                <h1 class="text-center">Feedback</h1>
                    <!-- <form id="contact-form" method="POST"> -->
                    <input type="hidden" name="user_id" id="user_id" value="<?= $user_id?>">
                        <div class="row mt-5">

                            <!-- If User Not Login Than It Will Show All Fields OtherWise Only Feedback Field -->

                            <?php
                                if (!isset($_SESSION['user'])) {
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="user_name" id="user_name" placeholder="Full Name" class="form-control" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="user_email" id="user_email" placeholder="Email" class="form-control" type="email" required>
                                </div>
                            </div>
                            <?php 
                                }
                            ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea name="feedback" id="feedback" placeholder="Feedback" rows="4" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="send">
                                    <button class="px-btn theme" id="feedback_button" onclick="add_feedback()"><span>Submit</span> <i class="arrow"></i></button>
                                </div>
                            </div>
                            <div id="show_message"></div>
                        </div>
                    <!-- </form> -->
            </div>
        </div>


<?php
	require("../require/footer.php");
?>