<?php
require 'config/database.php';

if(isset($_GET['id'])) {
    //fetch user from database
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch user from database
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    //make sure we got only one user
    /*
    if(mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;

        //delete image if found 
        if($avatar_path){
            unlink($avatar_path);
        }
    }
    */
    // delete all post of that user



    // delete user from database
    $delete_user_query = "DELETE FROM users WHERE id = $id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);

    if(mysqli_errno($connection)){
        $_SESSION['delete-user'] = "Error occurs! '{$user['firstname']}' '{$user['lastname']}' Couldn't delete";
    }
    else {
        $_SESSION['delete-user-success'] = "'{$user['firstname']}' '{$user['lastname']}' deleted successfully";
    }
}

header('locaton: ' . ROOT_URL . 'admin/manage-users.php');
die();
?>