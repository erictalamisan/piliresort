<?php
session_start();

$name = $_SESSION['name'];

if (isset($_GET['user_type'])) {
    
    if ($_GET['user_type'] == "Administrator") {
        header('location: admin/reservation.php');
    } else {
        header('location: user_pages/home.php');
    }
}