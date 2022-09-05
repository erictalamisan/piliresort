<?php
session_start();
include('../includes/check_user_login.php');
include('../connection.php');
$name = $_SESSION['name'];

$counters = $conn->query("SELECT COUNT(*) AS counter FROM reservation;");
$counter = $counters->fetch_assoc();
$total = $counter['counter'];


if (isset($_SESSION['info'])) {
   $info = $_SESSION['info'];
} else {
   $info = "";
}

$check_in = "";
$check_out = "";
$product = "";

$total_amount = "";


//Update Modal

if (isset($_POST['updatePayment'])) {

    //image upload
    $msg = "";
    $payment = $_FILES['payment']['name'];
    $target = "../upload_images/" . basename($payment);

    if (move_uploaded_file($_FILES['payment']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }


   $sql = "UPDATE reservation SET payment = '$payment'";
   $result = mysqli_query($conn, $sql);

   header('location: home.php');
}



// Deleting Data
if (isset($_GET['deleteid'])) {

   $id = $_GET['deleteid'];


   $delete = "DELETE FROM reservation WHERE id = $id";
   $result = mysqli_query($conn, $delete);

   header('location: home.php');
}


// booking
if (isset($_GET['bookid'])) {
   $id = $_GET['bookid'];
   $check_in = $_GET['check_in'];
   $check_out = $_GET['check_out'];

   $get_data = "SELECT * FROM room WHERE id = $id";
   $run_data = mysqli_query($conn, $get_data);

   if ($check == false && $check_out == false) {
      header('location: home.php');
      $_SESSION['date_error'] = "Date is empty!";

   } else {
      while ($row = mysqli_fetch_assoc($run_data)) {
         $room_price = $row['price'];
   
         $start_date = new DateTime($_SESSION['check_in']);
         $end_date = new DateTime($_SESSION['check_out']);
         $select_amount = "SELECT * FROM reservation WHERE id = $id";
         $run_query = mysqli_query($conn, $select_amount);

         $row = mysqli_fetch_assoc($run_query);

         $amount_fetch = $row['amount'];

         // Outputs the number of days in start and end calendar selection
         $count_days = $end_date->diff($start_date)->format("%a");
   
         $product = $count_days * $room_price;
         // = $total;
   
         // assigning input variables
         $reserver_name = $name;
         $number_nights = $count_days;
         $amount = $product;
         $total_amount = $amount_fetch + $amount_fetch;
         $_SESSION['total_amount'] = $total_amount;
         $price = $row['price'];
         $check_in = $_SESSION['check_in'];
         $check_out = $_SESSION['check_out'];
         $room_name = $row['room_name'];
   
   
   
         $sql = "INSERT INTO reservation (reserver_name, amount, number_nights, price, check_in, check_out, room_name, total)
           VALUES ('$reserver_name', '$amount', '$number_nights', '$price', '$check_in', '$check_out', '$room_name', '$total_amount')";
         $result = mysqli_query($conn, $sql);
   
         $sql_update = "UPDATE room SET check_in = '$check_in', check_out = '$check_out' WHERE id = $id";
         $result1 = mysqli_query($conn, $sql_update);
      }
   }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Bootstrap Meta Tag -->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Rooms</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

   <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">
   <?php include('../includes/head.php'); ?>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/lightbox.css">

   <style>
      .alert{
         font-weight: 600;
         font-size: 15px;
      }
   </style>
</head>

<body>

   <!-- header section starts  -->

   <?php include('navbar.php'); ?>
   <!-- header section ends -->
   
   <!-- packages section starts  -->
   
   <section class="packages" id="packages">
   <?php if ($info != "") {
                  ?>
                        <div class="container d-flex justify-content-center">
                           <span class="alert alert-success"> <?php echo $info; ?></span>
                        </div>
                  <?php
                  } ?>
      <div class="container text-center pb-5">
         <span class="font-weight-bold text-muted text-uppercase" style="font-size: 18px; ">
            <?php 
                  $_SESSION['date_error'] = "";

                  if ($_SESSION['date_error'] != "") {
                     echo $_SESSION['date_error'];
                  }
            ?>
         </span>
      </div>
      
    <!-- Reservation Table -->
    <div class="container p-3 mb-5 flex-column text-white" id="cart" style="border-radius: 6px; padding: 5px; box-shadow: 1px 1px 4px #000a22; ">
                  
     <div class="container table-responsive bg-light my-4 px-3 py-4" style="border-radius: 6px; ">
        <h2 class="pl-3 text-dark">Reservations</h2>
        <table class="table table-md table-striped text-center text-white bg-secondary" id="sampleTable">
           <thead class="thead-dark">
              <tr>
                 <th scope="col">#</th>
                 <th scope="col">Room Name</th>
                 <th scope="col">Number of Nights:</th>
                 <th scope="col">Check In</th>
                 <th scope="col">Check Out</th>
                 <th scope="col">Price</th>
                 <th scope="col">Amount</th>
                 <th scope="col">Valid ID</th>
                 <th scope="col">Payment Proof</th>
                 <th scope="col">Action</th>
              </tr>
           </thead>
           <tbody>
              <?php

                 $get_data = "SELECT * FROM reservation";
                 $run_data = mysqli_query($conn, $get_data);


                 $i = 0;
                 while ($row = mysqli_fetch_assoc($run_data)) {
                    $no = ++$i;
                    $id = $row['id'];
                    $reserver_name = $row['reserver_name'];
                    $amount = $row['amount'];
                    $number_nights = $row['number_nights'];
                    $price = $row['price'];
                    $check_in = $row['check_in'];
                    $check_out = $row['check_out'];
                    $room_name = $row['room_name'];
                    $valid_id = $row['valid_id'];
                    $payment = $row['payment'];

                    if ($reserver_name == $name) {
                 ?>
                       <tr>
                       <td><?php echo $no; ?></td>
                       <td><?php echo $room_name; ?></td>
                       <td><?php echo $number_nights; ?></td>
                       <td><?php echo $check_in; ?></td>
                       <td><?php echo $check_out; ?></td>
                       <td><?php echo $price; ?></td>
                       <td><?php echo $amount; ?></td> 
                       <td class="text-center">
                          
                                <?php if ($valid_id == false) {
                                   echo "<strong>Photo not yet available!</strong>";
                                } else {
                                ?>
                                <a href="../upload_images/<?php echo $valid_id; ?>">
                                   <img src="../upload_images/<?php echo $valid_id; ?>" style="width: 50px; height: 50px; " >
                                </a>
                                <?php
                                }
                                ?>
                          
                       </td>
                          <td class="text-center">
                             <?php if ($payment == false) {
                                   echo "<strong>Photo not yet available!</strong>";
                                } else {
                                ?>
                                <a href="../upload_images/<?php echo $payment; ?>">
                                   <img src="../upload_images/<?php echo $payment; ?>" style="width: 50px; height: 50px; " >
                                </a>
                                <?php
                                }
                             ?>
                       </td>
                       <td>
                          <span class="action-icons px-1">
                             <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#paymentModal<?php echo $id; ?>">
                                <i class='bx bxs-pencil'></i>
                             </a>
                          </span>
                          <span class="action-icons py-5">
                             <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class='bx bxs-trash-alt'></i>
                             </a>
                          </span>
                       </td>
                    </tr>
                 <?php
                    }
                 ?>
                    
                 <?php
                 }
                 ?>
           </tbody>
        </table>
     </div>
     <h3 class="text-dark ml-3" style="display: none;">Total Amount: <?php echo $total * $amount; ?></h3>
  </div>
  <!-- reservation table ends -->

      <?php include('calendar.php'); ?>
      <div class="box-container">
         <?php

         $room_data = "SELECT * FROM room order by 1 asc";
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
                     <a type="submit" href="home.php?bookid=<?php echo $id; ?>" class="btn-custom">book now</a>
                  </div>
               </div>
            <?php
            }
            ?>
         <?php
         }
         ?>
   </section>



   <!-- Update Modal -->
   <?php
        $get_data = "SELECT * FROM reservation";
        $run_data = mysqli_query($conn, $get_data);
        while ($row = mysqli_fetch_array($run_data)) {
            $id = $row['id'];
            
            $payment = $row['payment'];


    ?>
    <div class="modal fade" id="paymentModal<?php echo $id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Upload Payment Proof</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="exampleFormControlFile1">Upload Payment Proof</label>
                                    <input type="file" name="payment" value="<?php echo $payment; ?>" class="form-control-file" required>
                                </div>
                            </div>
                            <button type="submit" name="updatePayment" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>




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
               <a href="home.php?deleteid=<?php echo $id; ?>" class="btn btn-danger mt-3 float-right">Delete</a>
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