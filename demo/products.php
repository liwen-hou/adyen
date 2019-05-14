<?php
    session_start();
    require 'check_if_added.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="img/lifestyleStore.png" />
    <title>My Demo Store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <div class="container">
                <div class="row">
                      <?php
                        require 'connection.php';
                        $get_items_query="select * from items;";
                        $get_items_result=mysqli_query($con,$get_items_query) or die(mysqli_error($con));
                        $no_of_items= mysqli_num_rows($get_items_result);
                        while($row=mysqli_fetch_array($get_items_result)){
                      ?>
                          <div class="col-md-3 col-sm-6" style="margin-bottom: 20px;">
                            <div class="card">
                              <center>
                                <img src="img/<?php echo $row['id']?>.jpg" class="card-img-top" alt="...">
                                <div class="caption">
                                  <h5 class="card-title"><?php echo $row['name']?></h5>
                                  <p><?php echo $row['currency']?> <?php echo $row['price']/100?></p>
                                  <?php if(!isset($_SESSION['email'])){  ?>
                                    <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                    <?php
                                    }
                                    else{
                                      ?>
                                      <a href="cart_add.php?id=<?php echo $row['id']?>" class="btn btn-block btn-primary" name="add" value="add">Add to cart</a>
                                      <?php
                                    }
                                    ?>
                                </div>
                              </center>
                            </div>
                          </div>
                        <?php } ?>
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
