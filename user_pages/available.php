<?php
session_start();
include('../includes/check_user_login.php');
include('../connection.php');
$name = $_SESSION['name'];

$counters = $conn->query("SELECT COUNT(*) AS counter FROM reservation;");
$counter = $counters->fetch_assoc();
$total = $counter['counter'];

$check_in = "";
$check_out = "";
$product = "";
$amount = "";

$total_amount = "";

// Deleting Data
if (isset($_GET['deleteid'])) {

   $id = $_GET['deleteid'];


   $delete = "DELETE FROM reservation WHERE id = $id";
   $result = mysqli_query($conn, $delete);

   header('location: available.php#packages');
}

// Check Out Data


if (isset($_POST['checkOutcart'])) {
   $id = $_GET['checkoutid'];

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

   $info = "Updated Successfully!";

   header('location: home.php');
}


// booking
if (isset($_GET['bookid'])) {
   $id = $_GET['bookid'];

   $get_data = "SELECT * FROM room WHERE id = $id";
   $run_data = mysqli_query($conn, $get_data);

   while ($row = mysqli_fetch_assoc($run_data)) {
      $room_price = $row['price'];

      $start_date = new DateTime($_SESSION['check_in']);
      $end_date = new DateTime($_SESSION['check_out']);

      // Outputs the number of days in start and end calendar selection
      $count_days = $end_date->diff($start_date)->format("%a");

      $product = $count_days * $room_price;
      // = $total;

      // assigning input variables
      $reserver_name = $name;
      $number_nights = $count_days;
      $amount = $product;
      $total_amount = $product * $total;
      $price = $row['price'];
      $check_in = $_SESSION['check_in'];
      $check_out = $_SESSION['check_out'];
      $room_name = $row['room_name'];



      $sql = "INSERT INTO reservation (reserver_name, amount, number_nights, price, check_in, check_out, room_name, total)
        VALUES ('$reserver_name', '$amount', '$number_nights', '$price', '$check_in', '$check_out', '$room_name', '$total_amount')";
      $result = mysqli_query($conn, $sql);

      $sql_update = "UPDATE room SET check_in = '$check_in', check_out = '$check_out' WHERE id = $id";
      $result1 = mysqli_query($conn, $sql_update);

      $info = "Added Successfully!";
   }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Rooms</title>
   <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
   <?php include('../includes/head.php'); ?>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/lightbox.css">


</head>

<body>

   <!-- header section starts  -->

   <?php include('navbar.php'); ?>
   <!-- header section ends -->

   <!-- packages section starts  -->

   <section class="packages">

      <h1 class="heading-title">AVAILABLE ROOMS</h1>
      <?php include('calendar.php'); ?>
      <div class="box-container">
         <?php
         if (isset($_POST['check_availability'])) {
            $_SESSION['check_in'] = $_POST['check_in'];
            $_SESSION['check_out'] = $_POST['check_out'];
            $check_in = $_SESSION['check_in'];
            $check_out = $_SESSION['check_out'];

            $room_data = "SELECT * FROM room WHERE booking_status = 'Available'";
            $run_data = mysqli_query($conn, $room_data);
            $queryResult = mysqli_num_rows($run_data);



            if ($queryResult > 0) {
               $i = 0;
               while ($row = mysqli_fetch_assoc($run_data)) {
                  $no = ++$i;
                  $id = $row['id'];
                  $room_name = $row['room_name'];
                  $description_1 = $row['description_1'];
                  $description_2 = $row['description_2'];
                  $price = $row['price'];
                  $status = $row['booking_status'];
                  $image = $row['image'];

         ?>
                  <div class="box">
                     <div class="image">
                        <a href="../images/bunga-1.jpg" data-lightbox="bungalow" data-title="Bungalow Beachfront Villa">
                           <img src="../images/<?php echo $image; ?>" alt="">
                        </a>
                     </div>
                     <div class="content">
                        <h2><?php echo $room_name; ?></h2>
                        <h2>PHP <?php echo $price; ?>/night</h2>
                        <p><?php echo $description_1; ?></p>
                        <p><?php echo $description_2; ?></p>
                     </div>
                     <div class="container text-center mb-5 mt-auto">
                        <a type="submit" href="available.php?bookid=<?php echo $id; ?>" class="btn-custom">book now</a>
                     </div>
                  </div>
               <?php
               }
               ?>
            <?php
            }
            ?>
         <?php
         }
         ?>
   </section>

   <?php include('cart.php'); ?> 
   <!-- packages section ends -->

   <!-- Delete Modal -->
   <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="container-fluid text-center">
                  <h4 style="font-weight: 500; ">Are you sure you want to delete this data?</h4>
               </div>
               <a href="available.php?deleteid=<?php echo $id; ?>" class="btn btn-danger mt-3 float-right">Delete</a>
            </div>
         </div>
      </div>
   </div>


   <!-- Check Out Modal -->
   <div class="modal fade" id="checkOut<?php echo $id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h3 class="modal-title" id="staticBackdropLabel">Check Out Reservation</h3>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="available.php?checkoutid=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                  <div class="row mt-3">
                     <div class="col-lg">
                        <span>Address</span>
                        <input type="address" placeholder="Complete Address" name="address" class="form-control" required>
                     </div>

                     <div class="col-lg">
                        <span>Email</span>
                        <input type="email" placeholder="Email Address" name="email" class="form-control" required>
                     </div>
                  </div>

                  <div class="row mt-3">
                     <div class="col-lg">
                        <span>Number of Adults</span>
                        <input type="number" placeholder="Number of Adults" name="adult" class="form-control" required>
                     </div>

                     <div class="col-lg">
                        <span>Number of Kids 10 Years Old/Below:</span>
                        <input type="number" placeholder="Number of Children" name="children" class="form-control" required>
                     </div>
                  </div>

                  <div class="row mt-3">
                     <div class="col-lg">
                        <span>Phone Number</span>
                        <input type="text" placeholder="Mobile Number" name="phone" class="form-control" required>
                     </div>
                  </div>

                  <div class="row mt-3">
                     <div class="col-lg">
                        <label for="">Upload Valid ID:</label>
                        <input type="file" name="valid_id" class="form-control-file" required>
                     </div>
                     <div class="col-lg">
                        <label for="">Upload Proof of Payment:</label>
                        <input type="file" name="payment" class="form-control-file">
                     </div>
                  </div>
                  <button type="submit" name="checkOutcart" class="btn btn-primary mt-4" style="width: 100%; ">Submit</button>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   </div>













   <!-- footer section starts  -->

   <section class="footer">

      <div class="box-container">

         <div class="box">
            <h3>quick links</h3>
            <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
            <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
            <a href="package.php"> <i class="fas fa-angle-right"></i> package</a>
            <a href="book.php"> <i class="fas fa-angle-right"></i> book</a>
         </div>

         <div class="box">
            <h3>extra links</h3>
            <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
            <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
            <a href="#"> <i class="fas fa-angle-right"></i> privacy policy</a>
            <a href="#"> <i class="fas fa-angle-right"></i> terms of use</a>
         </div>

         <div class="box">
            <h3>contact info</h3>
            <a href="#"> <i class="fas fa-phone"></i> +63929 828 2781 </a>
            <a href="#"> <i class="fas fa-envelope"></i>pilibeach@yahoo.com</a>
            <a href="#"> <i class="fas fa-map"></i>Cabalian St. Sta. Fe, Romblon</a>
         </div>

         <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
         </div>

      </div>

      <div class="credit"> All rights reserved! 2022 </div>

   </section>

   <!-- footer section ends -->









   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

   <!-- swiper js link  -->
   <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

   <!-- custom js file link  -->
   <script src="../js/script.js"></script>

   <script src="../js/lightbox-plus-jquery.js"></script>

</body>

</html>