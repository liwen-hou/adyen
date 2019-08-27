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
  $url = "https://terminal-api-test.adyen.com/sync";
  $date = new DateTime();
  $reference = $date->getTimestamp();
  $reference = "T".(string)$reference;

  $request = array(
    /** All order specific settings can be found in payment/Order.php */

    	"SaleToPOIRequest"=> array(
            "MessageHeader" => array(
                "ProtocolVersion" => "3.0",
                "MessageClass" => "Service",
                "MessageCategory" => "Payment",
                "MessageType" => "Request",
                "ServiceID" => (string)$date->getTimestamp(),
                "SaleID" => "LiwenDemoShop",
                "POIID" => "V400m-346082295"
            ),
            "PaymentRequest" => array(
                "SaleData" => array(
                    "SaleTransactionID" => array(
                        "TransactionID" => $reference,
                        "TimeStamp" =>  date("Y-m-d") . "T" . date("H:i:s+00:00")
                    )
                ),
                "PaymentTransaction" => array(
                    "AmountsReq" => array(
                        "Currency" => "SGD",
                        "RequestedAmount" => $sum/100
                    )
                )
            )
        )
  );

  $data = json_encode($request);
  //  Initiate curl
  echo $data;
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
  $status = $payment["SaleToPOIResponse"]["PaymentResponse"]["Response"]["Result"];
  if($status == 'Success') {
      // Update paymetns table
      $update_payment_query="insert into payments (order_id, time, amount, currency, status) values ('".$reference."','".date("Y-m-d H:i:s")."',".$sum.",'SGD','authorised');";
      $update_payment=mysqli_query($con,$update_payment_query) or die(mysqli_error($con));

      // Update orders table
      $update_order_query="insert into orders (user_id, id, amount, order_time, currency) values ('".$user_id."','".$reference."',".$sum.",'".date("Y-m-d H:i:s")."','SGD');";
      $update_order=mysqli_query($con,$update_order_query) or die(mysqli_error($con));

      // Update order_details table
      $cart_query = "select item_id, count(*) as count from cart where user_id=". $user_id ." group by item_id;";
      $cart_result=mysqli_query($con,$cart_query) or die(mysqli_error($con));
      while($row=mysqli_fetch_array($cart_result)){
        $update_order_details_query="insert into order_details (order_id, item_id, count, status) values ('".$reference."',".$row['item_id'].",".$row['count'].",'paid');";
        $update_order_details=mysqli_query($con,$update_order_details_query) or die(mysqli_error($con));
      }

      // Clear shopping cart
      $clear_cart_query = "delete from cart where user_id=". $user_id .";";
      $clear_cart=mysqli_query($con,$clear_cart_query) or die(mysqli_error($con));

      header('Location: payment_result.php?resultCode=authorised');
      die();

  } else {
      $update_payment_query="insert into payments (order_id, time, amount, currency, status) values ('".$reference."','".date("Y-m-d H:i:s")."',".$sum.",'SGD','error');";
      $update_payment=mysqli_query($con,$update_payment_query) or die(mysqli_error($con));

      header('Location: payment_result.php?resultCode=refused');
      die();
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
