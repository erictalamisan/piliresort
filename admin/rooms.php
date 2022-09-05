<?php
session_start();

include('../connection.php');

include_once('../includes/check_user_login.php');

$name = $_SESSION['name'];

$info = "";
$error = "";

// Updating Data


if (isset($_POST['update'])) {
    $id = $_GET['updateid'];

    $price = $_POST['price'];
    $status = $_POST['booking_status'];

    //image upload
    $msg = "";
    $image = $_FILES['image']['name'];
    $target = "../upload_images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }

    $sql = "UPDATE room SET price = '$price', booking_status = '$status' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    $info = "Updated Successfully!";

    header('location: rooms.php');
}

// Adding Data
if (isset($_POST['add'])) {
    $room_name = $_POST['room_name'];
    $description_1 = $_POST['description_1'];
    $description_2 = $_POST['description_2'];
    $price = $_POST['price'];
    $status = $_POST['booking_status'];




    //image upload
    $msg = "";
    $image = $_FILES['image']['name'];
    $target = "../upload_images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }

    $sql = "INSERT INTO room (room_name, description_1, description_2, price, booking_status, image)
        VALUES ('$room_name', '$description_1', '$description_2', '$price', '$status', '$image')";
    $result = mysqli_query($conn, $sql);

    $info = "Added Successfully!";

    header('location: rooms.php');
}

// Deleting Data
if (isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];


    $delete = "DELETE FROM room WHERE id = $id";
    $result = mysqli_query($conn, $delete);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rooms</title>

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

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-4 ml-4" data-toggle="modal" data-target="#addModal">
        New Room
    </button>

    <!-- Rooms Table -->
    <div class="container table-responsive bg-light my-4 px-3 py-4" style="border-radius: 6px; "> 
        <h2 class="pl-3">Rooms</h2>
        <table class="table table-md text-center" id="sampleTable">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center text-middle">#</th>
                    <th class="text-center text-middle">Room Name</th>
                    <th class="text-center text-middle">Status</th>
                    <th class="text-center text-middle">Price</th>
                    <th class="text-center text-middle">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $get_data = "SELECT * FROM room order by 1 desc";
                $run_data = mysqli_query($conn, $get_data);


                $i = 0;
                while ($row = mysqli_fetch_assoc($run_data)) {
                    $no = ++$i;
                    $id = $row['id'];
                    $room_name = $row['room_name'];
                    $price = $row['price'];
                    $check_in = $row['check_in'];
                    $check_out = $row['check_out'];
                    $status = $row['booking_status'];


                ?>
                    <tr>
                        <td scope="row"><?php echo $no; ?></td>
                        <td><?php echo $room_name; ?></td>
                        <td><?php echo $status; ?></td>
                        <td>Php <?php echo $price; ?></td>
                        <td style="display: flex; gap: 5px; justify-content: center;">
                            <span class="action-icons">
                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#updateModal<?php echo $id; ?>">
                                    <i class='bx bxs-pencil'></i>
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
            </tbody>
        </table>
    </div>

    <!-- Update Modal -->
    <?php
        $get_data = "SELECT * FROM room";
        $run_data = mysqli_query($conn, $get_data);
        while ($row = mysqli_fetch_array($run_data)) {
            $id = $row['id'];
            $room_name = $row['room_name'];
            $description_1 = $row['description_1'];
            $description_2 = $row['description_2'];
            $price = $row['price'];
            $status = $row['booking_status'];
            $image = $row['image'];


    ?>
    <div class="modal fade" id="updateModal<?php echo $id; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Room Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="rooms.php?updateid=<?php echo $id; ?>" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="room_name">Room Name</label>
                                    <input type="text" class="form-control" name="room_name" placeholder="Enter Room Name" value="<?php echo $room_name; ?>" required disabled></input>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="price">Room Price</label>
                                    <input class="form-control" name="price" placeholder="Enter Room Price" value="<?php echo $price; ?>" required></input>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="status">Status</label>
                                    <select name="booking_status" class="custom-select" required>
                                        <option selected><?php echo $status; ?></option>
                                        <option value="Available">Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <!-- <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="description">Title Description</label>
                                    <textarea class="form-control" name="description_1" rows="5" placeholder="Enter Title Description.." required></textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="description">Full Description</label>
                                    <textarea class="form-control" name="description_2" rows="5" placeholder="Enter Full Description.." required></textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="exampleFormControlFile1">Upload Image</label>
                                    <input type="file" name="image" value="<?php echo $image; ?>" class="form-control-file" required>
                                </div>
                            </div> -->
                            <button type="submit" name="update" class="btn btn-primary">Submit</button>
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

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">New Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="room_name">Room Name</label>
                                <input type="text" class="form-control" name="room_name" placeholder="Enter Room Name" required></input>
                            </div>
                        </div>

                        <div class="form-row"> 
                            <div class="form-group col-md">
                                <label for="price">Room Price</label>
                                <input class="form-control" name="price" placeholder="Enter Room Price" required></input>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="status">Status</label>
                                <select name="booking_status" class="custom-select" required>
                                    <option selected><?php echo $status; ?></option>
                                    <option value="Available">Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="description">Title Description</label>
                                    <textarea class="form-control" name="description_1" rows="5" placeholder="Enter Title Description.." required>
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md">
                                    <label for="description">Full Description</label>
                                    <textarea class="form-control" name="description_2" rows="5" placeholder="Enter Full Description.." required>
                                    </textarea>
                                </div>
                            </div>

                        <div class="form-row">
                            <div class="form-group col-md">
                                <label for="exampleFormControlFile1">Upload Image</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>
                        </div>
                        <button type="submit" name="add" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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
                    <a href="rooms.php?deleteid=<?php echo $id; ?>" class="btn btn-danger mt-3 float-right">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
    <?php include('footer.php'); ?>
</body>

</html>