<?php
/**
 * Adyen Checkout Example (https://www.adyen.com/)
 * Copyright (c) 2019 Adyen BV (https://www.adyen.com/)
 */

require('originKeys.php');

// Basic routing
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

switch($request_uri[0]) {
    // /paymentMethods
    case '/payment/paymentMethods':
        header('Content-Type: application/json');
        echo getPaymentMethods();
        break;

    // /payments
    case '/payment/payments':
        header('Content-Type: application/json');
        echo initiatePayment();
        break;

    // /originKeys
    case '/payment/originKeys':
        header('Content-Type: application/json');
        echo getOriginKey();
        break;

    // default
    default:
        return false;

}