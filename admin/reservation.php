<?php
session_start();

include('../connection.php');

include_once('../includes/check_user_login.php');

$name = $_SESSION['name'];

if (isset($_SESSION['info'])) {
    $info = $_SESSION['info'];
} else {
    $info = "";
}

$error = "";

// Updating Data


if (isset($_POST['updatePayment'])) {
    $id = $_GET['updateid'];

    $sql = "SELECT * FROM reservation WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $full_name = $row['full_name'];
    $room_name = $row['room_name'];
    $total = $row['total'];
    $check_in = $row['check_in'];
    $check_out = $row['check_out'];
    $email = $row['email'];
    $payment_status = $row['payment_status'];

    $payment_status = $_POST['payment_status'];


    $sql = "UPDATE reservation SET payment_status = '$payment_status' WHERE id = $id";
    $result = mysqli_query($conn, $sql);


    // the message
    $msg = '
            
            Pili Beach Reservation - Cofirmation

            Name: ' . $full_name . ' 
            Accomodation: ' . $room_name . '
            Payment Status: ' . $payment_status . '
            Total Amount: ' . $price . '
            Check in: ' . $check_in . '
            Check out: ' . $check_out . '
    ';

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email
    mail($email, "Pili Beach Resort", $msg);

    $info = "Email has been sent!";
    $_SESSION['info'] = $info;

    header('location: reservation.php');
}

// Adding Data
if (isset($_POST['add'])) {
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $status = $_POST['booking_status'];


    $sql = "INSERT INTO room (check_in, check_out, booking_status)
        VALUES ('$check_in', '$check_out', '$status')";
    $result = mysqli_query($conn, $sql);

    $info = "Added Successfully!";

    header('location: reservation.php');
}

// Deleting Data
if (isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];


    $delete = "DELETE FROM reservation WHERE id = $id";
    $result = mysqli_query($conn, $delete);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reservations</title>

    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon">

    <?php include('head.php'); ?>

    <script>
        $(document).ready(function() {
            $('#sampleTable').DataTable();

            // Custom search box function for datatable
            oTable = $('#sampleTable').DataTable();
            $('#searchBox').keyup(function() {
                oTable.search($(this).val()).draw();
            });
        });
    </script>

    <!-- External CSS -->
    <link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light py-3 px-5">
        <div class="container-fluid navbar-container pl-5">
            <a class="navbar-brand mr-auto ml-5" href="rooms.php" style="text-decoration: none; ">
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
                        <a class="nav-link" href="reservation.php">Reservations</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                        <strong><?php echo $name; ?></strong>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../signout.php">Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Rooms Table -->
    <?php if ($info != "") {
    ?>
        <div class="container d-flex justify-content-center mt-3">
            <span class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $info; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </span>
            
        </div>
    <?php
    } else {
        $info = "";
    } ?>
    <div class="container table-responsive bg-light my-4 px-3 py-4" style="border-radius: 6px; ">
        <h2 class="pl-3">Reservations</h2>
        <table class="table table-sm text-center" id="sampleTable">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center text-middle">Room Name</th>
                    <th class="text-center text-middle">Reserver Name</th>
                    <th class="text-center text-middle">Total Amount</th>
                    <th class="text-center text-middle">Check In</th>
                    <th class="text-center text-middle">Check Out</th>
                    <th class="text-center text-middle">Valid ID</th>
                    <th class="text-center text-middle">Payment</th>
                    <th class="text-center text-middle">Payment Status</th>
                    <th class="text-center text-middle">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $get_data = "SELECT * FROM reservation order by 1 desc";
                $run_data = mysqli_query($conn, $get_data);


                $i = 0;
                while ($row = mysqli_fetch_assoc($run_data)) {
                    $no = ++$i;
                    $id = $row['id'];
                    $room_name = $row['room_name'];
                    $reserver_name = $row['reserver_name'];
                    $full_name = $row['full_name'];
                    $price = $row['price'];
                    $total = $price;
                    $valid_id = $row['valid_id'];
                    $payment = $row['payment'];
                    $check_in = $row['check_in'];
                    $check_out = $row['check_out'];
                    $payment_status = $row['payment_status'];

                    if ($reserver_name != "") {

                ?>
                        <tr>
                            <td><?php echo $room_name; ?></td>
                            <td><?php echo $reserver_name; ?></td>
                            <td>Php <?php echo $total; ?></td>
                            <td><?php echo $check_in; ?></td>
                            <td><?php echo $check_out; ?></td>
                            <td class="text-center">
                                <a href="../upload_images/<?php echo $valid_id; ?>">
                                    <img src="../upload_images/<?php echo $valid_id; ?>" alt="" style="width: 50px; height: 50px; ">
                                </a>
                            </td>
                            <td class="text-center">
                                <?php if ($payment == false) {
                                    echo "Photo is not yet available!";
                                } else {
                                ?>
                                    <a href="../upload_images/<?php echo $payment; ?>">
                                        <img src="../upload_images/<?php echo $payment; ?>" style="width: 50px; height: 50px; ">
                                    </a>
                                <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $payment_status; ?></td>
                            <td style="display: flex; gap: 5px; justify-content: center;">
                                <span class="action-icons">
                                    <a href="#" class="btn btn-warning" style="font-size: 17px; " data-toggle="modal" data-target="#updateModal<?php echo $id; ?>">
                                        <i class='bx bx-calendar-check'></i>
                                    </a>
                                </span>
                                <span class="action-icons">
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

    <!-- Update Modal -->
    <?php
    $get_data = "SELECT * FROM reservation";
    $run_data = mysqli_query($conn, $get_data);
    while ($row = mysqli_fetch_array($run_data)) {
        $id = $row['id'];
        $check_in = $row['check_in'];
        $check_out = $row['check_out'];
        $payment_status = $row['payment_status'];


    ?>
        <div class="modal fade" id="updateModal<?php echo $id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Update Reservation Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="reservation.php?updateid=<?php echo $id; ?>" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="room_name">Room Name</label>
                                    <input type="text" class="form-control" name="room_name" placeholder="Enter Room Name" value="<?php echo $room_name; ?>" required disabled></input>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="status">Payment Status</label>
                                    <select name="payment_status" class="custom-select" required>
                                        <option selected><?php echo $payment_status; ?></option>
                                        <option value="50% Down Payment">50% Down Payment</option>
                                        <option value="Fully Paid">Fully Paid</option>
                                        <option value="Not Paid">Not Paid</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="room_name">Check In Date</label>
                                    <input type="date" class="form-control" name="check_in" value="<?php echo $check_in; ?>" disabled></input>
                                </div>
                                <div class="form-group col-md">
                                    <label for="room_name">Check Out Date</label>
                                    <input type="date" class="form-control" name="check_out" value="<?php echo $check_out; ?>" disabled></input>
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
                    <a href="reservation.php?deleteid=<?php echo $id; ?>" class="btn btn-danger mt-3 float-right">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
    <?php include('footer.php'); ?>
</body>

</html>