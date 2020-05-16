# Adyen Checkout API Implementation
The web application simulates the shopper checkout process. The three API endpoints, namely /paymentMethods, /payments and /payments/details are used in the following stages:
Getting shopper information for checkout (used for tokenization)
Getting payment methods for a 10 EUR transaction in DE
Using Secured Field to make payment with Credit Card
3a. 3D secure authentication for cards that require it
Receiving payment results
I will go into details for each steps as below:

Getting Shopper Information

Shoppers will be asked for their names and email addresses before checkout. This is to identify the shopper for Tokenization purpose. Their email addresses will be used as the unique Shopper Reference.

main.png

Getting Payment Methods

Upon filling up the information, shoppers will be returned with a list of payment methods based on the amount, currency and location by calling the /paymentMethods API. I have preconfigured the transaction to be 10 EUR in DE as required, and the screenshot below reflects the returned payment methods.

paymentMethods.png

Making Payment

Only payment with Credit Card is implemented for this test. The Credit Card details are secured with securedField.

cc.png

On the payment page, shoppers are given the option to save the Credit Card with Adyen for future checkout. Once a shopper has made a successful transaction, he will be presented with the option to pay with a saved card using token and secured CVV next time.

token.png

3D Secure Authentication

For cards that require 3D Authentication, shoppers will be redirected to issuer website to verify the transaction, whether it is a tokenized card or a new card. After receiving the response from issuer, the response, together with the Payment Data received earlier, is sent to the endpoint /payments/details to verify the payment result.

Since the Payment Data was received in the previous stage after calling the /payments endpoint, and was not sent to the issuer side, I have implemented a Postgres database to store the Payment Data, together with the MD as the unique reference to retrieve it.

3ds.png

Receiving Payment Results

Based on the received result from Adyen, if the status code is Authorised, shoppers will see the Payment Successful page. Otherwise, the Something Went Wrong page will be returned.

successful.pngfail.png
