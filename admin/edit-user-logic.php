<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    //get updated data from form
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $fileName = $_FILES["avatar"]["name"];

    //check for valid input
    if(!$firstname || !$lastname){
        $_SESSION['edit-user'] = "Invalid Input for edit user.";
    }
    else {
        if($fileName){ 
        $targetDir = "../images/";
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = ['png', 'jpg', 'jpeg'];

        if(in_array($fileType, $allowTypes)){
            // make sure image is not too large (1mb)
            if($thumbnail['size'] < 1000000){
                //upload profile pic
                move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $targetFilePath);
            }
            else {
                $_SESSION['edit-user'] = "File size too large. Should be less then 1MB";
            }
        }
        else {
            $_SESSION['edit-user'] = "File should be png, jpg, or jpeg";
        } 
    }
    }


    if(isset($_SESSION['edit-user'])){
        header('location: ' . ROOT_URL . 'admin/manage-user.php');
        die();
    }
    else { 
        // update user
        if($fileName){
            $query = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', avatar = '$fileName', is_admin = $is_admin WHERE id = $id LIMIT 1";
            $result = mysqli_query($connection, $query);
        }
        else {
            $query = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', is_admin = $is_admin WHERE id = $id LIMIT 1";
            $result = mysqli_query($connection, $query);
        }

        if(mysqli_errno($connection)){
            $_SESSION['edit-user'] = "Failed to update user.";
        }
        else {
            $_SESSION['edit-user-success'] = "User $firstname $lastname updated successfully.";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();
?>