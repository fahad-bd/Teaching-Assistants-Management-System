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
    else if(isset($_SESSION['edit-profile'])){
        header('location: ' . ROOT_URL . 'admin/manage-profile.php');
        die();
    }
    else {
        // update user
        $query = "UPDATE profile SET name = '$name', description = '$description', profilePic = '$fileName' , is_ta = $is_ta WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

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