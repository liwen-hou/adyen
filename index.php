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
  <script type="text/javascript" src="https://checkoutshopper-test.adyen.com/checkoutshopper/assets/js/sdk/checkoutSecuredFields.1.3.3.min.js"></script>

</head>
<body>

  <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="assets/img/checkout.png" alt="" width="100" height="100">
      <h2 class="heading">One Step to Your Seasonal Favorites</h2>
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
            <span class="text-muted">$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Second product</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Third item</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-success">
              <h6 class="my-0">Promo code</h6>
              <small>EXAMPLECODE</small>
            </div>
            <span class="text-success">-$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (EUR)</span>
            <strong>$10</strong>
          </li>
        </ul>

        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <div class="input-group-append">
              <button type="submit" class="btn btn-secondary">Redeem</button>
            </div>
          </div>
        </form>
      </div>


      <div class="col-md-6">
        <div id="shopperDetails">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span>Something About You</span>
          </h4>

          <div class="card">
            <div class="card-body">
              <form class="needs-validation" novalidate="">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                      Valid first name is required.
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                      Valid last name is required.
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="you@example.com">
                  <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                  </div>
                </div>



                <hr class="mb-4">

                <button class="btn btn-primary btn-lg btn-block" type="button" onclick="show(); getMethods();">Continue to checkout</button>
              </form>
              <p class="card-text">This will bring you to the payment details page.</p>
            </div>
          </div>
        </div>
        <div id="paymentWindow" style="display:none">
        </div>


      </div>

    </div>
  </div>
  <script type="text/javascript">

  var shopperID;
  function show() {
    document.getElementById("paymentWindow").style.display="Block";
    document.getElementById("shopperDetails").style.display="none";
  }

  function newCard() {
    document.getElementById("onClickPay").style.display="none";
    $('#cardWindow').html('<div class="form-div"> \
    <img id="cardBrand" src="card@2x.svg" height="20" width="26"> \
    <form class="payment-div" method="post" action="lib/Client.php"> \
    <input type="hidden" name="txvariant" value="card"/><div class="cards-div"> \
    <div class="js-chckt-pm__pm-holder"><input type="hidden" name="txvariant" value="card"/> \
    <input type="hidden" id ="shopperReference" name="shopperReference" value="" \
    /><label><span class="input-field" data-cse="encryptedCardNumber" /> \
    </label><label><span class="input-field" data-cse="encryptedExpiryMonth" /> \
    </label><label><span class="input-field" data-cse="encryptedExpiryYear" /> \
    </label><label><span class="input-field" data-cse="encryptedSecurityCode" /> \
    </label></div></div><button id="payBtn"  \
    class="btn btn-primary btn-lg btn-block" name="submit" type="submit"> \
    Pay Now</button><hr class="mb-4"></form></div>');

    var csfSetupObj = {
      rootNode: '.cards-div',
      configObject : {
        originKey : "pub.v2.8015475570411893.aHR0cHM6Ly81NC4xNjkuMTUzLjEzNQ.NHdHZXBFzNc6GnKq4IY_GFDo6cCqugD67Nh3pDaG6oo"
      }
    };

    document.getElementById('shopperReference').value = shopperID;
    var securedFields = csf(csfSetupObj);
    securedFields.onBrand ( function(brandObject){
      $("#cardBrand").attr("src", brandObject.brandImage.replace("png","svg"));
    });


  }

  function getMethods(){

    shopperID = $("#email").val();

    $.ajax({
      url: 'lib/Token.php',
      type: 'post',
      data: { "callFunc1": "1",
              "shopperReference": shopperID},
      success: function(response) {
        $('#paymentWindow').html(response);
        var csfSetupObj = {
          rootNode: '.cards-div',
          configObject : {
            originKey : "pub.v2.8015475570411893.aHR0cHM6Ly81NC4xNjkuMTUzLjEzNQ.NHdHZXBFzNc6GnKq4IY_GFDo6cCqugD67Nh3pDaG6oo"
          }
        };

        document.getElementById('shopperReference').value = shopperID;
        var securedFields = csf(csfSetupObj);
        securedFields.onBrand ( function(brandObject){
          $("#cardBrand").attr("src", brandObject.brandImage.replace("png","svg"));
        });
      }
    });

  }
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
