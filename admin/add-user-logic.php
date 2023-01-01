<?php
require 'config/database.php';

// get add user data from form data if submit button was clicked

if(isset($_POST['submit'])){
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];
    //echo $firstname, $lastname, $username, $email, $createpassword, $confirmpassword;
    //var_dump($avatar);

    // validate input values
    if(!$firstname){
        $_SESSION['add-user'] = "Please enter your First Name!";
    } 
    else if(!$lastname){
        $_SESSION['add-user'] = "Please enter your Last Name!";
    }
    else if(!$username){
        $_SESSION['add-user'] = "Please enter your Username!";
    }
    else if(!$email){
        $_SESSION['add-user'] = "Please enter a valid email!";
    }
    // else if(!$is_admin){
    //     $_SESSION['add-user'] = "Please select user role.";
    // }
    else if(strlen($createpassword) < 8 || strlen($confirmpassword) < 8){
        $_SESSION['add-user'] = "Password should be more than eight characters!";
    }
    else if(!$avatar['name']){
        $_SESSION['add-user'] = "Please select a profile picture!";
    }
    else {
        //check if passwrds don't match
        if($createpassword !== $confirmpassword){
            $_SESSION['add-user'] = "Password do not match!";
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
                $_SESSION['add-user'] = "Username or Email alredy exist!";
            }
            else {
                // work on profile pic 
                // rename profile pic
                // $time = time(); //make pic name unique by current time 
                // $avatar_name = $time . $avatar['name'];
                // $avatar_tmp_name = $avatar['tmp_name'];
                // $avatar_destination_path = 'images/' . $avatar_name;
                
                // // make sure file is an image
                // $allowed_files = ['png', 'jpg', 'jpeg'];
                // $extention = explode('.', $avatar_name);
                // $extention = end($extention);

                // if(in_array($extention, $allowed_files)){
                //     // make sure image is not too large (1mb)
                //     if($avatar['size'] < 1000000){
                //         //upload profile pic
                //         move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                //     }
                //     else {
                //         $_SESSION['signup'] = "File size too large. Should be less then 1MB";
                //     }
                // }
                // else {
                //     $_SESSION['signup'] = "File should be png, jpg, or jpeg";
                // }

                //try in another way
                $targetDir = "../images/";
                $fileName = basename($_FILES["avatar"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                $allowTypes = ['png', 'jpg', 'jpeg'];

                if(in_array($fileType, $allowTypes)){
                    // make sure image is not too large (1mb)
                    if($avatar['size'] < 1000000){
                        //upload profile pic
                        move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath);
                    }
                    else {
                        $_SESSION['add-user'] = "File size too large. Should be less then 1MB";
                    }
                }
                else {
                    $_SESSION['add-user'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }
    //var_dump() return a array about picture details
    //var_dump($profile);


    //redirect back to signup page if there is any problem
    if(isset($_SESSION['add-user'])) {
        //pass form data back to add user page
        $_SESSION['add-user-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add-user.php');
        die();
    }
    else {
        //insert new user in database
        // $insert_user_quary = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin, details) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', 0,'null')";
        $insert_user_quary = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$fileName', $is_admin)";

        $insert_user_result = mysqli_query($connection, $insert_user_quary);

        if(!mysqli_errno($connection)){
            //redirect to login page with success message
            $_SESSION['add-user-success'] = "New user $firstname $lastname added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
}
else {
    // if button wasnot click, button put back in signup page
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
?>