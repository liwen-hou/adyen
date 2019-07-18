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
              <form method="POST" action="lib/make_payment.php" id="adyen-encrypted-form">
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
              </form>
            </div>
          </div>
        </div>


      </div>

    </div>
  </div>
  <script type="text/javascript" src="https://test.adyen.com/hpp/cse/js/8115614281177653.shtml"></script>
  <script type="text/javascript">
    // The form element to encrypt.
    var form = document.getElementById('adyen-encrypted-form');
    // See https://github.com/Adyen/CSE-JS/blob/master/Options.md for details on the options to use.
    var key ="10001|BBAD60A5F4A892C824D7313DDFA5200FDB037972332E161F34889AB5F35F00D178855C0747E414991FABBF53775E825DFC2B74AC4BFE4AFBE67405C6BAA39AE22624FE87E44E933DE21022237178F5235E954E17C6397D7922BF00039B722DA3ABC5108EAE9CB65F50D247E441A85D72A90B936B888FCD1B0223DF09354F8CC6345168D197FAE515535A5D4511D42979CEA3BC692BA66FA6E7A4D3649C8BB05F1CDC7193B136C064BA9A78BB1C7FA20B23CDAC6A6534C4F1C6B0B98FFEC0CC8A03667AC75E8AF6C8B03C5AD50A0D9297DADCE3CED1DD6FD472A4E498EBCBEE9C3A51718C5C24697C6A6FC9B40FA089DDFE6DE49473DFBBC9E17ADE00899184A1";
    var options = {};
    // Set a element that should display the card type
    options.cardTypeElement = document.getElementById('cardType');
    var encryptedForm = adyen.encrypt.createEncryptedForm( form, key, options);
    encryptedForm.addCardTypeDetection(options.cardTypeElement);
  </script>
  <script type="text/javascript">
    import collectBrowserInfo from "./browser";
    import base64Url from "./base64url";
    import createIframe from "./iframe";
    import createForm from "./form";
    import {validateChallengeWindowSize, getChallengeWindowSize} from "./config.js";
  </script>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
