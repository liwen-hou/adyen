
<?php

session_start();
require_once __DIR__ . '/Config.php';
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
