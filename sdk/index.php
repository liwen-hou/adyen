<?php
/**
 *                       ######
 *                       ######
 * ############    ####( ######  #####. ######  ############   ############
 * #############  #####( ######  #####. ######  #############  #############
 *        ######  #####( ######  #####. ######  #####  ######  #####  ######
 * ###### ######  #####( ######  #####. ######  #####  #####   #####  ######
 * ###### ######  #####( ######  #####. ######  #####          #####  ######
 * #############  #############  #############  #############  #####  ######
 *  ############   ############  #############   ############  #####  ######
 *                                      ######
 *                               #############
 *                               ############
 *
 * Adyen Checkout Example (https://www.adyen.com/)
 *
 * Copyright (c) 2017 Adyen BV (https://www.adyen.com/)
 *
 * Author: Adyen
 */
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
    <title>Example PHP checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript"
            src="https://checkoutshopper-test.adyen.com/checkoutshopper/assets/js/sdk/checkoutSDK.1.6.4.min.js"></script>
    <script src="assets/js/PaymentSessionCall.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body class="body">
<div class="content">

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
      <img class="d-block mx-auto mb-4" src="../assets/img/checkout.png" alt="" width="100" height="100">
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
            <span class="text-muted">€2</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (EUR)</span>
            <strong>€10</strong>
          </li>
        </ul>
      </div>


      <div class="col-md-6">
        <div id="shopperDetails">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span>Checkout</span>
          </h4>


          <div class="checkout-container">
            <div class="checkout" id="checkout">
              <!-- The checkout interface will be rendered here -->
            </div>
          </div>
        </div>


      </div>

    </div>
  </div>

</div>

    <?php
    $client = new Client();
    $paymentSessionData = json_encode($client->paymentSession());
    ?>


<script type="text/javascript">
    $(document).ready(function () {
        var data = JSON.parse(<?php echo $paymentSessionData ?>);
        initiateCheckout(data['paymentSession']);

        chckt.hooks.beforeComplete = function (node, paymentData) {
            console.log(paymentData.payload);

            var payloadObject = {
                payload: paymentData.payload
            };

            // `node` is a reference to the Checkout container HTML node.
            // `paymentData` is the result of the payment. Includes the `payload` variable,
            // which you should submit to the server for the Checkout API /paymentsResult call.
            $.ajax({
                url: 'paymentsResult.php',
                data: payloadObject,
                method: 'POST',// jQuery > 1.9
                type: 'POST', //jQuery < 1.9
                success: function (data) {
                    $("#checkout").html(data.resultCode);
                },
                error: function () {
                    if (window.console && console.log) {
                        console.log("error")
                        console.log('### adyenCheckout::error:: args=', arguments);
                    }
                }
            });

            return false; // Indicates that you want to replace the default handling.
        };
    });


</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
