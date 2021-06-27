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
    <link rel="stylesheet" href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/3.18.2/adyen.css" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body class="bg-light" style="background: url(img/bg.jpg) no-repeat center center fixed; background-size: cover;">
    <?php
     require 'header.php';
    ?>

    <div class="container">
      <?php
       require 'banner.php';
      ?>
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4" id="cartDiv">
          <input type="text" class="form-control" id="accountCode" placeholder="Account Code" value="<?php echo $_GET['accountCode'] ?>" hidden>
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted"><font color="#f8f9fa">Your cart</font></span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Item 1</h6>
                <small class="text-muted">Description here</small>
              </div>
              <span class="text-muted">$80</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Item 2</h6>
                <small class="text-muted">Description here</small>
              </div>
              <span class="text-muted">$25</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>PROMOCODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>$100</strong>
            </li>
          </ul>
        </div>
        <div class="col-md-4 order-md-2 mb-4" id="cartDiv">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted"><font color="#f8f9fa">Your cart</font></span>
            <span class="badge badge-secondary badge-pill">2</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Marketplace 1 Item</h6>
                <small class="text-muted">EUR 20</small>
              </div>
              <span><input type="text" class="form-control" id="accountCode1" placeholder="Account Code"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Marketplace 2 Item</h6>
                <small class="text-muted">EUR 80</small>
              </div>
              <span><input type="text" class="form-control" id="accountCode2" placeholder="Account Code"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Commission</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">
                <select class="custom-select d-block w-2" id="commission" required="">
                  <option value="">Choose...</option>
                  <option value="5">5%</option>
                  <option value="10">10%</option>
                </select>
              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">VAT</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">
                <select class="custom-select d-block w-2" id="vat" required="">
                  <option value="">Choose...</option>
                  <option value="3">3%</option>
                  <option value="7">7%</option>
                </select>
              </span>
            </li>

            <li class="list-group-item d-flex justify-content-between">
              <span>Total (EUR)</span>
              <strong>100</strong>
            </li>
          </ul>

        </div>

        <div class="col-md-8 order-md-1">
          <h4 class="mb-3"><font color="#f8f9fa">Enter Your Email Address</font></h4>
          <form class="needs-validation" novalidate>


            <div class="mb-3">
              <label for="address">Email</label>
              <input type="text" class="form-control" id="email" placeholder="example@me.com" required>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" onchange="paymentMethod()" required>
                  <option value="">Choose...</option>
                  <option value="SG">Singapore</option>
                  <option value="PH">Philippines</option>
                  <option value="ID">Indonesia</option>
                  <option value="MY">Malaysia</option>
                  <option value="TH">Thailand</option>
                  <option value="IN">India</option>
                  <option value="">All</option>

                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State/Region</label>
                <select class="custom-select d-block w-100" id="state" required>
                  <option value="">Choose...</option>
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="" required>
              </div>
            </div>


            <hr class="mb-4">

            <h4 class="mb-3"><font color="#f8f9fa">Payment Details</font></h4>
            <div class="d-block my-3" id='selectPaymentMethods'>
            </div>
          </form>
        </div>

    </div>

    <?php
     require 'footer.php';
    ?>


    <script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/3.18.2/adyen.js"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="./js/main.js"></script>
  </body>
</html>
