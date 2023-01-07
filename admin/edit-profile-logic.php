<?php
require 'config/database.php';

if(isset($_POST['submit'])) {
    //get updated data from form
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_ta = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];
    $fileName = basename($_FILES["avatar"]["name"]);
    // echo "$fileName";
    // echo "$name";
    // echo "$description";
        
    //check for valid input
    if(!$name || !$description){
        $_SESSION['edit-profile'] = "Invalid Input for edit profile.";
    }
    else if($fileName){ 
        $targetDir = "../images/";
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = ['png', 'jpg', 'jpeg'];
        
        if(in_array($fileType, $allowTypes)){
            // make sure image is not too large (1mb)
            if($thumbnail['size'] < 1000000){
                //upload profile pic
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath);
            }
            else {
                $_SESSION['edit-profile'] = "File size too large. Should be less then 1MB";
            }
        }
        else {
            $_SESSION['edit-profile'] = "File should be png, jpg, or jpeg";
        } 
        
    }

    if(isset($_SESSION['edit-profile'])){
        header('location: ' . ROOT_URL . 'admin/manage-profile.php');
        die();
    }
    else {
        // update user

        if($fileName)
        {
            $query = "UPDATE profile SET name = '$name', description = '$description', profilePic = '$fileName' , is_ta = $is_ta WHERE id = $id LIMIT 1";
            $result = mysqli_query($connection, $query);
        }
        else {
            $query = "UPDATE profile SET name = '$name', description = '$description', is_ta = $is_ta WHERE id = $id LIMIT 1";
            $result = mysqli_query($connection, $query);
        }

        if(mysqli_errno($connection)){
            $_SESSION['edit-profile'] = "Failed to update profile.";
        }
        else {
            $_SESSION['edit-profile-success'] = "Profile $name updated successfully.";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-profile.php');
die();
?>