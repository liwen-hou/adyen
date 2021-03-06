<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="img/lifestyleStore.png" />
  <title>Lifestyle Store</title>
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
    <?php
    require '../header.php';
    ?>
    <div class="container">
      <div class="row">
          <div class="col-xs-6">
              <div class="panel panel-primary">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    <?php
                    echo json_encode($_POST);
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
          <p>Copyright &copy Lifestyle Store. All Rights Reserved. | Contact Us: +91 90000 00000</p>
        </center>
      </div>
    </footer>
  </div>
</body>
</html>
