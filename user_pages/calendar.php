<div class="container p-4 bg-secondary mx-auto mb-3" style="width: 100%; max-width: 30%; border-radius: 4px; ">
         <h3 class="text-center text-white">Check Reservation Date</h3>
         <form action="available.php" method="post">
            <div class="row  my-4">
               <div class="col-lg text-light">
                  <label for="">Check In</label>
                  <input class="form-control" type="date" name="check_in" value="<?php echo $check_in; ?>" required>
               </div>
               <div class="col-lg text-light">
                  <label for="">Check Out</label>
                  <input class="form-control" type="date" name="check_out" value="<?php echo $check_out; ?>" required>
               </div>
            </div>
            <div class="container d-flex justify-content-center mt-2">
               <button type="submit" class="btn btn-primary" name="check_availability">Check Availability</button>
            </div>
         </form>
      </div>