<?php
require_once __DIR__ . '/Config.php';


try{
  // Generate url
  $url = $_POST["validationURL"];
  $request = array(
    /** All order specific settings can be found in payment/Order.php */
    "merchantIdentifier" => "merchant.com.adyen.LiwenHou.test",
    "displayName" => "Adyen Test Merchant",
    "initiative" => "web",
    "initiativeContext" => "liwenhou.com" 
  );
  $data = json_encode($request);

  //  Initiate curl
  $curlAPICall = curl_init();

  curl_setopt($curlAPICall, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
  curl_setopt($curlAPICall, CURLOPT_SSLCERT, "merchant_id.cer");

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