<?php
session_start();

include_once('../includes/check_user_login.php');
$user_type = $_SESSION['user_type'];
$name = $_SESSION['name'];

if ($_SESSION['user_type'] != "Administrator") {
  header('location: ../home.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>

    <?php include('../includes/head.php'); ?>

    <!-- External CSS -->
    <link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light py-3 px-5">
        <div class="container-fluid navbar-container pl-5">
          <a class="navbar-brand mr-auto ml-5" href="dashboard.php" style="text-decoration: none; ">
            <img src="../images/favicon.jpg" alt="Logo"> <span class="text-dark">Pili Beach Resort</span>
          </a>
  
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link" href="rooms.php">Rooms</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="rooms.php">Reservations</a>
              </li>
            </ul>
          </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                        <strong><?php echo $name ?></strong>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../signout.php">Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
      </nav>
    


    <?php include('../includes/footer.php'); ?>
</body>

</html>