<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal"><a href="../index.php" class="p-2 text-dark">Adyen DEMO</a></h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <?php
    if(isset($_SESSION['email'])){
    ?>
    <a class="p-2 text-dark" href="../cart.php"><i class="fas fa-cart-plus"></i> Cart</a>
    <a class="p-2 text-dark" href="../order.php"><i class="fas fa-user"></i> My Order</a>
    <a class="p-2 text-dark" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    <?php
    }else{
    ?>
    <a class="p-2 text-dark" href="../signup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
    <a class="p-2 text-dark" href="../login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
    <?php
    }
    ?>
  </nav>
</div>
