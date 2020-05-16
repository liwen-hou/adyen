<?php
date_default_timezone_set("Asia/Singapore");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Adyen for Platforms</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- Custom styles for this template -->
  </head>

    <?php
    require 'background.php';
    ?>
    <?php
     require 'header.php';
    ?>

    <div class="container">
      <?php
       require 'banner.php';
      ?>

      <div class="row justify-content-md-center">
        <div class="col-md-8 seller-info">
          <form method="post" action="payment/seller_signup.php">
            <h4 class="mb-3">Seller Details</h4>

            <!-- <div class="mb-3">
              <label for="accountType">Account Type</label>
              <select class="custom-select d-block w-100" id="accountType">
                <option value="">Choose...</option>
                <option>Individual</option>
                <option>Business</option>

              </select>
            </div> -->

            <div class="mb-3">
              <label for="sellerId">Username</label>
              <div class="input-group">
                <input type="text" class="form-control" id="sellerId" name="sellerId" placeholder="Choose a unique username">
              </div>
            </div>

            <div class="mb-3">
              <label for="country">Country</label>
              <select class="custom-select d-block w-100" id="country" name="country">
                <option value="">Choose...</option>
                <option value="DE">Germany</option>
                <option value="GB">United Kindom</option>
                <option value="NL">Netherlands</option>
                <option value="CA">Canada</option>
                <option value="US">United States</option>


              </select>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Seller First Name" value="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Seller Last Name" value="">
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="">
            </div>



            <button class="btn btn-primary btn-lg btn-block" type="submit">Join Now</button>
          </form>
        </div>
      </div>


    </div>

    <?php
     require 'footer.php';
    ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="./js/main.js"></script>
  </body>
</html>
