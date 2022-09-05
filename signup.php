<?php
// Include config file
require_once "connection.php";
 
// Define variables and initialize with empty values
$name = $email = $username = $password = $confirm_password = "";
$name_err = $email_err = $username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];

   $email_check = "SELECT * FROM users WHERE email = '$email'";
   $res = mysqli_query($conn, $email_check);
   
   if(mysqli_num_rows($res) > 0){
      $email_err = "Email that you have entered is already registered!";
   }

   if (empty($_POST['email'])) {
        $email_err = "Please enter your email!";
    }

   if (empty($_POST['name'])) {
      $name_err = "Please enter your name!";
   }
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            $param_name = trim($_POST["name"]);
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, email, username, password) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
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
        <h2>Sign Up</h2>
      </div>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            
          <div class="input-field">
            <input type="text" name="name" placeholder="Full name..." value="<?php echo $name; ?>"> 
            <i class="uil uil-user"></i> 
          </div>
          <?php if ($name_err != "") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 18px; "><strong><?php echo $name_err; ?></strong></span>
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>        
            <?php }; ?>
            
          <div class="input-field">              
            <input type="email" name="email" placeholder="Email..." value="<?php echo $email; ?>">
            <i class="uil uil-envelopes"></i>
          </div> 
          <?php if ($email_err != "") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 18px; "><strong><?php echo $email_err; ?></strong></span>
                </div>        
            <?php }; ?>
          
          <div class="input-field">       
            <input type="text" name="username" placeholder="Username..." value="<?php echo $username; ?>"> 
            <i class="uil uil-user-check"></i>
          </div>
          <?php if ($username_err != "") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 18px; "><strong><?php echo $username_err; ?></strong></span>
                </div>        
            <?php }; ?>
          
          <div class="input-field">                                      
            <input type="password" name="password" placeholder="Password..."> 
            <i class="uil uil-key-skeleton-alt"></i>
          </div>
          <?php if ($password_err != "") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 18px; "><strong><?php echo $password_err; ?></strong></span>
                </div>        
            <?php }; ?> 
          
          <div class="input-field">                                      
            <input type="password" name="confirm_password" placeholder="Confirm Password..."> 
            <i class="uil uil-key-skeleton-alt"></i>
          </div>
          <?php if ($confirm_password_err != "") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 18px; "><strong><?php echo $confirm_password_err; ?></strong></span>
                </div>        
            <?php }; ?>                    
                                    
            <div class="signup-btn">
               <input type="submit" class="btn-custom" name="submit">
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