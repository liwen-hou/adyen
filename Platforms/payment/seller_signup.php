<?php
require_once __DIR__ . '/Config.php';

try{
  // Authentication
  $authentication = Config::getAuthentication();

  // Generate url
  $url = "https://cal-test.adyen.com/cal/services/Account/v5/createAccountHolder";

  $request = array (
    'accountHolderCode' => $_POST['sellerId'],
    'accountHolderDetails' => array (

      "individualDetails" => array (
        "name" => array (
          "firstName" => $_POST['firstName'],
          "gender" => "UNKNOWN",
          "lastName" => $_POST['lastName']
        )
      ),

      'address' => array (
        'country' => $_POST['country']
      ),

      'email' => $_POST['email']
    ),
    'legalEntity' => 'Individual'
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
$account = json_decode($result, true);
$file = fopen("../config/sellerList.csv","a+");
fputcsv($file, array($_POST['sellerId']));
fclose($file);
header('Location: ../seller_status.php?sellerId='.$_POST['sellerId']);
