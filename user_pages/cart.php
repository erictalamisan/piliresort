<div class="container p-3 mb-5 flex-column text-white" id="cart" style="border-radius: 6px; padding: 5px; box-shadow: 1px 1px 4px #000a22; ">
      <!-- Reservation Table -->
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

                if ($reserver_name == $name) { ?>
                    <tr>
                     <td><?php echo $no; ?></td>
                     <td><?php echo $room_name; ?></td>
                     <td><?php echo $number_nights; ?></td>
                     <td><?php echo $check_in; ?></td>
                     <td><?php echo $check_out; ?></td>
                     <td><?php echo $price; ?></td>
                     <td><?php echo $amount; ?></td>
                     <td>
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
      <!-- <h3 class="text-dark ml-3">Total Amount: 
      //   echo $total * $amount;
      // } else {
      //   echo "0";
      // } ?></h3> -->
      
    <div class="container bg-secondary py-3 pr-4 d-md-flex">
        <a class="btn btn-primary" href="book.php?checkOut=<?php echo $id; ?>" >Proceed</a>
    </div>
  </div>

  