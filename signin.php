<?php
require 'config/constants.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMS</title>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="style/style.css">

    <!-- IconScout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Google Font Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>
</head>

<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign In</h2>
            <div class="alert__message success">
                <p>This is an success message</p>
            </div>
            <form action="">
                <input type="text" placeholder="Username or Email">
                <input type="password" placeholder="Password">
                <button class="btn" type="submit">Sign In</button>
                <!-- <small>Don't have an account? <a href="signup.html">Sign Up</a></small> -->
            </form>
        </div>
    </section>
</body>

</html>