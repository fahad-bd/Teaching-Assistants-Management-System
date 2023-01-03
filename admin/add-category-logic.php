<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    // get form data
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$title){
        $_SESSION['add-category'] = "Enter title.";
    }
    else if(!$description){
        $_SERVER['add-category'] = "Enter description.";
    }

    //if there is a error go to the add category page with previous input
    if(isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    }
    else {
        // insert category into database
        $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
        $result = mysqli_query($connection, $query);

        if(mysqli_errno($connection)){
            $_SESSION['add-category'] = "Category not added!";
            header('location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        }
        else {
            $_SESSION['add-category-success'] = "$title category added successfull.";
            header('location: ' . ROOT_URL . 'admin/manage-categories.php');
            die();
        }
    }
}
?>