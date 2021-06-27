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

    <title>Liwen Shopify DEMO</title>
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

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="home"></span>
                  Home <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file"></span>
                  Orders
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="shopping-cart"></span>
                  Products
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="users"></span>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="bar-chart-2"></span>
                  Analytics
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="layers"></span>
                  Apps
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Sales Channels</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Online Store
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h5 class="h5">Payments</h5>
          </div>

          <div class="card payment-option">
            <div class="card-body">
              <img src="https://cdn.shopify.com/shopifycloud/web/assets/v1/950ccf26a6f71fa5070d11ea1f93d3e8.svg" class="_1c71_" alt="Shopify Payments">
              <br><br>
              <div class="row">
               <div class="col-sm-4"><h6>Credit card rate</h6><span>As low as 3.2% + $0.50</span></div>
               <div class="col-sm-4"><h6>Transaction fee</h6><span>0%</span></div>
               <div class="col-sm-4"><h6>Payout bank account</h6><span>****** 46 (SGD)</span></div>
              </div>
              <br><br>
              <h6>Accepted payments</h6>
              <div class="row">
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://cdn.shopify.com/shopifycloud/web/assets/v1/52d3db0594f3166f0aa9898a71d01a22.svg" alt="Visa">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://cdn.shopify.com/shopifycloud/web/assets/v1/b07d7f70cd57ff74e7e2827f124bd756.svg" alt="MasterCard">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://cdn.shopify.com/shopifycloud/web/assets/v1/fa3c344b2f8c260afd44d7cd6b897936.svg" alt="AMEX">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://cdn.shopify.com/shopifycloud/web/assets/v1/25540e5c8ee1c9c066d1263a9e55115a.svg" alt="Shop Pay">                </span>
              </div>
              <br>
              <a href="#" class="btn btn-primary float-right">View payouts</a>
            </div>
          </div>

          <div class="card payment-option">
            <div class="card-body">
              <svg width="92.78" height="30" enable-background="new 0 0 90 29.1" viewBox="0 0 90 29.1" xmlns="http://www.w3.org/2000/svg">
                <g fill="#0abf53">
                  <path d="m12.7 6.6h-12.5v4h8.1c.5 0 .9.4.9.9v7h-1.7c-.5 0-.9-.4-.9-.9v-5h-3.4c-1.8 0-3.2 1.4-3.2 3.2v3.6c0 1.8 1.4 3.2 3.2 3.2h12.7v-12.8c0-1.8-1.4-3.2-3.2-3.2z"></path>
                  <path d="m27.8 18.5h-1.7c-.5 0-.9-.4-.9-.9v-11h-3.4c-1.8 0-3.2 1.4-3.2 3.2v9.5c0 1.8 1.4 3.2 3.2 3.2h12.7v-22.5h-6.6z"></path>
                  <path d="m46.3 18.5h-1.7c-.5 0-.9-.4-.9-.9v-11h-6.6v12.7c0 1.8 1.4 3.2 3.2 3.2h6.1v2h-9v4.6h12.5c1.8 0 3.2-1.4 3.2-3.2v-19.3h-6.6v11.9z"></path>
                  <path d="m68.3 6.6h-12.7v12.7c0 1.8 1.4 3.2 3.2 3.2h12.5v-4h-8.1c-.5 0-.9-.4-.9-.9v-7h1.7c.5 0 .9.4.9.9v5h3.4c1.8 0 3.2-1.4 3.2-3.2v-3.5c0-1.8-1.5-3.2-3.2-3.2z"></path>
                  <path d="m86.8 6.6h-12.7v15.9h6.6v-11.9h1.7c.5 0 .9.4.9.9v11h6.7v-12.7c0-1.8-1.4-3.2-3.2-3.2z"></path>
                </g>
              </svg>
              <br><br>
              <?php if($_GET["sellerId"]) : ?>
                <div class="row" id="sellerInfo">
                </div>
                <br><br><a href="payment/adyen_kyc.php?sellerId=<?php echo $_GET['sellerId']; ?>" class="btn btn-primary float-right">Complete KYC for payouts</a>
              <?php else : ?>
              <p class="card-text">Simple and flexible payment solution powered by Adyen for Platforms.</p>
              <h6>Accepted payments</h6>
              <div class="row">
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://cdn.shopify.com/shopifycloud/web/assets/v1/52d3db0594f3166f0aa9898a71d01a22.svg" alt="Visa">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://cdn.shopify.com/shopifycloud/web/assets/v1/b07d7f70cd57ff74e7e2827f124bd756.svg" alt="MasterCard">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://cdn.shopify.com/shopifycloud/web/assets/v1/fa3c344b2f8c260afd44d7cd6b897936.svg" alt="AMEX">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://checkoutshopper-live.adyen.com/checkoutshopper/images/logos/alipay.svg" alt="Alipay">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://checkoutshopper-live.adyen.com/checkoutshopper/images/logos/wechatpay.svg" alt="Wechat Pay">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <img class="_1hsGR _3XiaH" src="https://checkoutshopper-live.adyen.com/checkoutshopper/images/logos/zip.svg" alt="ZIP Pay">
                </span>
                <span style="margin-top: .8rem; margin-left: .8rem;">
                  <h6>and more</h6>
                </span>
              </div>
              <br>
              <a href="signup.php" class="btn btn-primary float-right">Complete account setup</a>
              <?php endif; ?>
            </div>
          </div>

          <div class="card payment-option">
            <div class="card-body">
              <h5 class="card-title">Third-party providers</h5>
              <p class="card-text">Providers that enable you to accept payment methods at a rate set by the third-party.</p>
              <a href="#" class="btn btn-primary float-right">Choose third-part </a>
              </p>
            </div>
          </div>

          <div class="card payment-option">
            <div class="card-body">
              <h5 class="card-title">Manual payment methods</h5>
              <p class="card-text">Payments that are processed outside your online store. When a customer makes a manual payment, you need to approve their order before fulfilling.</p>
              <a href="#" class="btn btn-primary float-right">View manual payment methods</a>
              </p>
            </div>
          </div>




        </main>
      </div>
    </div>

    <?php
     require 'footer.php';
    ?>

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

        html = '<div class="col-sm-3"><h6>Adyen account code</h6><span>' + response.accounts[0].accountCode + '</span></div>';
        $('#sellerInfo').append(html);

        html = '<div class="col-sm-3"><h6>Processing tier</h6><span>' + response.accountHolderStatus.processingState.tierNumber + '</span></div>';
        $('#sellerInfo').append(html);

        var accountStatus = response.accountHolderStatus.status;
        if (accountStatus == "Active") {
          html = '<div class="col-sm-3"><h6>Account Status</h6><span class="badge badge-success">Active</span></div>';
          $('#sellerInfo').append(html);
        } else {
          html = '<div class="col-sm-3"><h6>Account Status</h6><span class="badge badge-danger">Inactive</span></div>';
          $('#sellerInfo').append(html);
        }

        var payoutStatus = response.accountHolderStatus.payoutState.allowPayout;
        if (payoutStatus) {
          html = '<div class="col-sm-3"><h6>Payout Status</h6><span class="badge badge-success">Active</span></div>';
          $('#sellerInfo').append(html);
        } else {
          html = '<div class="col-sm-3"><h6>Payout Status</h6><span class="badge badge-danger">Inactive</span></div>';
          $('#sellerInfo').append(html);
        }

      }
    });

    </script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <script>


    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation')

        // Loop over them and prevent submission
        Array.prototype.filter.call(forms, function (form) {
          form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
      }, false)
    }())

    </script>
  </body>
</html>
