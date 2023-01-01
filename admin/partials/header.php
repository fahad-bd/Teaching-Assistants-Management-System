<?php
require '../partials/header.php';

//fetch current user from database, show profile pic from DB
// if(isset($_SESSION['user-id'])) {
//     $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
//     $query = "SELECT avatar FROM users WHERE id = $id";
//     $result = mysqli_query($connection, $query);
//     $avatar = mysqli_fetch_assoc($result);
// }


//check login status, if not go to login page
if(!isset($_SESSION['user-id'])) {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
?>

