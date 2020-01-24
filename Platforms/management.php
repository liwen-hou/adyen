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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

</head>

<body class="bg-light" style="background: url(img/bg.jpg) no-repeat center center fixed; background-size: cover;">
  <?php
  require 'header.php';
  ?>
  <div class="container">
    <?php
     require 'banner.php';
    ?>

    <div class="row center-align">
      <div class="col-md-5">
        <h4 class="mb-3"><font color="white">Select a Restaurant</font></h4>
        <div class="seller-card" id="sellerInfo">
          <img class="d-block mx-auto mb-4" src="img/network.svg" alt="" width="50" height="50">
          <div class="mb-3">
            <select class="custom-select d-block w-100" id="sellerId" onchange="this.options[this.selectedIndex].value && (window.location = 'management.php?sellerId=' + this.options[this.selectedIndex].value);" >
              <option value="">Choose...</option>

              <?php
              $csvFile = 'config/sellerList.csv';
              if (($handle = fopen($csvFile, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                  // here you get headers, there's no need to increment `$row` any more than here
                  echo '<option value="' . $data[0] . '">' . $data[0] . '</option>';
                  // here you replace - array of `$vars` to array of `$data`
                }
                fclose($handle);
              }
              ?>

            </select>
          </div>
        </div>
      </div>
      <div class="col-md-2">

        <div class="signin-social-separator" style="height: 430px;"><div class="vl"></div></div>
      </div>
      <div class="col-md-5">
        <h4 class="mb-3"><font color="white">Manage Restaurant Locations</font></h4>
        <div class="seller-card" id="sellerInfo">
          <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center" data-toggle="modal" data-target="#addStoreModal">
              Add a New Store
              <span class="badge badge-secondary badge-pill">+</span>
            </li>
          </ul>
        </div>
        <div class="row" id="storeList">
          <button class="col-md-3 store-details" data-toggle="modal" data-target="#addStoreModal"><h2 style="color: #e5eaef;">+</h2></button>
        </div>

      </div>
    </div>

    <hr class="mb-4">


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
                <label for="storeId">Store Reference</label>
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
          html = '<li class="list-group-item d-flex justify-content-between align-items-center" id="' + store.store + '" onclick="showTerminal(this.id);" data-toggle="modal" data-target="#assignTerminalModal">' + store.storeReference + '<span class="badge badge-success badge-pill">Active</span></li>'
          $('#storeList').append(html);
          i++;
        }

      }
    });


    function showTerminal(storeId){
      $.ajax({
        url: 'payment/show_terminal.php',
        type: 'get',
        success: function(response) {
          response = JSON.parse(response);
          console.log(response);
          terminals = response.merchantAccounts[0].inventoryTerminals;

          var html = "";
          if (terminals) {
            var i;
            for (i=0;i<terminals.length;i++) {
              console.log(terminals[i]);
              var terminalModel = terminals[i].split("-")[0];
              var html = html + '<div class="card col-sm-4" id="' + terminalModel + '"> \
              <img id="terminal-img" src="img/' + terminalModel + '.png" class="card-img-top" alt="..."> \
              <div class="storeDetails"> \
              <h6 class="card-title">' + terminals[i] + '</h6><button id="' + terminals[i] +  ' ' + storeId + '" class="btn btn-primary btn-lg btn-block" type="button" onclick="assignTerminal(this.id);">Choose</button> \
              </div> \
              </div>';

            }

          }
          stores = response.merchantAccounts[0].stores;
          if (stores) {
            var i;
            for (i=0;i<stores.length;i++) {
              if (stores[i].store == storeId) {
                inStoreTerminals = stores[i].inStoreTerminals;
                var j;
                for (j=0;j<inStoreTerminals.length;j++) {
                  var terminalModel = inStoreTerminals[j].split("-")[0];
                  var html = html + '<div class="card col-sm-4" id="' + terminalModel + '"> \
                  <img id="terminal-img" src="img/' + terminalModel + '.png" class="card-img-top" alt="..."> \
                  <div class="storeDetails"> \
                  <h6 class="card-title">' + inStoreTerminals[j] + '</h6><button class="btn btn-primary btn-lg btn-block" type="button" disabled>Assigned</button> \
                  </div> \
                  </div>';

                }
              }
            }
          }
          $("#terminalList").html(html);

        }
      });
    }

    function assignTerminal(storeTerminal) {
      terminalId = storeTerminal.split(" ")[0];
      storeId = storeTerminal.split(" ")[1];
      console.log(terminalId);
      console.log(storeId);

      $.ajax({
        url: 'payment/assign_terminal.php',
        type: 'post',
        data: {
          "store": storeId,
          "terminals": terminalId
        },
        success: function(response) {
          response = JSON.parse(response);
          console.log(response);
          window.alert("Terminal successfully assigned!");

        }
      });

    }
    </script>
  </body>
</html>
