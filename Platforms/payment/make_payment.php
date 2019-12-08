<?php

require_once __DIR__ . '/Config.php';

try{
  // Authentication
  $authentication = Config::getAuthentication();

  // Generate url
  $url = Config::getPaymentUrl();
  $date = new DateTime();
  $value = 10000.00 * (1.0 - (float)$_POST['commission']/100.0 - (float)$_POST['vat']/100.0);

  // $request = array(
  //   /** All order specific settings can be found in payment/Order.php */
  //
  //   "amount" => array(
  //     "currency" => "EUR",
  //     "value" => $value
  //   ),
  //   "reference" => $date->getTimestamp(),
  //   "paymentMethod" => $_POST['paymentMethod'],
  //   "origin" => "https://18.138.204.96/MarketPay/",
  //   "returnUrl" => "https://18.138.204.96/MarketPay/",
  //   "merchantAccount" => $authentication['merchantAccount'],
  //   "channel" => "web"
  //
  //   // "additionalData" => array(
  //   //         "allow3DS2" => "true",
  //   //         "executeThreeD" => "true"
  //   // ),
  //   // "threeDS2RequestData" => array(
  //   //   "authenticationOnly" => false
  //   // ),
  //   // "shopperReference" => "",
  //   // "browserInfo" => array(
  //   //   "userAgent" => get_browser(),
  //   //   "acceptHeader" => "text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8",
  //   //   "language" => "en-SG",
  //   //   "colorDepth" => 24,
  //   //   "screenHeight" => 723,
  //   //   "screenWidth" => 1536,
  //   //   "timeZoneOffset" => 0,
  //   //   "javaEnabled" => true
  //   // )
  // );

  $request = array (
    'reference' => 'mp' . (string)$date->getTimestamp(),
    'merchantAccount' => 'LiwenHou',
    'paymentMethod' => $_POST['paymentMethod'],
    'amount' =>
    array (
      'value' => 10000,
      'currency' => 'EUR',
    ),
    'splits' =>
    array (
      0 =>
      array (
        'amount' =>
        array (
          'value' => 2000.00 * (1.0 - (float)$_POST['commission']/100.0 - (float)$_POST['vat']/100.0),
        ),
        'type' => 'MarketPlace',
        'account' => $_POST['accountCode1'],
        'reference' => '1-mp' . (string)$date->getTimestamp(),
        'description' => 'Sub-merchant 1 item EUR 20',
      ),
      1 =>
      array (
        'amount' =>
        array (
          'value' => 8000.00 * (1.0 - (float)$_POST['commission']/100.0 - (float)$_POST['vat']/100.0),
        ),
        'type' => 'MarketPlace',
        'account' => $_POST['accountCode2'],
        'reference' => '2-mp' . (string)$date->getTimestamp(),
        'description' => 'Sub-merchant 2 item EUR 80',
      ),
      2 =>
      array (
        'amount' =>
        array (
          'value' => 10000.00 * (float)$_POST['vat']/100.0,
        ),
        'type' => 'VAT',
        'reference' => 'vat' . (string)$date->getTimestamp()
      ),
      3 =>
      array (
        'amount' =>
        array (
          'value' => 10000.00 * (float)$_POST['commission']/100.0,
        ),
        'type' => 'Commission',
        'reference' => 'com' . (string)$date->getTimestamp()
      )
    ),
    "origin" => "https://18.138.204.96/MarketPay/",
    "returnUrl" => "https://18.138.204.96/MarketPay/",
    "channel" => "web",

    "additionalData" => array(
            "allow3DS2" => "true",
            "executeThreeD" => "true"
    ),
    "threeDS2RequestData" => array(
      "authenticationOnly" => false
    ),
    "shopperReference" => $_POST["shopperReference"],
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
  $request["paymentMethod"]["storeDetails"] = $_POST["storePaymentMethod"];
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

  // Closing
  curl_close($curlAPICall);
} catch (Exception $e) {
  trigger_error(sprintf(
    'API call failed with error #%d, %s', $e->getCode(), $e->getMessage()
  ), E_USER_ERROR);
}




// When this file gets called by javascript or another language, it will respond with a json object
echo $result;
