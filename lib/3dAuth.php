<?php

require_once __DIR__ . '/Config.php';

// Authentication
$authentication = Config::getAuthentication();


$conn = pg_connect("host=localhost dbname=adyen user=adyen password=password");
if ($conn){
  $query = "select * from transactions where md='" . $_POST['MD'] . "';";
  $txn = pg_query($conn, $query);
  $row = pg_fetch_row($txn);
}


// Generate url
$url = Config::getPaymentDetailsUrl();
$request = array(
  "paymentData" => $row[0],
  "details" => array(
    "MD" => $_POST['MD'],
  	"PaRes" => $_POST['PaRes']
  )
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
$result = json_decode($result, true);
if ($result['resultCode'] == "Authorised"){
  $query = "update transactions set status='Authorised' where paymentdata='" . $row[0] . "';" ;
  pg_query($conn, $query);
  echo $result['resultCode'];
}
curl_close($curlAPICall);
pg_close($conn);
