<?php
require 'config/database.php';

if(isset($_GET['id'])) {
    //fetch user from database
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch user from database
    $query = "SELECT * FROM profile WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $profile = mysqli_fetch_assoc($result);

    // delete user from database
    $delete_profile_query = "DELETE FROM profile WHERE id = $id LIMIT 1";
    $delete_profile_result = mysqli_query($connection, $delete_profile_query);

    if(mysqli_errno($connection)){
        $_SESSION['delete-profile'] = "Error occurs! Couldn't delete";
    }
    else {
        $_SESSION['delete-profile-success'] = "Deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-profile.php');
die();
?>