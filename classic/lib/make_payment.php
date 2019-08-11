<?php
require_once __DIR__ . '/Config.php';


try{
  // Authentication
  $authentication = Config::getAuthentication();

  // Generate url
  $url = Config::getAuthoriseUrl();

  $request = array(
    /** All order specific settings can be found in payment/Order.php */

    "amount" => array(
      "currency" => "SGD",
      "value" => 12002
    ),
    "reference" => "Test authenticationOnly",
//    "origin" => "http://localhost:4999/payment.php",
//    "returnUrl" => "http://localhost:4999/payment/payment_result.php",
    "merchantAccount" => $authentication['merchantAccount'],
//    "channel" => "web",

    "additionalData" => array(
      "card.encrypted.json" => $_POST['adyen-encrypted-data'],
      "executeThreeD" => true
      //"allow3DS2" => "true"
    ),
    "threeDS2RequestData" => array(
      "deviceChannel" => "browser",
      "notificationURL" => "https://18.138.204.96/classic/lib/notification.php",
      "authenticationOnly" => true
    ),
    // "threeDS2RequestData" => array(
    //   "authenticationOnly" => true
    // ),
    "browserInfo" => array(
      "userAgent" => get_browser(),
      "acceptHeader" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36",
      "language" => "en-SG",
      "colorDepth" => 24,
      "screenHeight" => 800,
      "screenWidth" => 1280,
      "timeZoneOffset" => -480,
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


  // Closing
  curl_close($curlAPICall);
} catch (Exception $e) {
  trigger_error(sprintf(
    'API call failed with error #%d, %s', $e->getCode(), $e->getMessage()
  ), E_USER_ERROR);
}




// When this file gets called by javascript or another language, it will respond with a json object
echo $result;
