<?php
require 'config/database.php';

// get profile data from form data if submit button was clicked

if(isset($_POST['submit'])){
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_ta = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];
    //echo $firstname, $lastname, $username, $email, $createpassword, $confirmpassword;
    //var_dump($avatar);

    // validate input values
    if(!$name){
        $_SESSION['add-profile'] = "Please enter the Name!";
    } 
    else if(!$description){
        $_SESSION['add-profile'] = "Please enter description!";
    }
    // else if(!$is_admin){
    //     $_SESSION['add-user'] = "Please select user role.";
    // }
    else if(!$avatar['name']){
        $_SESSION['add-profile'] = "Please select a profile picture!";
    }
    else {

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
                $_SESSION['add-profile'] = "File size too large. Should be less then 1MB";
            }
        }
        else {
            $_SESSION['add-profile'] = "File should be png, jpg, or jpeg";
        }   
    }
    //var_dump() return a array about picture details
    //var_dump($profile);


    //redirect back to signup page if there is any problem
    if(isset($_SESSION['add-profile'])) {
        //pass form data back to add user page
        $_SESSION['add-profile-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add-profile.php');
        die();
    }
    else {
        //insert new user in database
        // $insert_user_quary = "INSERT INTO users (firstname, lastname, username, email, password, avatar, is_admin, details) VALUES ('$firstname', '$lastname', '$username', '$email', '$hashed_password', '$avatar_name', 0,'null')";
        $insert_user_quary = "INSERT INTO profile (name, description, profilePic, is_ta) VALUES ('$name', '$description', '$fileName', $is_ta)";

        $insert_user_result = mysqli_query($connection, $insert_user_quary);

        if(!mysqli_errno($connection)){
            //redirect to login page with success message
            $_SESSION['add-user-success'] = "New Profile $name added successfully.";
            header('location: ' . ROOT_URL . 'admin/manage-profile.php');
            die();
        }
    }
}
else {
    // if button wasnot click, button put back in signup page
    header('location: ' . ROOT_URL . 'admin/add-profile.php');
    die();
}
?>