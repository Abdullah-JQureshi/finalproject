function validate() {
    var flag = true;

    var alpha_pattern = /^[A-Z]{1}[a-z]{2,}$/;
    var email_pattern = /^[a-z]+\d*[@]{1}[a-z]+[.]{1}(com|net){1}$/;

    var first_name = document.getElementById("first_name").value;
    var last_name = document.getElementById("last_name").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var gender = document.querySelector("input[type='radio']:checked");
    var address = document.getElementById("address").value;
    var date_of_birth = document.getElementById("date_of_birth").value;
    var user_image = document.getElementById("user_image").files;


    var first_name_msg = document.getElementById('first_name_msg');
    var last_name_msg = document.getElementById('last_name_msg');
    var email_msg = document.getElementById('email_msg');
    var password_msg = document.getElementById('password_msg');
    var gender_msg = document.getElementById('gender_msg');
    var address_msg = document.getElementById('address_msg');
    var date_of_birth_msg = document.getElementById('date_of_birth_msg');
    var user_image_msg = document.getElementById('user_image_msg');


    if (first_name === "") {
        flag = false;
        first_name_msg.innerHTML = "First Name is Required!";
    } else {
        first_name_msg.innerHTML = "";
        if (alpha_pattern.test(first_name) === false) {
            flag = false;
            first_name_msg.innerHTML = "Fisrt Name Be Like Ali/Ahmed";
        }
    }


    if (last_name === "") {
        flag = false;
        last_name_msg.innerHTML = "Last Name is Required!";
    } else {
        last_name_msg.innerHTML = ""; 
        if (alpha_pattern.test(last_name) === false) {
            flag = false;
            last_name_msg.innerHTML = "Last Name Be Like Khan/Shaikh";
        }
    }


    if (email === "") {
        flag = false;
        email_msg.innerHTML = "Email is Required!";
    } else {
        email_msg.innerHTML = ""; 
        if (email_pattern.test(email) === false) {
            flag = false;
            email_msg.innerHTML = "Email Be Like ali20@gmail.com";
        }
    }


    if(password === ""){
        flag = false;
        password_msg.innerHTML = "Password is Required!";
    }
    else{
        password_msg.innerHTML = "";
    }


    if(date_of_birth === ""){
        flag = false;
        date_of_birth_msg.innerHTML = "Date of Birth is Required!";
    }
    else{
        date_of_birth_msg.innerHTML = "";
    }



    if(address === ""){
        flag = false;
        address_msg.innerHTML = "Address is Required!";
    }
    else{
        address_msg.innerHTML = "";
    }


    if(!gender){
        flag = false;
        gender_msg.innerHTML = "Gender is Required!";
    }
    else{
        gender_msg.innerHTML = "";
    }


    if (profilePicture.length == 0) {
        flag = false;
        user_image_msg.innerHTML = "Profile Picture is Required!";
    } else {
        user_image_msg.innerHTML = "";
    }


    if (flag === true) {
        return true;
    } else {
        return false;
    }
}