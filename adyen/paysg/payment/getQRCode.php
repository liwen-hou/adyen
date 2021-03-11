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
      "currency" => "CNY",
      "value" => $sum
    ),
    "reference" => $date->getTimestamp(),
    "paymentMethod" => array(
      "type" => $_POST['type']
    ),
    "merchantAccount" => $authentication['merchantAccount']
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

  // Closing
  curl_close($curlAPICall);
} catch (Exception $e) {
  trigger_error(sprintf(
    'API call failed with error #%d, %s', $e->getCode(), $e->getMessage()
  ), E_USER_ERROR);
}




// When this file gets called by javascript or another language, it will respond with a json object
echo $result;
