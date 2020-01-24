<?php
require_once __DIR__ . '/Config.php';

try{
  // Authentication
  $authentication = Config::getAuthentication();

  // Generate url
  $url = "https://cal-test.adyen.com/cal/services/Account/v5/updateAccountHolder";

  $request = array (
    'accountHolderCode' => $_GET['sellerId'],
    'accountHolderDetails' => array (

      "storeDetails" => array (
          0 => array (
          "storeReference" => $_POST["storeRef"],
          "fullPhoneNumber" => "+33 1111 1111",
          "merchantAccount" => $authentication['merchantAccount'],
          "merchantCategoryCode" => "5817",
          "address" => array (
            "city" => "Paris",
            "country" => "FR",
            "houseNumberOrName" => "01",
            "postalCode" => "111111",
            "street" => "Champs-Élysées"
          )
        )
      )
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
    "X-Api-Key: " . $authentication['marketPayAPIkey'],
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

header('Location: ../management.php?sellerId='.$_GET['sellerId']);
