<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch post from db
    $query = "SELECT * FROM posts WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) == 1){
        $post = mysqli_fetch_assoc($result);

        $delete_post_query = "DELETE FROM posts WHERE id = $id LIMIT 1";
        $delete_post_result = mysqli_query($connection, $delete_post_query);

        if(!mysqli_errno($connection)){
            $_SESSION['delete-post-success'] = "Post delete successfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/index.php');
die();
?>