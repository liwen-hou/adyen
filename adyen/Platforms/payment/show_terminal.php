<?php
require_once __DIR__ . '/Config.php';

try{
  // Authentication
  $authentication = Config::getAuthentication();

  // Generate url
  $url = "https://postfmapi-test.adyen.com/postfmapi/terminal/getTerminalsUnderAccount";

  // Generate data
  $request = array(

    "merchantAccount" => $authentication['merchantAccount'],
    "companyAccount" => $authentication['companyAccount']

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
if ($paymentMethods === false){
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
