<?php
require_once __DIR__ . '/Config.php';

echo $_POST;
// try{
//   // Authentication
//   $authentication = Config::getAuthentication();
//
//   // Generate url
//   $url = "https://cal-test.adyen.com/cal/services/Account/v5/createAccountHolder";
//
//   $request = array (
//     'accountHolderCode' => $_POST['tenantId'],
//     'accountHolderDetails' =>
//     array (
//       'bankAccountDetails' =>
//       array (
//         0 =>
//         array (
//           'accountNumber' => '1678116852',
//           'branchCode' => '001',
//           'countryCode' => 'SG',
//           'currencyCode' => 'SGD',
//           'ownerName' => 'Tim Green',
//           'ownerHouseNumberOrName' => '100',
//           'ownerStreet' => 'Main Street',
//           'ownerPostalCode' => '02894',
//           'ownerCity' => 'PASSED',
//           'ownerState' => 'AZ',
//           'ownerCountryCode' => 'SG',
//           'bankBicSwift' => 'UOBXSGXXXXX',
//         ),
//       ),
//       'address' =>
//       array (
//         'country' => 'SG',
//         'city' => 'PASSED',
//         'street' => 'test',
//         'postalCode' => '000000',
//       ),
//       'businessDetails' =>
//       array (
//         'legalBusinessName' => $_POST['legalName'],
//         'shareholders' =>
//         array (
//           0 =>
//           array (
//             'name' =>
//             array (
//               'firstName' => 'Maria',
//               'lastName' => 'TestData',
//             ),
//             'address' =>
//             array (
//               'country' => 'SG',
//             ),
//           ),
//         ),
//       ),
//       'email' => 'maria@green.com',
//     ),
//     'legalEntity' => 'Business',
//   );
//
//   $data = json_encode($request);
//
//   //  Initiate curl
//   $curlAPICall = curl_init();
//
//   // Set to POST
//   curl_setopt($curlAPICall, CURLOPT_CUSTOMREQUEST, "POST");
//
//   // Will return the response, if false it print the response
//   curl_setopt($curlAPICall, CURLOPT_RETURNTRANSFER, true);
//
//   // Add JSON message
//   curl_setopt($curlAPICall, CURLOPT_POSTFIELDS, $data);
//
//   // Set the url
//   curl_setopt($curlAPICall, CURLOPT_URL, $url);
//
//   // Api key
//   curl_setopt($curlAPICall, CURLOPT_HTTPHEADER,
//   array(
//     "X-Api-Key: " . "AQE6hmfxJ4vMbRBFw0exgG89s9SXSYhIQ79DT2BY8n24iktKjMxzBPZtBzRku2X+hDFBK6CbCn6Xh7AajhDBXVsNvuR83LVYjEgiTGAH-Ell7Xcs8Netnk1oBhABkezFeO++YnZDpcmx/mOxUxBI=-s2WHV75y9wcUSgPt",
//     "Content-Type: application/json",
//     "Content-Length: " . strlen($data)
//     )
//   );
//   // Execute
//   $result = curl_exec($curlAPICall);
//   // Error Check
//   if ($result === false){
//     throw new Exception(curl_error($curlAPICall), curl_errno($curlAPICall));
//   }
//
//
//   // Closing
//   curl_close($curlAPICall);
// } catch (Exception $e) {
//   trigger_error(sprintf(
//     'API call failed with error #%d, %s', $e->getCode(), $e->getMessage()
//   ), E_USER_ERROR);
// }
//
//
//
//
// // When this file gets called by javascript or another language, it will respond with a json object
// echo $result;
