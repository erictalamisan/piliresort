

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
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
   <?php include('includes/navbar.php'); ?>

<section class="home">
   
   <div class="swiper home-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide" style="background:url(images/home-slide-1.jpg) no-repeat">
            <div class="content">
               <span>Your next destination is waiting</span>
               <h3>Pili Beach</h3>
               <h3>A Paradise Retreat</h3>
               <a href="package.php" class="btn-custom">view more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-2.jpg) no-repeat">
            <div class="content">
               <span>Your next destination is waiting</span>
               <h3>discover the new places</h3>
               <a href="package.php" class="btn-custom">view more</a>
            </div>
         </div>

         <div class="swiper-slide slide" style="background:url(images/home-slide-3.jpg) no-repeat">
            <div class="content">
               <span>Your destination is waiting</span>
               <h3>make your tour worthwhile</h3>
               <a href="package.php" class="btn-custom">view more</a>
            </div>
         </div>
         
         <div class="swiper-slide slide" style="background:url(images/home-slide-3.jpg) no-repeat">
            <div class="content">
               <span>Your destination is waiting</span>
               <h3></h3>
               <a href="package.php" class="btn-custom">view more</a>
            </div>
         </div>

      </div>

      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

<section class="home-about">

   <div class="image">
      <img src="images/map.jpg" alt="">
   </div>

   <div class="content">
      <h3>How to get to Pili Beach</h3>
      <ul class="get">
         <li>By Airplane from Manila to Tugdan's Airport (Tablas Island), with only 1 plane scheduled a day - and 1 hour driving by car on nice and rough road for 35 km up to Pili Beach.</li>
         <li>By Airplane from Manila to Caticlan's Airport (Panay Island), 30 flights every day. Then take the Bangka boat from Tabon's baybay port to Santa-Fe (Tablas Island).</li>
         <li>Helicopter from Caticlan Airport to Pili Beach in 10 min.</li>
         <li>Bangka boat to Santa-Fe (Tablas Island) 30 up to 90 min travel on sea.</li>
         <li>Pick up with speedboat or Bangka boat in Boracay Island, and 30 to 90 min travel on sea, depends on the waves and weather. </li>
         <li>Take the 2Go from Manila with bus 2 - 3 hour to Batangas, and ship 6 hours to Ondiongan (Tablas Island), then car on nice and rough road for 1.5 hours to Pili Beach. </li>
         <li>Helicopter from Boracay to Pili Beach. 10 min with max 3 passengers.</li>
      </ul>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9278.085207225096!2d122.00746919633877!3d12.115279767836732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a51f6855555669%3A0x90089acb04c38f1c!2sPili%20Beach%20Resort!5e0!3m2!1sen!2sph!4v1657260754968!5m2!1sen!2sph" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
   </div>

</section>
-->
<!-- home about section ends -->

<!-- home packages section starts  -->

<section class="home-packages">

   <h1 class="heading-title"> our rooms </h1>

   <div class="box-container">

      <div class="box">
         <div class="image">
            <a href="package.php">
               <img src="images/img-1-1.jpg" alt="">
            </a>
         </div>
         <div class="content">
            <h3>Bungalow Beachfront Villa</h3>
            <h3>3 Bedroom</h3>
            <p>Sleeps 9 Adults and 2 Kids 10 years old and below. </p>
            <p>PHP 7,000/night</p>
            <a href="book.php" class="btn-custom">book now</a>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <a href="package.php">
               <img src="images/img-2-2.jpg" alt="">
            </a>
         </div>
         <div class="content">
            <h3>Kia Ora A,B or C</h3>
            <h3>2 Bedroom</h3>
            <p>Sleeps 6 Adults and 2 children 10 years old and below. </p>
            <p>PHP 7,000/night </p>
            <a href="book.php" class="btn-custom">book now</a>
         </div>
      </div>
      
      <div class="box">
         <div class="image">
            <a href="package.php">
            <img src="images/img-3-3.jpg" alt="">
            </a>
         </div>
         <div class="content">
            <h3>Garden Bungalow 9A</h3>
            <h3>2 Bedroom</h3>
            <p>Sleeps 5 adults and 2 kids 11 years old and below. </p>
            <p>PHP 4,000/night</p>
            <a href="book.php" class="btn-custom">book now</a>
         </div>
      </div>

   </div>

   <div class="load-more"> <a href="package.php" class="btn-custom">load more</a> </div>

</section>

<!-- home packages section ends -->

<!-- home offer section starts  -->

<section class="home-offer">

<h3>Contact and Like us on Facebook </h3>
   <div class="content">
      <div class="callus">
         <h2>Phone:</h2>
            <p>+63929 828 2781</p>
         <h2>Email:</h2>
            <p>pilibeach@yahoo.com</p>
            <h2>Address:</h2>
            <p>Agmanic, Sta. Fe, Romblon</p>
      </div>

      <div class="facebook">
         <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fweb.facebook.com%2Fpilibeach.agmanic.resort%2F&tabs=timeline&width=400&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="400" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
      </div>

   </div>

   <a href="book.php" class="btn">book now</a>

</section>

<!-- home offer section ends -->

















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





<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>