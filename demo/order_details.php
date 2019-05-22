<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
    $user_id = $_SESSION['id'];
    $order_id = $_GET['order_id'];
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
            <br>
            <div class="container">
                <table class="table table-hover table-sm">
                    <tbody class="align-middle">
                        <tr>
                            <th>ITEM</th><th>NAME</th><th>QTY</th><th>UNIT PRICE</th><th></th>
                        </tr>
                       <?php
                       $order_details_query="select od.item_id as id, it.name as name, it.price as price, od.count as count, od.status as status from order_details od inner join items it on od.item_id = it.id where od.order_id = '".$order_id."';";
                       $order_details_result=mysqli_query($con,$order_details_query) or die(mysqli_error($con));
                       while($row=mysqli_fetch_array($order_details_result)){

                         ?>
                        <tr>
                            <td class="align-middle"><img src="img/<?php echo $row['id']?>.jpg" width="100" height="100"></td><td class="align-middle"><?php echo $row['name']?></td><td class="align-middle"><?php echo $row['count']?></td><td class="align-middle">SGD <?php echo $row['price']/100?></td>
                            <td class="align-middle"><a href=''>RETURN</a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                </table>
            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <footer class="footer">
               <div class="container">
               <center>
                   <p>Copyright &copy Lifestyle Store. All Rights Reserved.</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
