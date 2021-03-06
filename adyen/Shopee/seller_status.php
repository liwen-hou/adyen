<?php
date_default_timezone_set("Europe/Amsterdam");
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

</head>

  <?php
  require 'background.php';
  ?>
  <?php
  require 'header.php';
  ?>
  <div class="container">
    <?php
     require 'banner.php';
    ?>

    <div class="row center-align">
      <div class="col-md-5">

        <div class="seller-card" id="sellerInfo"></div>
      </div>
      <div class="col-md-2">

        <div class="signin-social-separator" style="height: 430px;"><div class="vl"></div></div>
      </div>
      <div class="col-md-5">

        <a href="payment/adyen_kyc.php?sellerId=<?php echo $_GET['sellerId']; ?>" class="kyc-card">
          <h5 class="card-title">Complete KYC</h5>
          <p class="seller-option-text">Click here to use Adyen Hosted On-boarding Page to complete your KYC information.</p>
          <img src="img/icon-welcome.svg">
        </a>

      </div>
    </div>

    <hr class="mb-4" color="white">
    <h4 class="mb-3"><font color="white">View Your Stores</font></h4>
    <div class="row" id="storeList">
    </div>

    <!-- Modal for creating store-->
    <div class="modal fade" id="addStoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add a Store</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="payment/create_store.php?sellerId=<?php echo $_GET['sellerId']; ?>" method="post">
            <div class="modal-body">
              <div class="mb-3">
                <label for="sellerId">Store Reference</label>
                <input type="text" class="form-control" id="storeRef" name="storeRef" placeholder="Reference for your store">
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">Street</label>
                  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Street Name" value="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">City</label>
                  <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Paris" value="">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="firstName">House Number</label>
                  <input type="text" class="form-control" id="houseNumberOrName" name="houseNumberOrName" placeholder="01" value="">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="lastName">Postal Code</label>
                  <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="111111" value="">
                </div>
              </div>

              <div class="mb-3">
                <label for="sellerId">Phone Number</label>
                <input type="text" class="form-control" id="fullPhoneNumber" name="fullPhoneNumber" placeholder="+33 1111 1111">
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save Store</button>
            </div>
          </form>

        </div>
      </div>
    </div>

    <!-- Modal for terminal assignment-->
    <div class="modal fade" id="assignTerminalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Choose an Available Terminal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row" id="terminalList">
            </div>
          </div>


        </div>
      </div>
    </div>

  </div>

  <?php
   require 'footer.php';
  ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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

        html = '<h5 class="card-title" style="margin-bottom: 10px;">Welcome back '+ response.accountHolderDetails.individualDetails.name.firstName + ' ' + response.accountHolderDetails.individualDetails.name.lastName + '</h5>';
        $('#sellerInfo').append(html);

        html = '<img class="d-block mx-auto mb-4" src="img/users.svg" alt="" width="50" height="50">';
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

        var i=0;
        while (response.accountHolderDetails.storeDetails[i]) {
            // code block to be executed
            var store = response.accountHolderDetails.storeDetails[i];
            html = '<button id="' + store.store + '" class="col-md-2 store-details"><h6>' + store.storeReference + '</h6><img src="img/pos.svg" width="40" height="40"><br><span class="badge badge-success">Active</span></h6></button>';
            $('#storeList').append(html);
            i++;
        }

      }
    });

    </script>
  </body>
</html>
