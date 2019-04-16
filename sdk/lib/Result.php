<?php

/**
 *                       ######
 *                       ######
 * ############    ####( ######  #####. ######  ############   ############
 * #############  #####( ######  #####. ######  #############  #############
 *        ######  #####( ######  #####. ######  #####  ######  #####  ######
 * ###### ######  #####( ######  #####. ######  #####  #####   #####  ######
 * ###### ######  #####( ######  #####. ######  #####          #####  ######
 * #############  #############  #############  #############  #####  ######
 *  ############   ############  #############   ############  #####  ######
 *                                      ######
 *                               #############
 *                               ############
 *
 * Adyen Checkout Example (https://www.adyen.com/)
 *
 * Copyright (c) 2017 Adyen BV (https://www.adyen.com/)
 *
 */
 echo '<!DOCTYPE html>
 <html class="html">
 <head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="robots" content="noindex"/>
   <title>Adyen Checkout</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">

 </head>

 <body>
 <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
   <h5 class="my-0 mr-md-auto font-weight-normal">Adyen Payment Experience</h5>
   <nav class="my-2 my-md-0 mr-md-3">
     <a class="p-2 text-dark" href="/">Checkout API</a>
     <a class="p-2 text-dark" href="/sdk">Checkout SDK</a>
     <a class="p-2 text-dark" href="/pos">POS</a>
     <a class="p-2 text-dark" href="/classic">Classic Integration</a>
   </nav>
 </div>
   <div class="container" id="paymentResult">
     <div class="py-5 text-center">';

 if ($_GET["resultCode"] == "authorised"){
     echo '<img class="d-block mx-auto mb-4" src="../assets/img/shopping.png" alt="" width="100" height="100">
     <h2 class="heading">Payment Successful! Your Order is On the Way!</h2>';
   } else {
     echo '<img class="d-block mx-auto mb-4" src="../assets/img/error.png" alt="" width="100" height="100">
     <h2 class="heading">Oops! Something Went Wrong..</h2>';
   }

   echo '</div>
   </div>

   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

 </body>
 </html>';
 ?>
