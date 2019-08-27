<?php
date_default_timezone_set("Asia/Singapore");
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
    </div>
    <div class="col-md-8 justify-content-center">
      <div id="shopperDetails">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span>Confirm and Pay</span>
        </h4>

        <div class="card">
          <div class="card-body">
            <form id="adyen-encrypted-form">
              <div class="mb-3">
                <span>Card Number:</span><span id="cardType"></span>
                <input class="form-control" type="text" size="20" data-encrypted-name="number"/>
              </div>
              <div class="mb-3">
                <span>Holder Name:</span>
                <input class="form-control" type="text" size="20" data-encrypted-name="holderName"/>
              </div>
              <div class="mb-3">
                <label for="adyen-encrypted-form-expiry-month">
                  <span>Expiration (MM/YYYY)</span>
                  <input type="text" value="10"   id="adyen-encrypted-form-expiry-month" maxlength="2" size="2" autocomplete="off" data-encrypted-name="expiryMonth" /> /
                </label>
                <!-- Do not use two input elements inside a single label. This will cause focus issues on the seoncd and latter fields using the mouse in various browsers -->
                <input type="text" value="2020" id="adyen-encrypted-form-expiry-year" maxlength="4" size="4" autocomplete="off" data-encrypted-name="expiryYear" />
              </div>
              <div class="mb-3">
                <span>CVC</span>
                <input class="form-control" type="text" size="4" data-encrypted-name="cvc"/>
              </div>
              <div class="mb-3">
                <input type="hidden" value="<?php echo (new DateTime())->format('c');?>" data-encrypted-name="generationtime"/>
                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Pay"/>
              </div>
            </form>
          </div>
        </div>
        <div id="threedsContainer"></div>
      </div>


    </div>


  </div>
  <script type="text/javascript" src="https://live.adyen.com/hpp/cse/js/2615668866334624.shtml"></script>
  <script src="./js/helper.js"></script>
  <script src="./js/main.js"></script>
  <script src="./js/brains.js"></script>
  <script src="./js/identifyShopper.js"></script>
  <script src="./js/challengeShopper.js"></script>
  <script src="./js/redirectShopper.js"></script>



  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
