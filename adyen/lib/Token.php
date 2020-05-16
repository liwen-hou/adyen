<?php

require_once __DIR__ . '/Config.php';

function getPaymentMethods()
{
  try{
    // Authentication
    $authentication = Config::getAuthentication();

    // Generate url
    $url = Config::getPaymentMethodsUrl();

    // Generate data
    $request = array(

      "merchantAccount" => $authentication['merchantAccount'],
      "countryCode" => "MY",
      "shopperReference" => $_POST['shopperReference'],
      "amount" => array(
        "currency" => "MYR",
        "value" => 1000
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
    $paymentMethods = curl_exec($curlAPICall);

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

  return $paymentMethods;
}


if (isset($_POST['callFunc1'])) {
  $response = getPaymentMethods();
  $results = json_decode($response, true);

  $html = '<div class="accordion">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span>Choose How You Like to Pay</span>
    </h4>';

  $i = 1;
  foreach ($results['paymentMethods'] as $methods) {
    $html = $html. '<div class="card"><div class="card-header" id="';
    $html = $html. 'method' . $i;
    $html = $html. '"><h2 class="mb-0"><img id="methodBrand" src="assets/img/'. $methods['type'] . '@2x.png" height="22" width="33"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#';
    $html = $html. 'collapse' . $i;
    $html = $html. '" aria-expanded="true" aria-controls="';
    $html = $html. 'collapse' . $i;
    $html = $html. '">';
    $html = $html. $methods['name'];
    $html = $html. '</button></h2></div><div id="';
    $html = $html. 'collapse' . $i;
    $html = $html. '" class="collapse" aria-labelledby="';
    $html = $html. 'method' . $i;
    $html = $html. '" data-parent="#paymentWindow"><div class="card-body">';
    if ($methods['name'] == 'Credit Card') {
      if (isset($results['oneClickPaymentMethods'])) {
        $html = $html. '
        <div class="checkout-container" id="cardWindow">
        <div class="form-div" id="onClickPay" display="block">
        <form class="payment-div" method="post" action="lib/Client.php">
        <input type="hidden" name="txvariant" value="card"/>
        <div class="cards-div">

        <div class="js-chckt-pm__pm-holder">
        <input type="hidden" name="txvariant" value="card" />
        <input type="hidden" id ="shopperReference" name="shopperReference" value="" />
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Pay with:</label>
          </div>
          <select class="custom-select" name="recurringDetailReference" id="inputGroupSelect01">
            <option selected>Choose...</option>';
        foreach ($results['oneClickPaymentMethods'] as $oneClickMethods){
          $html = $html. '<option value="';
          $html = $html. $oneClickMethods['recurringDetailReference'];
          $html = $html. '">';
          $html = $html. $oneClickMethods['name'];
          $html = $html. ' ending with ';
          $html = $html. $oneClickMethods['storedDetails']['card']['number'];
          $html = $html. '</option>';

        }
        $html = $html. '</select></div>
        <label>
        Security Code<span class="input-field" data-cse="encryptedSecurityCode" />
        </label>
        <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Pay Now</button><hr class="mb-4">';
        $html = $html. '</div></div></form>
        <button class="btn btn-primary btn-lg btn-block" type="button" onclick="newCard()">Pay with a new card</button><hr class="mb-4"></div></div>';
      } else {
        $html = $html. '<div class="checkout-container">
        <div class="form-div">
        Card Number <img id="cardBrand" src="assets/img/card@2x.png" height="18" width="27">
        <form class="payment-div" method="post" action="lib/Client.php">
        <input type="hidden" name="txvariant" value="card"/>
        <div class="cards-div">

        <div class="js-chckt-pm__pm-holder">
        <input type="hidden" name="txvariant" value="card"/>
        <input type="hidden" id ="shopperReference" name="shopperReference" value="" />
        <label>
        <span class="input-field" data-cse="encryptedCardNumber" />
        </label>
        <label>
        Expiry Month<span class="input-field" data-cse="encryptedExpiryMonth" />
        </label>
        <label>
        Expiry Year<span class="input-field" data-cse="encryptedExpiryYear" />
        </label>
        <label>
        Security Code<span class="input-field" data-cse="encryptedSecurityCode" />
        </label>
        <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="saveCard" value="true">
        <label class="form-check-label" for="exampleCheck1">Save this card</label>
        </div>
        </div>
        </div>
        <button id="payBtn" class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Pay Now</button>
        <hr class="mb-4">
        </form>
        </div>
        </div>';
      }
    } else {
      $html = $html. $methods['name'];
    }
    $html = $html. '</div></div></div>';

    $i = $i + 1;
  }

  $response = array(
    "details" => $details,
    "html" => $html
  );

  echo json_encode($response);
}