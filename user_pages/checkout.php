<?php
include('../connection.php');
session_start();
$name = $_SESSION['name'];

if (isset($_POST['submit'])) {
    $id = $_GET['checkOut'];
 
    $full_name = $name;
    $address = $_POST['address'];
    $email = $_POST['email'];
    $children = $_POST['children'];
    $adult = $_POST['adult'];
    $phone = $_POST['phone'];
 
    //image upload
    $msg = "";
    $valid_id = $_FILES['valid_id']['name'];
    $target = "../upload_images/" . basename($valid_id);
 
    if (move_uploaded_file($_FILES['valid_id']['tmp_name'], $target)) {
       $msg = "Image uploaded successfully";
    } else {
       $msg = "Failed to upload image";
    }
 
    //image upload
    $msg = "";
    $payment = $_FILES['payment']['name'];
    $target = "../upload_images/" . basename($payment);
 
    if (move_uploaded_file($_FILES['payment']['tmp_name'], $target)) {
       $msg = "Image uploaded successfully";
    } else {
       $msg = "Failed to upload image";
    }
 
    $sql = "UPDATE reservation SET full_name = '$full_name', address = '$address', email = '$email', children = '$children', adult = '$adult', phone = '$phone', valid_id = '$valid_id', payment = '$payment' WHERE id=$id";
    $result = mysqli_query($conn, $sql);
 
    $info = "Your reservation is submitted please wait. We will send the confirmation thru your email within 24hours. Thank you!";
    $_SESSION['info'] = $info;
    header('location: home.php');
 }