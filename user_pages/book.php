<?php
// include('../includes/check_user_login.php');
session_start();
$name = $_SESSION['name'];
$id = $_GET['checkOut'];
include('../connection.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Bootstrap Meta Tag -->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Book</title>
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
         display: none;
      }
   </style>


</head>

<body>

   <!-- header section starts  -->
   <?php include('navbar.php'); ?>

   <!-- header section ends -->

   <div class="heading" style="background:url(../images/header-bg-3.png) no-repeat">
      <h1>book now</h1>
   </div>

   <!-- booking section starts  -->


   <div class="container bg-primary">

   </div>


   <section class="booking container">
      <form action="checkout.php?checkOut=<?php echo $id; ?>" method="post" enctype="multipart/form-data" class=book-form>
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

            <div class="col-lg">
               <span>Phone Number</span>
               <input type="text" placeholder="Mobile Number" name="phone" class="form-control" required>
            </div>
         </div>

         <!-- <div class="row mt-3">
               <div class="col-lg">
                     <label for="accomodation">Accomodation</label>
                     <select name="accomodation" id="" class="form-control">
                        <option value="">--Please choose an option--</option>
                        <option value="Standard">Bungalow Beachfront Villa (Php 7,000.00)</option>
                        <option value="Deluxe">Kia Ora A,B Or C(Php 7,000.00)</option>
                        <option value="Economy">Garden Bungalow 9A(Php 3,000.00)</option>
                        <option value="Economy">Poolside Bungalow Studio Room (Php 2,000.00)</option>
                        <option value="Economy">Garden Bungalow 8B (Php 2,000.00)</option>
                     </select>
               </div>
            </div> -->

         <!-- <div class="row mt-3">
               <div class="col-lg">
                  <span>Check In</span>
                  <input type="date" name="check_in" class="form-control">                                       
               </div> 
               <div class="col-lg">
                  <span>Check Out</span>
                  <input type="date"  name="check_out" class="form-control">                                       
               </div> 
            </div> -->

         <div class="row mt-2">
            <div class="col-lg">
               <label for="">Upload Valid ID:</label>
               <input type="file" name="valid_id" class="form-control-file" required>
            </div>
            <div class="col-lg">
               <label for="">Upload Proof of Payment:</label>
               <input type="file" name="payment" class="form-control-file">
            </div>
         </div>

         <div class="row mt-3  ml-3">
            <div class="col-lg form-check d-flex align-items-center" style="height: 40px;">
               <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checkboxObject.required = "true">
               <label class="form-check-label ml-2" for="flexCheckDefault">
                  <span>I Agree with the </span><a href="#" class="terms">Terms and Conditions</a><span> of Pili Beach Resort Agmanic</span>
               </label>
            </div>
         </div>
         <div class="row ml-3">
               <span class="alert alert-danger" id="error"></span>
            </div>
      </div>

         <input type="submit" value="Complete Reservation" id="checkBtn" class="btn-custom mt-4" name="submit">

      </form>
   </section>

   <!-- booking section ends -->

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

   <script type="text/javascript">
      $(document).ready(function () {
         $('#checkBtn').click(function() {
            const error = document.getElementById("error"),
                  errorBox = document.querySelector('.alert');

            checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
            error.textContent = "You must agree to the Terms and Conditions of the Resort."
            errorBox.style.display = "block";
            return false;
            }

         });
      });

</script>
   
   <script src="../js/lightbox-plus-jquery.js"></script>


</body>

</html>