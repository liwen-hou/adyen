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

    <title>Adyen MarketPay</title>
    <link rel="stylesheet" href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/3.1.0/adyen.css" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="../index.php" class="p-2 text-dark">Adyen MarketPay DEMO</a></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="../index.php"><i class="fas fa-user"></i> Marketplace</a>
        <a class="p-2 text-dark" href="../signup.php"><i class="fas fa-sign-out-alt"></i> Tenant Signup</a>
      </nav>
    </div>
    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="../img/adyen.png" alt="" width="72" height="72">
      </div>

      <div class="col-md-12 text-center">
        <h4>Tenant Account created with Account Code: <?php echo $_GET["accountCode"];?></h4>
      </div>


      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019 Adyen MarketPay Demo</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>


    <script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/3.1.0/adyen.js"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="./js/main.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();


    </script>
  </body>
</html>
