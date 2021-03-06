<?php
require_once __DIR__ . '/Config.php';


try{
  // Authentication
  $authentication = Config::getAuthentication();

  // Generate url
  $url = Config::getPaymentUrl();
  $date = new DateTime();
  $request = array(
    /** All order specific settings can be found in payment/Order.php */

    "amount" => array(
      "currency" => $_POST["currency"],
      "value" => 0
    ),
    "reference" => $date->getTimestamp(),
    "paymentMethod" => $_POST['paymentMethod'],
    "origin" => "https://www.liwenhou.com/adyen/dropin/index.php",
    "returnUrl" => "https://www.liwenhou.com/adyen/dropin/payment/payment_result.php",
    "merchantAccount" => $authentication['merchantAccount'],
    "channel" => "web",
    "storePaymentMethod" => $_POST["storePaymentMethod"],
    "shopperReference" => $_POST["shopperReference"],
    "additionalData" => array(
            // "allow3DS2" => "true",
            "executeThreeD" => "true"
    ),
    "threeDS2RequestData" => array(
      "authenticationOnly" => false
    ),
    // "shopperReference" => $_SESSION['email'],
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

  curl_close($curlAPICall);
} catch (Exception $e) {
  trigger_error(sprintf(
    'API call failed with error #%d, %s', $e->getCode(), $e->getMessage()
  ), E_USER_ERROR);
}




// When this file gets called by javascript or another language, it will respond with a json object
echo $result;
