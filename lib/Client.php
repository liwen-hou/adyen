<?php

require_once __DIR__ . '/Config.php';

class Client
{

  public function doPostRequest()
  {
    try{
      // Authentication
      $authentication = Config::getAuthentication();

      // Generate url
      $url = Config::getPaymentUrl();
      $date = new DateTime();
      // Generate data

      if(isset($_POST['recurringDetailReference'])) {
        $request = array(
          /** All order specific settings can be found in payment/Order.php */

          "amount" => array(
            "currency" => "EUR",
            "value" => 1000
          ),
          "reference" => $date->getTimestamp(),
          "paymentMethod" => array(
            "type" => "scheme",
            "recurringDetailReference" => $_POST["recurringDetailReference"],
            "encryptedSecurityCode" => $_POST["encryptedSecurityCode"]
          ),
          "shopperReference" => $_POST["shopperReference"],
          "returnUrl" => "https://54.169.153.135/lib/3dAuth.php",
          "merchantAccount" => $authentication['merchantAccount'],
          "additionalData" => array(
            "executeThreeD" => "true"
          )

        );
      } else {
        $request = array(
          /** All order specific settings can be found in payment/Order.php */

          "amount" => array(
            "currency" => "EUR",
            "value" => 1000
          ),
          "reference" => $date->getTimestamp(),
          "paymentMethod" => array(
            "type" => "scheme",
            "encryptedCardNumber" => $_POST["encryptedCardNumber"],
            "encryptedExpiryMonth" => $_POST["encryptedExpiryMonth"],
            "encryptedExpiryYear" => $_POST["encryptedExpiryYear"],
            "encryptedSecurityCode" => $_POST["encryptedSecurityCode"],
            "storeDetails" => "true"
          ),
          "shopperReference" => $_POST["shopperReference"],
          "returnUrl" => "https://54.169.153.135/lib/3dAuth.php",
          "merchantAccount" => $authentication['merchantAccount'],
          "additionalData" => array(
            "executeThreeD" => "true"
          )

        );
      }

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
    return $result;
  }


}

if(isset($_POST['submit']))
{
  $result = Client::doPostRequest();
  $result = json_decode($result, true);
  $conn = pg_connect("host=localhost dbname=adyen user=adyen password=password");
  if ($conn){
    $query = "insert into transactions (paymentData, status, md) VALUES ('";
    $query = $query . $result['paymentData'] . "','" ;
    $query = $query . $result['resultCode'] . "','" ;
    $query = $query . $result['redirect']['data']['MD'] . "');";
    pg_query($conn, $query);
  }
  pg_close($conn);
  if($result['resultCode'] == 'RedirectShopper'){
    $IssuerUrl = $result['redirect']['url'];
    $PaReq = $result['redirect']['data']['PaReq'];
    $MD = $result['redirect']['data']['MD'];
    $TermUrl = $result['redirect']['data']['TermUrl'];
    ?>
    <body onload="document.getElementById('3dform').submit();">
      <form method="POST" action="<?php echo $IssuerUrl; ?>" id="3dform">
        <input type="hidden" name="PaReq" value="<?php echo $PaReq; ?>" />
        <input type="hidden" name="MD" value="<?php echo $MD; ?>" />
        <input type="hidden" name="TermUrl" value="<?php echo $TermUrl; ?>" />
        <noscript>
          <br>
          <br>
          <div style="text-align: center">
            <h1>Processing your 3-D Secure Transaction</h1>
            <p>Please click continue to continue the processing of your 3-D Secure transaction.</p>
            <input type="submit" class="button" value="continue"/>
          </div>
        </noscript>
      </form>
    </body>
    <?php
    //Client::doThreeD($result['redirect']);
  } else {
    echo $result['resultCode'];
  }

}

?>
