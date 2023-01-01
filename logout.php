<?php
require 'config/constants.php';

//destroy all session and redirect user to login age
session_destroy();
header('location: ' . ROOT_URL . 'faculty.php');
die();
?>