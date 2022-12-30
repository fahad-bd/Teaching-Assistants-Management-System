<?php
require 'config/database.php';

// get signup form data if signup button was clicked

if(isset($_POST['submit'])){
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $profile = $_FILES['profile'];
    //echo $firstname, $lastname, $username, $email, $createpassword, $confirmpassword;
    //var_dump($profile);

    // validate input values
    if(!$firstname){
        $_SESSION['signup'] = "Please enter your first name!";
    } 
    else if(!$lastname){
        $_SESSION['signup'] = "Please enter your last name!";
    }
    else if(!$username){
        $_SESSION['signup'] = "Please enter your Username!";
    }
    else if(!$email){
        $_SESSION['signup'] = "Please enter a valid email!";
    }
    else if(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
        $_SESSION['signup'] = "Password should be more than eight characters!";
    }
    else if(!$profile['name']){
        $_SESSION['signup'] = "Please select a profile picture!";
    }
    else {
        //check if passwrds don't match
        if($createpassword !== $confirmpassword){
            $_SESSION['signup'] = "Password do not match!";
        }
        else {
            //hash password
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
            // echo $createpassword . '<br/>';
            // echo $hashed_password;

            // check if username or email already exist in database
            $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
            $user_check_result = mysqli_query($connection,$user_check_query);

            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION['signup'] = "Username or Email alredy exist!";
            }
            else {
                // work on profile pic 
                // rename profile pic
                $time = time(); //make pic name unique by current time 
                $profilepic_name = $time . $profile['name'];
                $profilepic_tmp_name = $profile['tmp_name'];
                $profilepic_destination_path = 'images/' . $profilepic_name;
                
                // make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $profilepic_name);
                $extention = end($extention);

                if(in_array($extention, $allowed_files)){
                    // make sure image is not too large (1mb)
                    if($profile['size'] < 1000000){
                        //upload profile pic
                        move_uploaded_file($profilepic_tmp_name, $profilepic_destination_path);
                    }
                    else {
                        $_SESSION['signup'] = "File size too large. Should be less then 1MB";
                    }
                }
                else {
                    $_SESSION['signup'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }
    //var_dump() return a array about picture details
    //var_dump($profile);


    //redirect back to signup page if there is any problem
    if(isset($_SESSION['signup'])) {
        //pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location:' . ROOT_URL . 'signup.php');
        die();
    }
    else {
        //insert new user in database
        $insert_user_quary = "INSERT INTO users (firstname, lastname, username, email, password, profile, designation, details) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$profilepic_name', 3,'null')";

        $insert_user_result = mysqli_query($connection, $insert_user_quary);

        if(!mysqli_errno($connection)){
            //redirect to login page with success message
            $_SESSION['signup-success'] = "Registration successful. Please log in.";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
}
else {
    // if button wasnot click, button put back in signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
?>