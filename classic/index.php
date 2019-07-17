<?php
require_once __DIR__ . '/lib/Client.php';
date_default_timezone_set("Europe/Amsterdam");
?>

<!DOCTYPE html>
<html class="html">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="robots" content="noindex"/>
  <title>Adyen Checkout</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <script type="text/javascript" src="https://test.adyen.com/hpp/cse/js/[your unique generated library].shtml"></script>

</head>
<body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Adyen Payment Experience</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="/">Checkout API</a>
      <a class="p-2 text-dark" href="/sdk">Checkout SDK</a>
      <a class="p-2 text-dark" href="/pos">POS</a>
      <a class="p-2 text-dark" href="/classic">Classic Integration</a>
    </nav>
  </div>
  <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="assets/img/checkout.png" alt="" width="100" height="100">
      <h2 class="heading">One More Step to Your Seasonal Favorites</h2>
      <p class="lead">Complete the checkout process powered and secured by Adyen by filling in the information below, and your items will be on the way!</p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span>Your cart</span>
          <span class="badge badge-secondary badge-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Product name</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">€5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Second product</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">€3</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Third item</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">€92.99</span>
          </li>
        </ul>
      </div>


      <div class="col-md-6">
        <div id="shopperDetails">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span>Confirm and Pay</span>
          </h4>

          <div class="card">
            <div class="card-body">
              <form method="POST" action="[payment request handler]" id="adyen-encrypted-form">
                <div class="mb-3">
                  <label>Card Number:</label>
                  <input class="form-control" type="text" size="20" data-encrypted-name="number"/>
                </div>
                <div class="mb-3">
                  <label>Holder Name:</label>
                  <input class="form-control" type="text" size="20" data-encrypted-name="holderName"/>
                </div>
                <div class="mb-3">
                  <label>Expiry Month:</label>
                  <input class="form-control" type="text" size="2" data-encrypted-name="expiryMonth"/>
                </div>
                <div class="mb-3">
                  <label>Expiry Year:</label>
                  <input class="form-control" type="text" size="4" data-encrypted-name="expiryYear"/>
                </div>
                <div class="mb-3">
                  <label>cvc:</label>
                  <input class="form-control" type="text" size="4" data-encrypted-name="cvc"/>
                </div>
                <div class="mb-3">
                  <input type="hidden" value="[generate this server side]" data-encrypted-name="generationtime"/>
                  <input class="btn btn-primary btn-lg btn-block" type="submit" value="Pay"/>
              </form>
            </div>
          </div>
        </div>


      </div>

    </div>
  </div>
  <script>
    // The form element to encrypt.
    var form = document.getElementById('adyen-encrypted-form');
    // See https://github.com/Adyen/CSE-JS/blob/master/Options.md for details on the options to use.
    var options = {};
    // Bind encryption options to the form.
    adyen.createEncryptedForm(form, options);
  </script>

  <script type="text/javascript">

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
