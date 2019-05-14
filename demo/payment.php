<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }

    $user_id=$_SESSION['id'];
    $user_cart_query="select it.id,it.name,it.price, count(*) as count from cart c inner join items it on it.id=c.item_id where c.user_id='$user_id' group by it.id";
    $user_cart_result=mysqli_query($con,$user_cart_query) or die(mysqli_error($con));
    $no_of_user_products= mysqli_num_rows($user_cart_result);
    $sum=0;
    if($no_of_user_products==0){
        //echo "Add items to cart first.";
    ?>
        <script>
        window.alert("No items in the cart!!");
        </script>
    <?php
    }else{
        while($row=mysqli_fetch_array($user_cart_result)){
            $sum=$sum+$row['price']*$row['count'];
       }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/2.4.2/adyen.css" />
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <title>My Demo Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"> -->
        <script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/2.4.2/adyen.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- jquery library -->
        <!-- <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script> -->
        <!-- Latest compiled and minified javascript -->
        <!-- <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> -->
        <!-- External CSS -->
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
                   <p>Copyright &copy Lifestyle Store. All Rights Reserved. | Contact Us: +91 90000 00000</p>
               </center>
               </div>
           </footer>
        </div>

        <script type="text/javascript">

        const configuration = {
          locale: "en_US",
          originKey: "pub.v2.8115542607200414.aHR0cHM6Ly81NC4xNjkuMTUzLjEzNQ.f9WWVFiWGrcemxPlRbkjR9jDKKUT51yLRxE6kV_pdlU",
          loadingContext: "https://checkoutshopper-test.adyen.com/checkoutshopper/"
        };

        $(document).ready(function(){

          $.ajax({
            url: 'payment/payment_methods.php',
            type: 'post',
            data: {
              "shopperReference": "<?php echo $_SESSION['email'];?>",
              "amount": "<?php echo $sum;?>",
              "currency": "SGD"
            },
            success: function(response) {
              response = JSON.parse(response);
              var html = '';
              var issuers = new Object();
              $.each(response.paymentMethods, function (i, item) {
                if (item.type === 'molpay_ebanking_fpx_MY') {
                  issuers = item.details[0].items;
                }
                html = html +
                '<div class="custom-control custom-radio">' +
                '<input id="' + item.type + '" name="paymentMethod" type="radio" class="custom-control-input" value="' + item.type + '" required>' +
                '<label class="custom-control-label" for="' + item.type + '">' + item.name + '</label>' +
                '</div>' +
                '</div>';

              });
              $('#selectPaymentMethods').html(html);
              $('#selectPaymentMethods input').on('change', function() {
                var method = $('input[name=paymentMethod]:checked', '#selectPaymentMethods').val();
                if (method === 'scheme') {
                  $('#shopperDetails').html('<div id="card"></div>');
                  const checkout = new AdyenCheckout(configuration);

                  const card = checkout.create("card", {
                    enableStoreDetails: true,
                    enableOneClick: true,
                    onChange: handleOnChange
                  }).mount("#card");

                } else if (method === 'molpay_ebanking_fpx_MY') {
                  html = '<div id="molpay_ebanking_fpx_MY"><div class="col-md-5 mb-3">' +
                  '<label for="issuer">Bank</label>' +
                  '<select class="custom-select d-block w-100" id="issuer" required>' +
                  '<option value="">Choose...</option>';
                  $.each(issuers, function (i, item) {
                    html = html + '<option value="' + issuers[i].id + '">' + issuers[i].name + '</option>';
                  });
                  html = html + '</select></div></div>';
                  $('#shopperDetails').html(html);

                } else {
                  $('#shopperDetails').html('<div id="molpay_cash"></div>');
                }

              });
            }
          });
        });

        var cardData = new Object();

        function handleOnChange(state, component) {
          state.isValid // true or false.
          state.data
          cardData = state.data
          console.log(state.data)
        }

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
              if (response.redirect) {
                if (response.redirect.data){
                  form3dSubmit(response);
                } else {
                  window.location.href = response.redirect.url;
                }
              } else {
                window.location.href = 'payment/payment_result.php?resultCode=' + response.resultCode;
              }
            }
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
          hiddenTermUrl.value = encodeURI("https://54.169.153.135/demo/payment/3D_details.php");
          form.appendChild(hiddenTermUrl);
          document.body.appendChild(form);
          form.submit();
        }






      </script>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


    </body>
</html>
