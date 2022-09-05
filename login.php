
<?php

session_start();

require_once('connection.php');

// //if user click signin button
// if(isset($_POST['signin'])){
//     $username_email = mysqli_real_escape_string($conn, $_POST['username_email']);
//     $password = mysqli_real_escape_string($conn, $_POST['password']);
    
//     if($_POST['username_email']){

//         // check email if valid
//         $check_username_email = "SELECT * FROM users WHERE username = '?' OR email = '?'";
//         $res_username_email = mysqli_query($conn, $check_username_email);


//         $sql = "SELECT * FROM users";
//         $result = mysqli_query($conn, $sql);

//         while ($row = mysqli_fetch_assoc($result)) {
//             $name = $row['name'];
//             $user_type = $row['user_type'];
//             $fetch_pass = $row['password'];
//         }
        
//         $fetch = mysqli_fetch_assoc($res_username_email);

//         if(password_verify($password, $fetch_pass)){
//             $username = $fetch['username'];
//             $email = $fetch['email'];
            

//             if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
//                session_start();

//                $_SESSION["loggedin"] = true;
//                $_SESSION['name'] = $name;
//                $_SESSION['email'] = $email;
//                $_SESSION['password'] = $password;
//                $_SESSION['username'] = $username;
//                $_SESSION["user_type"] = $user_type;
               
//                  header("location: user_check.php?user_type=" . $user_type);
//             } else {

//                session_start();
   
//                $_SESSION["loggedin"] = true;
//                $_SESSION['name'] = $name;
//                $_SESSION['email'] = $email;
//                $_SESSION['password'] = $password;
//                $_SESSION['username'] = $username;
//                $_SESSION["user_type"] = $user_type;
            
//                header("location: user_check.php?user_type=" . $user_type);
//            }
//         }
//     } else {
//          $errors['email'] = "Error!";
//          header('location: home.php');
//     }
// }

$info = "";

if(isset($_POST['signin'])){
   $username_email = mysqli_real_escape_string($conn, $_POST['username_email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   
   
   $check_username_email = "SELECT * FROM users WHERE email = '$username_email' OR username = '$username_email'";
   $res = mysqli_query($conn, $check_username_email);

   $result = mysqli_query($conn, $check_username_email);
   

   while ($row = mysqli_fetch_assoc($result)) {
       $name = $row['name'];
       $user_type = $row['user_type'];
   }
   if(mysqli_num_rows($res) > 0){
       $fetch = mysqli_fetch_assoc($res);
       $fetch_pass = $fetch['password'];
       $email = $fetch['email'];
       $name = $fetch['name'];
       $username = $fetch['username'];
       if(password_verify($password, $fetch_pass)){
           $_SESSION['username_email'] = $email;

           if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
               $_SESSION["loggedin"] = true;
               $_SESSION['name'] = $name;
               $_SESSION['password'] = $password;
               $_SESSION['username'] = $username;
               $_SESSION["user_type"] = $user_type;
               $_SESSION["full_name"] = $full_name;
            
               header("location: user_check.php?user_type=" . $user_type);

            }
       }
}
}

?>



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

   <!-- uniqe icons  -->
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   

</head>
<body>
<!-- header section starts  -->
<?php include('includes/navbar.php'); ?>

<section class="signup">
      <div class="form-header-text">
        <h2>Sign In</h2>
        <span><?php if ($info != "") {
                  echo $info;
        } ?></span>
      </div>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
          <div class="input-field">       
            <input type="text" name="username_email" placeholder="Username or Email">
            <i class="uil uil-user-check"></i>
          </div>
          <div class="input-field">                                      
            <input type="password" name="password" placeholder="Password..."> 
            <i class="uil uil-key-skeleton-alt"></i>
          </div>                     
                                    
            <div class="signup-btn">
               <input type="submit" name="signin" class="btn-custom">
            </div>
      </form>
</section>

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


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>




</body>
</html>