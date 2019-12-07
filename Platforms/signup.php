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
    <link rel="stylesheet" href="css/style.css" />
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <?php
     require 'header.php';
    ?>

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/adyen.png" alt="" width="72" height="72">
        <h2>Adyen for Platforms DEMO</h2>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>

          <div class="vl"></div>

          <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <form method="post" action="payment/tenant_signup.php">
          <h4 class="mb-3">Business Details</h4>

          <div class="mb-3">
            <label for="legalName">Legal Business Name</label>
            <div class="input-group">
              <input type="text" class="form-control" id="legalName" name="legalName" placeholder="Your legal business name">
            </div>
          </div>

          <div class="mb-3">
            <label for="tenantId">Tenant ID</label>
            <div class="input-group">
              <input type="text" class="form-control" id="tenantId" name="tenantId" placeholder="The unique ID for your business">
            </div>
          </div>

          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="1234 Main St">
          </div>

          <div class="mb-3">
            <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="country">Country</label>
              <select class="custom-select d-block w-100" id="country">
                <option value="">Choose...</option>
                <option>Singapore</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="zip">Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="600 000">
            </div>
          </div>

          <hr class="mb-4">


          <h4 class="mb-3">Share Holder Details</h4>


          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="Share Holder Firstname" value="">
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" placeholder="Share Holder Lastname" value="">
            </div>
          </div>

          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="you@example.com" value="">
          </div>

          <hr class="mb-4">

          <h4 class="mb-3">Bank Account Details</h4>

          <div class="mb-3">
            <label for="accountNumber">Account Number</label>
            <input type="text" class="form-control" id="accountNumber" placeholder="1678116852" value="">
          </div>


          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="branchCode">Branch Code</label>
              <input type="text" class="form-control" id="branchCode" placeholder="001" value="">
            </div>
            <div class="col-md-3 mb-3">
              <label for="CountryCode">Country Code</label>
              <input type="text" class="form-control" id="CountryCode" placeholder="SG" value="">
            </div>
            <div class="col-md-6 mb-3">
              <label for="swift">Swift Code</label>
              <input type="text" class="form-control" id="swift" placeholder="UOBXSGXXXXX" value="">
            </div>
          </div>




          <button class="btn btn-primary btn-lg btn-block" type="submit">Sign up</button>
        </form>
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
