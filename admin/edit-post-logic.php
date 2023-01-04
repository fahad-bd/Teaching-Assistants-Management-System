<?php 
require 'config/database.php';

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    $is_featured = $is_featured == 1 ?: 0;

    //check input valide or not 
    if(!$title){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid title.";
    }
    else if(!$category_id){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid category.";
    }
    else if(!$body){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid body.";
    }
    else{
        //if input new thumbnail delete previous
        // if($thumbnail['name']){
        //     $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
        //     if($previous_thumbnail_path){
        //         unlink($previous_thumbnail_path);
        //     }
            
        //     $thumbnail_name = $thumbnail['name'];
        //     $thumbnail_tmp_name = $thumbnail['tmp_name'];
        //     $thumbnail_destination_path = '../images/' .$thumbnail_name;
            
        //     $allowed_file = ['png', 'jpg', 'jpeg'];
        //     $extension = explode('.', $thumbnail_name);
        //     $extension = end($extension);
            
        //     if(in_array($extension, $allowed_file)){
        //         //make sure image is not too big (1mb);
        //         if($thumbnail['size'] < 1000000){
        //             //upload file to images file
        //             move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                    
        //         }
        //         else {
        //             $_SESSION['add-post'] = "File size too big. Should be less than 1MB";
        //         }
        //     }
        //     else{
        //         $_SESSION['edit-post'] = "Couldn't update post. Thumbnail should be png, jpg, or jpeg.";
        //     }
        // }


        //try in another way
        $targetDir = "../images/";
        $fileName = basename($_FILES["thumbnail"]["name"]);
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
                $_SESSION['edit-post'] = "File size too large. Should be less then 1MB";
            }
        }
        else {
            $_SESSION['edit-post'] = "File should be png, jpg, or jpeg";
        } 
    }

    
    if(isset($_SESSION['edit-post'])){
        header('location: ' . ROOT_URL . 'admin/index.php');
        die();
    }
    else {
        if($is_featured == 1){
            $zero_all_is_featured_query = "UPDATE posts SET is_featurd = 0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }
        
        // $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
        
        $query = "UPDATE posts SET title = '$title', body = '$body', thumbnail = '$fileName', category_id = $category_id, is_featured = $is_featured WHERE id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);

        if(!mysqli_errno($connection)){
            $_SESSION['edit-post-success'] = "Post Update Successfull.";
            header('location: ' . ROOT_URL . 'admin/index.php');
            die();
        }
    }  

}
else { 
header('location: ' . ROOT_URL . 'admin/index.php');
die();
}
?>