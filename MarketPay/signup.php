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

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>Adyen MarketPay Demo</h2>
        <p class="lead">New Tenant Signup.</p>
      </div>

      <div class="col-md-12">
        <form class="needs-validation" novalidate>
          <h4 class="mb-3">Business Details</h4>

          <div class="mb-3">
            <label for="username">Legal Business Name</label>
            <div class="input-group">
              <input type="text" class="form-control" id="legalname" placeholder="Your legal business name" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
          </div>

          <div class="mb-3">
            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="country">Country</label>
              <select class="custom-select d-block w-100" id="country" required>
                <option value="">Choose...</option>
                <option>Singapore</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="zip">Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
            </div>
          </div>



          <h4 class="mb-3">Share Holder Details</h4>


          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Share Holder First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Share Holder Last name</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com" value="" required>
          </div>

          <h4 class="mb-3">Bank Account Details</h4>

          <div class="mb-3">
            <label for="accountNumber">Account Number</label>
            <input type="text" class="form-control" id="accountNumber" placeholder="" value="" required>
          </div>


          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="branchCode">Branch Code</label>
              <input type="text" class="form-control" id="branchCode" placeholder="" value="" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="CountryCode">Country Code</label>
              <input type="text" class="form-control" id="CountryCode" placeholder="" value="" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="swift">Swift Number</label>
              <input type="text" class="form-control" id="swift" placeholder="" value="" required>
            </div>
          </div>




          <button class="btn btn-primary btn-lg btn-block" type="submit">Sign up</button>
        </form>
      </div>


      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
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
