<!DOCTYPE html>
<html>
<head>
  <title>Adyen Demo Store</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- External CSS -->
  <link rel="stylesheet" href="../css/style.css" type="text/css">
</head>
<body>
  <div>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="../index.php" class="p-2 text-dark">Adyen DEMO</a></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="cart.php"><i class="fas fa-cart-plus"></i> Cart</a>
        <a class="p-2 text-dark" href="order.php"><i class="fas fa-user"></i> My Order</a>
        <a class="p-2 text-dark" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </nav>
    </div>

    <div class="container">
      <div class="py-5 text-center">
        <img id="logo" class="d-block mx-auto mb-4" src="https://ga0.imgix.net/logo/o/112563-1519298310-3838809?ixlib=rb-1.0.0&ch=Width%2CDPR&auto=format" alt="" width="100" height="100">
        <h2 id="merchantName">Merchant Name</h2>
        <h5>Powered by Adyen</h5>
      </div>
      <div class="row center-align">
          <div class="col-xs-6" style="margin: auto;">
              <div class="panel panel-primary">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    <?php
                    if ($_GET["resultCode"] == "authorised" or $_GET["resultCode"] == "Authorised"){
                      echo '<h2 class="heading">Payment Successful!</h2>';
                    } else {
                      echo '<h2 class="heading">Oops! Something Went Wrong..</h2>';
                    }

                    ?>
                  </div>
              </div>
          </div>
      </div>

    </div>
    <br><br><br><br><br><br><br><br>
    <footer class="footer">
      <div class="container">
        <center>
          <p>Copyright &copy Adyen APAC Demo Store. All Rights Reserved.</p>
        </center>
      </div>
    </footer>
  </div>
  <script src="../js/main.js"></script>
  <script type="text/javascript">
    console.log(<?php echo json_encode($_POST);?>)
  </script>
</body>
</html>
