<?php
session_start();
require_once __DIR__ . '/Config.php';
require '../connection.php';

$user_id=$_SESSION['id'];
$user_cart_query="select it.id,it.name,it.price, count(*) as count from cart c inner join items it on it.id=c.item_id where c.user_id='$user_id' group by it.id";
$user_cart_result=mysqli_query($con,$user_cart_query) or die(mysqli_error($con));
$sum=0;

while($row=mysqli_fetch_array($user_cart_result)){
  $sum=$sum+$row['price']*$row['count'];
}


try{
  // Authentication
  $authentication = Config::getAuthentication();

  // Generate url
  $url = Config::getPaymentUrl();
  $date = new DateTime();
  $request = array(
    /** All order specific settings can be found in payment/Order.php */

    "amount" => array(
      "currency" => "SGD",
      "value" => 1200200
    ),
    "reference" => $date->getTimestamp(),
    "paymentMethod" => $_POST['paymentMethod'],
    "origin" => "http://localhost:4999/payment.php",
    "returnUrl" => "http://localhost:4999/payment/payment_result.php",
    "merchantAccount" => $authentication['merchantAccount'],
    "channel" => "web",

    "additionalData" => array(
            "allow3DS2" => "true",
            "executeThreeD" => "true"
    ),
    "threeDS2RequestData" => array(
      "authenticationOnly" => false
    ),
    "shopperReference" => $_SESSION['email'],
    "browserInfo" => array(
      "userAgent" => get_browser(),
      "acceptHeader" => "text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8",
      "language" => "en-SG",
      "colorDepth" => 24,
      "screenHeight" => 723,
      "screenWidth" => 1536,
      "timeZoneOffset" => 0,
      "javaEnabled" => true
    )
  );
  $data = json_encode($request);

  //  Initiate curl
  $curlAPICall = curl_init();

  // Set to POST
  curl_setopt($curlAPICall, CURLOPT_CUSTOMREQUEST, "POST");

  // Will return the response, if false it print the response
  curl_setopt($curlAPICall, CURLOPT_RETURNTRANSFER, true);

  // Add JSON message
  curl_setopt($curlAPICall, CURLOPT_POSTFIELDS, $data);

  // Set the url
  curl_setopt($curlAPICall, CURLOPT_URL, $url);

  // Api key
  curl_setopt($curlAPICall, CURLOPT_HTTPHEADER,
  array(
    "X-Api-Key: " . $authentication['checkoutAPIkey'],
    "Content-Type: application/json",
    "Content-Length: " . strlen($data)
    )
  );
  // Execute
  $result = curl_exec($curlAPICall);
  // Error Check
  if ($result === false){
    throw new Exception(curl_error($curlAPICall), curl_errno($curlAPICall));
  }

  $payment = json_decode($result, true);
  if($payment['resultCode'] == 'RedirectShopper'){
    if($payment['redirect']['data']){
      $update_payment_query="insert into payments (order_id, paymentData, MD, time, amount, currency, status) values ('".(string)$request['reference']."','".$payment['paymentData']."','".$payment['redirect']['data']['MD']."','".date("Y-m-d H:i:s")."',".$sum.",'SGD','pending');";
      $update_payment=mysqli_query($con,$update_payment_query) or die(mysqli_error($con));
    }
  } else if($payment['resultCode'] == 'Authorised') {
      // Update paymetns table
      $update_payment_query="insert into payments (order_id, psp, time, amount, currency, status) values ('".(string)$request['reference']."','".$payment['pspReference']."','".date("Y-m-d H:i:s")."',".$sum.",'SGD','authorised');";
      $update_payment=mysqli_query($con,$update_payment_query) or die(mysqli_error($con));

      // Update orders table
      $order_id = "O".(string)$request['reference'];
      $update_order_query="insert into orders (user_id, id, amount, order_time, currency) values ('".$user_id."','".$order_id."',".$sum.",'".date("Y-m-d H:i:s")."','SGD');";
      $update_order=mysqli_query($con,$update_order_query) or die(mysqli_error($con));

      // Update order_details table
      $cart_query = "select item_id, count(*) as count from cart where user_id=". $user_id ." group by item_id;";
      $cart_result=mysqli_query($con,$cart_query) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($cart_result)){
        $update_order_details_query="insert into order_details (order_id, item_id, count, status) values ('".$order_id."',".$row['item_id'].",".$row['count'].",'paid');";
        $update_order_details=mysqli_query($con,$update_order_details_query) or die(mysqli_error($con));
      }

      // Clear shopping cart
      $clear_cart_query = "delete from cart where user_id=". $user_id .";";
      $clear_cart=mysqli_query($con,$clear_cart_query) or die(mysqli_error($con));

  } else {
      $update_payment_query="insert into payments (order_id, time, amount, currency, status) values ('".(string)$request['reference']."','".date("Y-m-d H:i:s")."',".$sum.",'SGD','error');";
      $update_payment=mysqli_query($con,$update_payment_query) or die(mysqli_error($con));

  }

  // Closing
  curl_close($curlAPICall);
} catch (Exception $e) {
  trigger_error(sprintf(
    'API call failed with error #%d, %s', $e->getCode(), $e->getMessage()
  ), E_USER_ERROR);
}




// When this file gets called by javascript or another language, it will respond with a json object
echo $result;
