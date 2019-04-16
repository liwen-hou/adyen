<?php

require_once __DIR__ . '/Config.php';

$skinCode        = "dl8LmdYQ"; // your skinCode
$merchantAccount = "LiwenTest"; // your merchantAccount
$hmacKey         = "6ADD0CAA75E37768BA6686166C9D7D40EB445B76A6C680DD1BCB104DC9187613"; // your HMAC Key

date_default_timezone_set('Europe/Amsterdam');

echo $_POST['email'];

if(isset($_POST['submit']))
{
  $paymentDetailsParams = array(
    "merchantReference" => "Generated_payment_link", // your merchant reference
    "merchantAccount"   =>  $merchantAccount,
    "currencyCode"      => "EUR",
    "shopperReference"  => $_POST['email'], // Customer ID
    "paymentAmount"     => "1000", // paymentAmount is in minor units (e.g. 1000 = 10.00)
    "sessionValidity"   => date('Y-m-d\TH:i:s', strtotime("+ 2 days")), //Allows the session to be active for 2 days
    "skinCode"          => $skinCode
  );

  if($_POST['saveCard'] == 'true')
  {
    $paymentDetailsParams["recurringContract"] = "ONECLICK";
  }

  $escapeval = function($val) {
    return str_replace(':','\\:',str_replace('\\','\\\\',$val));
  };

  // Sort the array by key using SORT_STRING order
  ksort($paymentDetailsParams, SORT_STRING);

  // Generate the signing data string
  $paymentDetailsSignData = implode(":", array_map($escapeval,
    array_merge( array_keys($paymentDetailsParams),
      array_values($paymentDetailsParams)
    )
    )
  );
  // base64-encode the binary result of the HMAC computation
  $merchantSig = base64_encode(hash_hmac('sha256',$paymentDetailsSignData,pack("H*" , $hmacKey),true));
  $paymentDetailsParams["merchantSig"] = $merchantSig;

  // Generate URL
  $paymentUrl = "https://test.adyen.com/hpp/pay.shtml?";
  $parameterCount = 0;
  foreach($paymentDetailsParams as $key => $value)
  {
    if($parameterCount == 0)
    {
      $paymentUrl .= $key."=".urlencode($value);
      $parameterCount++;
    }
    else{
      $paymentUrl .= "&".$key."=".urlencode($value);
    }
  }
  header("Location: ".$paymentUrl);
  die();
}
?>
