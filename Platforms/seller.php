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
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <?php
     require 'header.php';
    ?>

    <div class="container">
      <?php
       require 'banner.php';
      ?>

      <div class="row center-align">
        <div class="col-md-5">

          <a href="signup.php" class="seller-option">
              <h5 class="card-title">New Seller</h5>
              <p class="seller-option-text">Click here if you are new to the platform as a seller.</p>
              <img src="img/users.svg"  width="72" height="72">
          </a>
        </div>
        <div class="col-md-2">

          <div class="signin-social-separator" style="height: 320px;"><div class="vl"></div></div>
        </div>
        <div class="col-md-5">

        <form  action="seller_status.php" method="get">
          <div class="seller-option">
              <h5 class="card-title">Welcome Back</h5>
              <p class="seller-option-text">Sign in if you are already a restaurant with us.
                <input style="margin-top: 10px;" type="text" class="form-control" id="sellerId" name="sellerId" placeholder="Your unique restaurant ID" required>
                <input style="margin-top: 10px;" type="text" class="form-control" id="password" name="password" placeholder="Password" required>
                <row>
                  <button type="submit">Sign In</button>
                  |<a href="signup.php">Sign up</a>
                </row>
              </p>
          </div>
        </form>

        </div>
      </div>


    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2019 Adyen for Platforms Demo</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation')

        // Loop over them and prevent submission
        Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
      }, false)
    }())

    </script>
  </body>
</html>
