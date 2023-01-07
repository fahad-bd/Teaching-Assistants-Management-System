<?php
require 'config/database.php';

//fetch current user from database, show profile pic from DB
if(isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id = $id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMS</title>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="<?php echo ROOT_URL?>style/stylePost.css">

    <!-- IconScout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Google Font Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--------------------------------------- navigation bar ------------------------------------->
    <nav>
        <div class="container nav__container">
            <a href="<?php echo ROOT_URL?>coverPage/index.html"><img class="nav__logo" src="<?php echo ROOT_URL?>images/logo.png" alt="logo"></a>
            <ul class="nav__items">
                <li><a href="<?php echo ROOT_URL?>faculty.php">Faculty</a></li>
                <li><a href="<?php echo ROOT_URL?>ta.php">Teaching Assistant</a></li>
                <li><a href="<?php echo ROOT_URL?>blog-notic.php">Post</a></li>
                <!-- <li><a href="<?php echo ROOT_URL?>about.php">About</a></li> -->
                <!-- <li><a href="<?php echo ROOT_URL?>services.php">Services</a></li> -->
                <li><a href="<?php echo ROOT_URL?>massagePage/sms.html">Contact</a></li>

                <!-- if already login then show profile or show login option -->
                <?php if(isset($_SESSION['user-id'])) : ?>
                    <li class="nav__profile">
                        <div class="avatar">
                            <img src="<?=ROOT_URL . 'images/' . $avatar['avatar']?>">
                        </div>
                        <ul>
                            <li><a href="<?php echo ROOT_URL?>admin/index.php">Dashboard</a></li>
                            <li><a href="<?php echo ROOT_URL?>logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else : ?>    

                <li><a href="<?php echo ROOT_URL?>signin.php">Sign In</a></li>
                
                <?php endif ?>
            </ul>

            <!-- hamburger icon -->
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-times-square"></i></button>
        </div>
    </nav>
    <!----------------------------------------- end nav bar --------------------------------------->
