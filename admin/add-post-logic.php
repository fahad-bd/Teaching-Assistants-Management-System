<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $author_id = $_SESSION['user-id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    // set is_feeaturd to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //validate form data
    if(!$title){
        $_SESSION['add-post'] = "Add title.";
    }
    else if(!$category_id){
        $_SESSION['add-post'] = "Seletct category.";
    }
    else if(!$body){
        $_SESSION['add-post'] = "Add a body for post.";
    }
    else if(!$thumbnail['name']){
        $_SESSION['add-post'] = "Upload a thumbnail.";
    }
    else {
        //work on picture
        $thumbnail_name = $thumbnail['name'];
        $thumbnail_tmp_name = $thumbnail['tmp_name'];
        $thumbnail_destination_path = '../images/' .$thumbnail_name;

        $allowed_files = ['png','jpg','jpeg'];
        $extension = explode('.', $thumbnail_name);
        $extension = end($extension);

        if(in_array($extension, $allowed_files)){
            //make sure image is not too big (1mb);
            if($thumbnail['size'] < 1000000){
                //upload file to images file
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);

            }
            else {
                $_SESSION['add-post'] = "File size too big. Should be less than 1MB";
            }
        }
        else {
            $_SESSION['add-post'] = "File should be png, jpg, or jpeg.";
        }
    }

    //if occer error go to the form
    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    }
    else{
        //add post to database
        //set is_featured of all posts to 0 if this post is_featured is 1
        if($is_featured == 1){
            $zero_all_is_featured_qurey = "UPDATE posts SET is_featured = 0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_qurey);
        }

        //insert post to db
        $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES ('$title', '$body', '$thumbnail_name', $category_id, $author_id, 0)";
        $result = mysqli_query($connection, $query);

        if(!mysqli_errno($connection)){
            $_SESSION['add-post-success'] = "New post added successfull.";
            header('location: ' . ROOT_URL . 'admin/index.php');
            die();
        }
    }
}
else { 
    header('location: ' . ROOT_URL . 'admin/add-post.php');
    die();
}
?>