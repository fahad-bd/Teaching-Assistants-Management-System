<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //update category_id for the deleted category post to id of uncategorised 
    $update_query = "UPDATE posts SET category_id = 5 WHERE category_id = $id";
    $update_result = mysqli_query($connection, $update_query);

    
    
    if(!mysqli_errno($connection)){

        // if this is defalt category that will be not able to delete
        if($id == 5 || $id == 6 || $id == 7){
            $_SESSION['delete-category'] = "Defalt category cannot be deleted.";
        }
        else{ 
            // delete category
            $query = "DELETE FROM categories WHERE id = $id LIMIT 1";
            $result = mysqli_query($connection, $query);
            $_SESSION['delete-category-success'] = "Category deleted successfully.";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
?>