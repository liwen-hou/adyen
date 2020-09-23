<?php
require_once __DIR__ . '/Config.php';

try{
  // Authentication
  $authentication = Config::getAuthentication();

  // Generate url
  $url = "https://terminal-api-test.adyen.com/sync";
  $date = new DateTime();
  $reference = $date->getTimestamp();
  $reference = "T".(string)$reference;

  $shopperReference = $_POST['shopperReference'];

  $SaleToAcquirerData = "";
  $TokenRequestedType = "";
  if ( isset($shopperReference))  {
    $SaleToAcquirerData = "shopperReference=" . $shopperReference . "&recurringContract=ONECLICK,RECURRING";
    $TokenRequestedType = "Customer";

    $request = array(
      /** All order specific settings can be found in payment/Order.php */

      "SaleToPOIRequest"=> array(
        "MessageHeader" => array(
          "ProtocolVersion" => "3.0",
          "MessageClass" => "Service",
          "MessageCategory" => "Payment",
          "MessageType" => "Request",
          "ServiceID" => (string)$date->getTimestamp(),
          "SaleID" => "LiwenDemoShop",
          "POIID" => "V400m-346981680"
        ),
        "PaymentRequest" => array(
          "SaleData" => array(
            "SaleToAcquirerData" => $SaleToAcquirerData,
            "TokenRequestedType" => $TokenRequestedType,
            "SaleTransactionID" => array(
              "TransactionID" => $reference,
              "TimeStamp" =>  date("Y-m-d") . "T" . date("H:i:s+00:00")
            )
          ),
          "PaymentTransaction" => array(
            "AmountsReq" => array(
              "Currency" => "SGD",
              "RequestedAmount" => 10
            )
          ),
        )
      )
    );
  } else {
    {
      $request  = [
        "SaleToPOIRequest" => [
          "MessageHeader" => [
            "ProtocolVersion" => "3.0",
            "MessageClass" => "Device",
            "MessageCategory" => "Display",
            "MessageType" => "Request",
            "ServiceID" => (string)$date->getTimestamp(),
            "SaleID" => "LiwenDemoShop", 
            "POIID" => "V400m-346981680"
          ],
          "DisplayRequest" => [
            "DisplayOutput" => [
              [
                "Device" => "CustomerDisplay",
                "InfoQualify" => "Display",
                "OutputContent" => [
                  "OutputFormat" => "BarCode",
                  "OutputBarcode" => [
                    "BarcodeType" => "QRCode",
                    "BarcodeValue" => "https://liwenhou.com/adyen/demo/"
                    ]
                    ]
                  ],
                  [
                    "Device" => "CustomerDisplay",
                    "InfoQualify" => "Display",
                    "OutputContent" => [
                      "OutputFormat" => "Text",
                      "OutputText" => [
                        [
                          "Text" => "Get your M1 mobile app"
                          ]
                          ]
                          ]
                        ],
                        [
                          "Device" => "CustomerDisplay",
                          "InfoQualify" => "Display",
                          "OutputContent" => [
                            "OutputFormat" => "Text",
                            "OutputText" => [
                              [
                                "Text" => "Thank you!"
                                ]
                                ]
                                ]
                                ]
                                ]
                                ]
                                ]
                              ];
};



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
