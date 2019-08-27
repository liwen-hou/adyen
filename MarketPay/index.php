<?php
date_default_timezone_set("Asia/Singapore");
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/3.1.0/adyen.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <title>My Demo Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/3.1.0/adyen.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php
               require 'header.php';
            ?>
            <br>
            <div class="container">

              <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                  <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                  </h4>
                  <ul class="list-group mb-3">
                    <?php
                     $user_cart_result=mysqli_query($con,$user_cart_query) or die(mysqli_error($con));
                     $no_of_user_products= mysqli_num_rows($user_cart_result);
                    while($row=mysqli_fetch_array($user_cart_result)){

                      ?>
                      <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                          <h6 class="my-0"><?php echo $row['name']?></h6>
                          <small class="text-muted">Qty: <?php echo $row['count']?></small>
                        </div>
                        <span class="text-muted"><?php echo $row['price']/100?></span>
                      </li>
                      <?php } ?>

                    <li class="list-group-item d-flex justify-content-between">
                      <span>Total (SGD)</span>
                      <strong><?php echo $sum/100;?></strong>
                    </li>
                  </ul>

                </div>
                <div class="col-md-8 order-md-1">
                  <h4 class="mb-3">Billing address</h4>
                  <form class="needs-validation" novalidate>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Valid first name is required.
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Valid last name is required.
                        </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                      <div class="invalid-feedback">
                        Please enter your shipping address.
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                      <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                      <div class="col-md-5 mb-3">
                        <label for="country">Country</label>
                        <select class="custom-select d-block w-100" id="country" required>
                          <option value="">Choose...</option>
                          <option>United States</option>
                        </select>
                        <div class="invalid-feedback">
                          Please select a valid country.
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="state">State</label>
                        <select class="custom-select d-block w-100" id="state" required>
                          <option value="">Choose...</option>
                          <option>California</option>
                        </select>
                        <div class="invalid-feedback">
                          Please provide a valid state.
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">
                          Zip code required.
                        </div>
                      </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="same-address">
                      <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Payment Details</h4>
                    <div class="d-block my-3" id='selectPaymentMethods'>
                    </div>
                    <div id="shopperDetails">
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="button" id="checkoutBtn">Continue to checkout</button>
                  </form>
                </div>
              </div>

            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <footer class="footer">
               <div class="container">
               <center>
                   <p>Copyright &copy Lifestyle Store. All Rights Reserved.</p>
               </center>
               </div>
           </footer>
        </div>

        <script type="text/javascript">



        $(document).ready(function(){

          $.ajax({
            url: 'payment/payment_methods.php',
            type: 'post',
            data: {
              "currency": "SGD"
            },
            success: function(response) {
              response = JSON.parse(response);
              $('#selectPaymentMethods').html('<div id="dropin"></div>');
              const configuration = {
                locale: "en_US",
                environment: "test",
                originKey: "pub.v2.8115614281177653.aHR0cDovL2xvY2FsaG9zdDo0OTk5.69GTI4niEUSaIj5ao_Ftn7Zb5D92yuYNl6wBGxlpkfg",
                paymentMethodsResponse: response
              };
              const checkout = new AdyenCheckout(configuration);

              const dropin = checkout
              .create('dropin', {
                paymentMethodsConfiguration: {

                  card: { //Example optional configuration for Cards
                    hasHolderName: true,
                    holderNameRequired: true,
                    enableStoreDetails: true,
                    name: 'Credit or debit card'
                  }
                },
                onSubmit: (state, dropin) => {
                  makePayment(state.data)
                  // Your function calling your server to make the /payments request
                  .then(paymentResponse => {
                    console.log(paymentResponse);
                    if (paymentResponse.hasOwnProperty("action")) {
                      dropin.handleAction(paymentResponse.action);
                    } else {
                      return paymentResponse.resultCode;
                    }
                    // Drop-in will handle the action object from the /payments response
                  })
                  // .then (resultCode => {
                  //   if (resultCode == "Authorised") {
                  //     dropin.setStatus('success', { message: 'Payment successful!' });
                  //   } else {
                  //     dropin.setStatus('error', { message: 'Something went wrong.'});                    }
                  // })
                  .catch(error => {
                    throw Error(error);
                  });
                },
                onAdditionalDetails: (state, dropin) => {
                  makeDetailsCall(state.data)
                  // Your function calling your server to make a /payments/details request
                  .then(response => {
                    console.log(response);
                    if (response.hasOwnProperty("action")) {
                      dropin.handleAction(response.action);
                    } else {
                      return response.resultCode;
                    }
                    // Drop-in will handle the action object from the /payments/details response
                  })


                  .catch(error => {
                    throw Error(error);
                  });
                }
              })
              .mount('#dropin');
            }
          });
        });

        document.getElementById('checkoutBtn').onclick = function() {
          var type = $('input[name=paymentMethod]:checked', '#selectPaymentMethods').val();
          var issuer = $('#issuer option:selected').val();

          $.ajax({
            url: 'payment/make_payment.php',
            type: 'post',
            data: {
              "type": type,
              "issuer": issuer,
              "encryptedCardNumber": cardData.encryptedCardNumber,
              "encryptedExpiryMonth": cardData.encryptedExpiryMonth,
              "encryptedExpiryYear": cardData.encryptedExpiryYear,
              "encryptedSecurityCode": cardData.encryptedSecurityCode
            },
            success: function(response) {
              response = JSON.parse(response);
              console.log(response);
              if (response.resultCode === "ChallengeShopper") {
                const checkout = new AdyenCheckout();
                $('#shopperDetails').html('<div id="threeDS2"></div>');
                const threeDS2Challenge = checkout
                .create('threeDS2Challenge', {
                  challengeToken: response.authentication['threeds2.challengeToken'],
                  onComplete: function(challengeData) {
                    challengeResult = challengeData.data.details["threeds2.challengeResult"];
                    form3ds2Submit("challenge", response.paymentData, challengeResult);

                  }, // Gets triggered whenever the Component has a result
                  onError: function() {}, // Gets triggered on error
                  size: '01' // Defaults to '01'
                })
                .mount('#threeDS2');
              } else if (response.resultCode === "IdentifyShopper") {
                const checkout = new AdyenCheckout();
                $('#shopperDetails').html('<div id="threeDS2"></div>');
                const threeDS2IdentifyShopper = checkout
                .create('threeDS2DeviceFingerprint', {
                  fingerprintToken: response.authentication['threeds2.fingerprintToken'],
                  onComplete: function(fingerprintData) {
                    fingerprint = fingerprintData.data.details["threeds2.fingerprint"];
                    form3ds2Submit("identify", response.paymentData, fingerprint);
                  }, // Gets triggered whenever the Component has a result
                  onError: function() {} // Gets triggered on error
                })
                .mount('#threeDS2');
              } else {
                window.location.href = 'payment/payment_result.php?resultCode=' + response.resultCode;
              }
            }
          });

        }


        function makePayment(data) {
          return new Promise((resolve, reject) => {
            $.ajax({
              url: 'payment/make_payment.php',
              type: 'post',
              data: {
                "paymentMethod": data.paymentMethod
              },
              success: function(paymentResponse) {
                paymentResponse = JSON.parse(paymentResponse);
                console.log(paymentResponse);
                resolve(paymentResponse);
              }
            });
          });
        }

        function makeDetailsCall(data) {

          console.log(data);
          return new Promise((resolve, reject) => {
            $.ajax({
              url: 'payment/payment_details.php',
              type: 'post',
              data: {
                "details": data.details,
                "paymentData": data.paymentData
              },
              success: function(paymentResponse) {
                paymentResponse = JSON.parse(paymentResponse);
                console.log(paymentResponse);
                resolve(paymentResponse);
              }
            });
          });
        }



        function form3dSubmit(response) {
          const form = document.createElement('form');
          form.method = 'post';
          form.action = response.redirect.url;
          const hiddenMD = document.createElement('input');
          hiddenMD.type = 'hidden';
          hiddenMD.name = 'MD';
          hiddenMD.value = encodeURI(response.redirect.data.MD);
          form.appendChild(hiddenMD);
          const hiddenPaReq = document.createElement('input');
          hiddenPaReq.type = 'hidden';
          hiddenPaReq.name = 'PaReq';
          hiddenPaReq.value = encodeURI(response.redirect.data.PaReq);
          form.appendChild(hiddenPaReq);
          const hiddenTermUrl = document.createElement('input');
          hiddenTermUrl.type = 'hidden';
          hiddenTermUrl.name = 'TermUrl';
          hiddenTermUrl.value = encodeURI("http://localhost:4999/payment/3D_details.php");
          form.appendChild(hiddenTermUrl);
          document.body.appendChild(form);
          form.submit();
        }

        function form3ds2Submit(type, paymentData, authResult) {

          $.ajax({
            url: 'payment/3DS2_results.php',
            type: 'post',
            data: {
              "type": type,
              "paymentData": paymentData,
              "authResult": authResult
            },
            success: function(response) {
              response = JSON.parse(response);
              console.log(response.resultCode);
              if (response.resultCode === "ChallengeShopper") {
                const checkout = new AdyenCheckout();
                $('#shopperDetails').html('<div id="threeDS2"></div>');
                const threeDS2Challenge = checkout
                .create('threeDS2Challenge', {
                  challengeToken: response.authentication['threeds2.challengeToken'],
                  onComplete: function(challengeData) {
                    challengeResult = challengeData.data.details["threeds2.challengeResult"];

                    form3ds2Submit("challenge", response.paymentData, challengeResult);

                  }, // Gets triggered whenever the Component has a result
                  onError: function() {}, // Gets triggered on error
                  size: '01' // Defaults to '01'
                })
                .mount('#threeDS2');
              } else {
                window.location.href = 'payment/payment_result.php?resultCode=' + response.resultCode;
              }

            }
          });

        }

        function payAtTerminal() {
          document.getElementById('checkoutBtn').onclick = function() {
            window.location.href = 'payment/pos_payment.php';
          }
        }

        function getQRCode() {

          $.ajax({
            url: 'payment/getQRCode.php',
            type: 'post',
            data: {
              "type": "wechatpayQR"
            },
            success: function(response) {
              response = JSON.parse(response);
              const checkout = new AdyenCheckout(configuration);
              $('#shopperDetails').html('<div id="wechat"></div>');
              const wechat = checkout.create("wechatpay", {
                paymentData: response.paymentData,
                amount: { currency: "CNY", value: 50 },
                qrCodeData: response.redirect.data.qrCodeData,
                onComplete: handleOnComplete
              }).mount("#wechat");

              function handleOnComplete(response) {
                response
                // {payload: "Ab02b4c0!BQABAgB5..."}
              }

            }
          });

        }

      </script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


    </body>
</html>
