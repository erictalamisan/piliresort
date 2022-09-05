<?php

include('connection.php');

if (isset($_POST['submit'])) {
   
   $name = $_POST['name'];
   $address = $_POST['address'];
   $email = $_POST['email'];
   $accomodation = $_POST['accomodation'];
   $guest_no = $_POST['guest_no'];
   $phone = $_POST['phone'];
   $arrival = $_POST['arrival'];
   $leaving = $_POST['leaving'];

   $sql = "INSERT INTO book (name, address, email, accomodation, guest_no, phone, arrival, leaving)
   VALUES ('$name', '$address', '$email', '$accomodation', '$guest_no', '$phone', '$arrival', '$leaving')";

   if (mysqli_query($conn, $sql)) {
     
   } else {
      echo "Insert Failed: " . $sql . "" . mysqli_error($conn);
   }
   
   mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="css/style.css">

</head>

<body>
<h1>Book Now</h1>
<div class="form-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="row pb-4">
               <div class="col-sm-4">
                    <label for="name">Name</label>
                    <input type="text" placeholder="Full Name" name="name" class="form-control">                    
               </div> 
               <div class="col-sm-4">
                    <label for="address">Address</label>
                    <input type="address" placeholder="enter your ddress" name="address" class="form-control">                    
                </div> 
                <div class="col-sm-4">
                    <label for="email">Email</label>
                    <input type="email" placeholder="enter your email" name="email" class="form-control">                                       
                </div> 
        </div>
        <div class="row pb-4">
            <div class="col-sm-4 input-option">
                 <label for="accomodation">Accomodation</label>
                 
                    <select name="accomodation" class="form-control">
                    <option value="Standard">Standard</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Economy">Economy</option>
                    
                 </select>
                <i class='bx bxs-chevron-down dropdown-icon'></i>
            </div> 
            <div class="col-sm-4">
                 <label for="guest_number">Number of Guests</label>
                 <input type="text" placeholder="number of guests" name="guest_no" class="form-control">                    

             </div> 
        
             <div class="col-sm-4">
                 <label for="phone">phone</label>
                 <input type="text" placeholder="enter your phone" name="phone" class="form-control">                                       
             </div> 
        </div>

        <div class="row pb-4">
            <div class="col-sm">
                <label for="Arrival">Arrival</label>
                <input type="date" name="arrival" class="form-control">                                       
            </div> 
            <div class="col-sm">
                <label for="Leaving">Leaving</label>
                <input type="date"  name="leaving" class="form-control">                                       
            </div> 
        </div>

     <input type="submit" class="btn btn-success" name="submit">
    </form>
</div>










<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>


</html>