<?php
require_once __DIR__ . '/Config.php';


  // Authentication
$authentication = Config::getAuthentication();

  // Generate url
$url = Config::getPaymentMethodsUrl();

  // Generate data
if (file_get_contents('php://input') != '') {
  $request = json_decode(file_get_contents('php://input'), true);
} else {
  $request = array();
}

$apikey = $authentication['checkoutAPIkey'];
$merchantAccount = $authentication['merchantAccount'];

$data = [
  'merchantAccount' => $merchantAccount,
  'channel' => 'Web',
];

    // Convert data to JSON
$json_data = json_encode(array_merge($data, $request));
    // Initiate curl
$curlAPICall = curl_init();

    // Set to POST
curl_setopt($curlAPICall, CURLOPT_CUSTOMREQUEST, "POST");

    // Will return the response, if false it print the response
curl_setopt($curlAPICall, CURLOPT_RETURNTRANSFER, true);

    // Add JSON message
curl_setopt($curlAPICall, CURLOPT_POSTFIELDS, $json_data);

    // Set the url
curl_setopt($curlAPICall, CURLOPT_URL, $url);

    // Api key
curl_setopt($curlAPICall, CURLOPT_HTTPHEADER,
  array(
    "X-Api-Key: " . $apikey,
    "Content-Type: application/json",
    "Content-Length: " . strlen($json_data)
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

echo $result;
    // This file returns a JSON object
return $result;
