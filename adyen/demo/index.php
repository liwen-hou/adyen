<?php
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/3.6.1/adyen.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <title>Adyen Demo Store</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- latest compiled and minified CSS -->
  <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"> -->
  <script src="https://pay.google.com/gp/p/js/pay.js"></script>
  <script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/3.6.1/adyen.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
  <div>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="index.php" class="p-2 text-dark">Adyen DEMO</a></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="cart.php"><i class="fas fa-cart-plus"></i> Cart</a>
        <a class="p-2 text-dark" href="order.php"><i class="fas fa-user"></i> My Order</a>
        <a class="p-2 text-dark" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </nav>
    </div>

    <br>
    <div class="container">
      <?php
       require 'banner.php';
      ?>
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Item 1</h6>
                <small class="text-muted">Description here</small>
              </div>
              <span class="text-muted">$120</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Item 2</h6>
                <small class="text-muted">Description here</small>
              </div>
              <span class="text-muted">$55</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Item 3</h6>
                <small class="text-muted">Description here</small>
              </div>
              <span class="text-muted">$100</span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>PROMOCODE</small>
              </div>
              <span class="text-success">-$25</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>$250</strong>
            </li>
          </ul>

        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Personal Details</h4>
          <form class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Email</label>
              <input type="text" class="form-control" id="email" placeholder="example@me.com" required>
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" id="country" onchange="startPayment()" required>
                  <option value="">Choose...</option>
                  <option value="SG">Singapore</option>
                  <option value="NL">Neitherlands</option>
                  <option value="MY">Malaysia</option>
                  <option value="PH">Philippines</option>
                  <option value="ID">Indonesia</option>
                  <option value="TH">Thailand</option>
                  <option value="CN">China</option>
                  <option value="HK">Hong Kong</option>
                  <option value="TW">Taiwan</option>
                  <option value="IN">India</option>
                  <option value="MX">Mexico</option>
                  <option value="BR">Brazil</option>
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

            <h4 class="mb-3">Payment Details</h4>
            <div class="d-block my-3" id='doku'></div>
            <div class="d-block my-3" id='selectPaymentMethods'>
            </div>

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="button" id="terminalBtn" onclick="payAtTerminal()">Pay at the terminal</button>
          </form>
        </div>

      </div>
    </div>
  </div>

    </div>
    <br><br><br><br><br><br><br><br><br><br>
    <footer class="footer">
      <div class="container">
        <center>
          <p>Copyright &copy Adyen APAC Demo Store. All Rights Reserved.</p>
        </center>
      </div>
    </footer>
  </div>

  <script src="js/main.js"></script>

</body>
</html>
