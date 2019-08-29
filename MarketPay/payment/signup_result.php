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
      <svg width="157" height="30" enable-background="new 0 0 90 29.1" viewBox="0 0 90 29.1" xmlns="http://www.w3.org/2000/svg">
        <g fill="#0abf53">
          <path d="m12.7 6.6h-12.5v4h8.1c.5 0 .9.4.9.9v7h-1.7c-.5 0-.9-.4-.9-.9v-5h-3.4c-1.8 0-3.2 1.4-3.2 3.2v3.6c0 1.8 1.4 3.2 3.2 3.2h12.7v-12.8c0-1.8-1.4-3.2-3.2-3.2z"></path>
          <path d="m27.8 18.5h-1.7c-.5 0-.9-.4-.9-.9v-11h-3.4c-1.8 0-3.2 1.4-3.2 3.2v9.5c0 1.8 1.4 3.2 3.2 3.2h12.7v-22.5h-6.6z"></path>
          <path d="m46.3 18.5h-1.7c-.5 0-.9-.4-.9-.9v-11h-6.6v12.7c0 1.8 1.4 3.2 3.2 3.2h6.1v2h-9v4.6h12.5c1.8 0 3.2-1.4 3.2-3.2v-19.3h-6.6v11.9z"></path>
          <path d="m68.3 6.6h-12.7v12.7c0 1.8 1.4 3.2 3.2 3.2h12.5v-4h-8.1c-.5 0-.9-.4-.9-.9v-7h1.7c.5 0 .9.4.9.9v5h3.4c1.8 0 3.2-1.4 3.2-3.2v-3.5c0-1.8-1.5-3.2-3.2-3.2z"></path>
          <path d="m86.8 6.6h-12.7v15.9h6.6v-11.9h1.7c.5 0 .9.4.9.9v11h6.7v-12.7c0-1.8-1.4-3.2-3.2-3.2z"></path>
        </g>
      </svg>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="../index.php"><i class="fas fa-user"></i> Marketplace</a>
        <a class="p-2 text-dark" href="../signup.php"><i class="fas fa-sign-out-alt"></i> Tenant Signup</a>
      </nav>
    </div>
    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="../img/adyen.png" alt="" width="72" height="72">
        <h2>Adyen MarketPay DEMO for iShopChangi</h2>
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
