<?php

include('connection.php');

$info = "";
$login = "";

if (isset($_POST['submit'])) {
   $info = "Please Log In <br> to Book your Reservation!";
   $login = "Login Now!";
   
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>book</title>
   <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

   <?php include('includes/head.php'); ?>
   
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">




</head>
<body>
   
<!-- header section starts  -->
<?php include('includes/navbar.php'); ?>

<!-- header section ends -->

<div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
   <h1>book now</h1>
</div>

<!-- booking section starts  -->
<?php if ($info != "") {
      echo "
         <div class='container-fluid bg-info text-white p-4'>
            <h2 class='text-center'>$info</h2>
         </div>
      ";
   } 
?>


<section class="booking container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class=book-form>
            <div class="row mt-3">
               <div class="col-lg">
                  <span>Name</span>
                  <input type="text" placeholder="Full Name" name="name" class="form-control">                    
               </div> 

               <div class="col-lg">
                  <span>Address</span>
                  <input type="address" placeholder="Complete Address" name="address" class="form-control">                    
               </div> 

               <div class="col-lg">
                  <span>Email</span>
                     <input type="email" placeholder="Email Address" name="email" class="form-control">                                       
               </div>
            </div> 

            <div class="row mt-3">
               <div class="col-lg">
                  <span>Number of Adults</span>
                  <input type="number" placeholder="Number of Adults" name="adults" class="form-control">            
               </div> 

               <div class="col-lg">
                  <span>Number of Kids 10 Years Old/Below:</span>
                  <input type="number" placeholder="Number of Children" name="children" class="form-control">            
               </div>
         
               <div class="col-lg">
                  <span>Phone Number</span>
                  <input type="text" placeholder="Mobile Number" name="phone" class="form-control">                                       
               </div> 
            </div>

            <div class="row mt-3">
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
            </div>

            <div class="row mt-3">
               <div class="col-lg">
                  <span>Check In</span>
                  <input type="date" name="check_in" class="form-control">                                       
               </div> 
               <div class="col-lg">
                  <span>Check Out</span>
                  <input type="date"  name="check_out" class="form-control">                                       
               </div> 
            </div>

            <div class="row mt-3">
               <div class="col-lg">
                  <label for="">Upload Valid ID:</label>
                  <input type="file" name="valid_id" class="form-control">                                       
               </div> 
               <div class="col-lg">
                  <label for="">Upload Proof of Payment:</label>
                  <input type="file" name="payment" class="form-control">                                       
               </div> 
            </div>
        </div>
      
     <input type="submit" value="submit" class="btn-custom" name="submit" class="form-control">

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

   <div class="credit"> All rights reserved! 2022  </div>

</section>

<!-- footer section ends -->







<?php include('includes/footer.php'); ?>

<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>