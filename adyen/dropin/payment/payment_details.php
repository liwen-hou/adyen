
<?php

session_start();
require_once __DIR__ . '/Config.php';
require '../connection.php';
$user_id = $_SESSION['id'];
// Authentication
$authentication = Config::getAuthentication();

// if ($con){
//   $get_payment_query = "select paymentData, amount from payments where MD='" . $_POST['MD'] . "';";
//   $get_payment_result = mysqli_query($con,$get_payment_query) or die(mysqli_error($con));
//   $row = mysqli_fetch_array($get_payment_result);
// }

$url = Config::getPaymentDetailsUrl();
$request = array(
  "paymentData" => $_POST["paymentData"],
  "details" => $_POST['details']
);


$data = json_encode($request, JSON_UNESCAPED_SLASHES);
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
curl_close($curlAPICall);
echo $result;
// $result = json_decode($result, true);
// if ($result['resultCode'] == "Authorised"){
//   // Update paymetns table
//   $update_payment_query = "update payments set psp='".$result['pspReference']."', status='authorised' where MD='".$_POST['MD']."';";
//   $update_payment = mysqli_query($con,$update_payment_query) or die(mysqli_error($con));
//
//   // Update orders table
//   $date = new DateTime();
//   $order_id = "O".(string)$date->getTimestamp();
//   $update_order_query="insert into orders (user_id, id, amount, order_time, currency) values ('".$user_id."','".$order_id."',".$row['amount'].",'".date("Y-m-d H:i:s")."','SGD');";
//   $update_order=mysqli_query($con,$update_order_query) or die(mysqli_error($con));
//
//   // Update order_details table
//   $cart_query = "select item_id, count(*) as count from cart where user_id=". $user_id ." group by item_id;";
//   $cart_result=mysqli_query($con,$cart_query) or die(mysqli_error($con));
//   while($row=mysqli_fetch_array($cart_result)){
//     $update_order_details_query="insert into order_details (order_id, item_id, count, status) values ('".$order_id."',".$row['item_id'].",".$row['count'].",'paid');";
//     $update_order_details=mysqli_query($con,$update_order_details_query) or die(mysqli_error($con));
//   }
//
//   // Clear shopping cart
//   $clear_cart_query = "delete from cart where user_id=". $user_id .";";
//   $clear_cart=mysqli_query($con,$clear_cart_query) or die(mysqli_error($con));
//
//
//   header('Location: payment_result.php?resultCode=authorised');
//   die();
// }
// else if ($result['resultCode'] == "Refused"){
//   $update_payment_query = "update payments set psp='".$result['pspReference']."', status='refused' where MD='".$_POST['MD']."';";
//   $update_payment = mysqli_query($con,$update_payment_query) or die(mysqli_error($con));
//   header('Location: payment_result.php?resultCode=refused');
//   die();
// } else {
//   $update_payment_query = "update payments set status='error' where MD='".$_POST['MD']."';";
//   $update_payment = mysqli_query($con,$update_payment_query) or die(mysqli_error($con));
//   header('Location: payment_result.php?resultCode=error');
//   die();
// }
