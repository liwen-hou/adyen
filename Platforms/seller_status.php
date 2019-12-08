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
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <?php
     require 'header.php';
    ?>
    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/adyen.png" alt="" width="72" height="72">
        <h2>Adyen for Platforms DEMO</h2>
      </div>

      <div class="row center-align">
        <div class="col-md-5">

          <div class="seller-card" id="sellerInfo"></div>
        </div>
        <div class="col-md-2">

          <div class="signin-social-separator" style="height: 300px;"><div class="vl"></div></div>
        </div>
        <div class="col-md-5">

          <a href="payment/adyen_kyc.php?sellerId=<?php echo $_GET['sellerId']; ?>" class="kyc-card">
              <h5 class="card-title">Complete KYC</h5>
              <p class="seller-option-text">Click here to use Adyen Hosted On-boarding Page to complete your KYC information.</p>
          </a>

        </div>
      </div>

    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2019 Adyen for Platforms Demo</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    $.ajax({
      url: 'payment/get_seller_status.php',
      type: 'post',
      data: {
        "sellerId": "<?php echo $_GET['sellerId']; ?>"
      },
      success: function(response) {
        response = JSON.parse(response);
        console.log(response);

        html = '<h5 class="card-title">Welcome back '+ response.accountHolderDetails.individualDetails.name.firstName + ' ' + response.accountHolderDetails.individualDetails.name.lastName + '</h5>';
        $('#sellerInfo').append(html);

        html = '<h6>Account Code: <span class="badge badge-light">' + response.accounts[0].accountCode + '</span></h6>';
        $('#sellerInfo').append(html);

        html = '<h6>Processing Tier: <span class="badge badge-light">' + response.accountHolderStatus.processingState.tierNumber + '</span></h6>';
        $('#sellerInfo').append(html);

        var accountStatus = response.accountHolderStatus.status;
        if (accountStatus == "Active") {
          html = '<h6>Account Status: <span class="badge badge-success">Active</span></h6>';
          $('#sellerInfo').append(html);
        } else {
          html = '<h6>Account Status: <span class="badge badge-danger">Inactive</span></h6>';
          $('#sellerInfo').append(html);
        }

        var payoutStatus = response.accountHolderStatus.payoutState.allowPayout;
        if (payoutStatus) {
          html = '<h6>Payout Status: <span class="badge badge-success">Active</span></h6>';
          $('#sellerInfo').append(html);
        } else {
          html = '<h6>Payout Status: <span class="badge badge-danger">Inactive</span></h6>';
          $('#sellerInfo').append(html);
        }

      }
    });
    </script>
  </body>
</html>
