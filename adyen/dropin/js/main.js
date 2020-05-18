
function paymentMethod(){
  $.ajax({
    url: 'payment/payment_methods.php',
    type: 'post',
    data: {
      "countryCode": document.getElementById("country").value,
      "shopperReference": document.getElementById("email").value
    },
    success: function(response) {
      response = JSON.parse(response);
      console.log(response);
      $('#selectPaymentMethods').html('<div id="dropin"></div>');


      const configuration = {
        locale: "en-GB",
        environment: "test",
        originKey: "pub.v2.8115614281177653.aHR0cHM6Ly9saXdlbmhvdS5jb20.D4HuqLiTVuvkErjNYc3zTuRyIoiGHnxdDPEUObiOWIk",
        paymentMethodsResponse: response
      };
      const checkout = new AdyenCheckout(configuration);

      const card = checkout.create("card", {
               hasHolderName: true,
               holderNameRequired: true,
               billingAddressRequired: true
           }).mount("#dropin");

      const dropin = checkout
      .create('dropin', {
        paymentMethodsConfiguration: {

          card: { //Example optional configuration for Cards
            hasHolderName: true,
            holderNameRequired: true,
            enableStoreDetails: true,
            name: 'Credit or debit card'
          },

          applepay: { // Required configuration for Apple Pay
            amount: 2000,
            currencyCode: 'TWD',
            countryCode: 'SG',
            configuration: {
              merchantName: 'Adyen Test merchant', // Name to be displayed on the form
              merchantIdentifier: 'merchant.com.adyen.LiwenHou.test' // Your Apple merchant identifier as described in https://developer.apple.com/documentation/apple_pay_on_the_web/applepayrequest/2951611-merchantidentifier
            },
            onSubmit: (state) => {
              makePayment(state.data)
              .then(paymentResponse => {
                console.log(paymentResponse);
            if (paymentResponse.hasOwnProperty("action")) {
              dropin.handleAction(paymentResponse.action);
            } else {
              
              dropin.setStatus('success', { message: 'Payment successful!' });
              
            }
            // Drop-in will handle the action object from the /payments response
          })
          .catch(error => {
            throw Error(error);
          });

            },
            onValidateMerchant: (resolve, reject, validationURL) => {
              console.log(validationURL);

              $.ajax({
                url: "payment/apple_pay.php",
                type: 'post',
                data: {
                  "validationURL": validationURL
                },
                success: function(response) {
                  response = JSON.parse(response);
                  console.log(response);
                  resolve(response);
                }
              });
            // Calls your server with validationURL, which then requests a payment session from Apple Pay servers.
            // Your server then receives the session and calls resolve(MERCHANTSESSION) or reject() to complete merchant validation.
            }
          },
  

          paywithgoogle: { // Example required configuration for Google Pay
          environment: "TEST", // Change this to PRODUCTION when you're ready to accept live Google Pay payments
          configuration: {
            gatewayMerchantId: "LiwenHou", // Your Adyen merchant or company account name
            merchantName: "Liwen Test" // Optional. The name that appears in the payment sheet.
          },
          buttonColor: "white" //Optional. Use a white Google Pay button.
          //For other optional configuration, see section below.
        }
        },
        onChange:(state, dropin) => {
          console.log(state)
        },
        onSubmit: (state, dropin) => {
          makePayment(state.data)
          // Your function calling your server to make the /payments request
          .then(paymentResponse => {
            console.log(paymentResponse);
            if (paymentResponse.hasOwnProperty("action")) {
              dropin.handleAction(paymentResponse.action);
            } else {
              if (paymentResponse.resultCode == "Authorised") {
                dropin.setStatus('success', { message: 'Payment successful!' });
              } else {
                dropin.setStatus('error', { message: 'Something went wrong.'});
              }
            }
            // Drop-in will handle the action object from the /payments response
          })
          .catch(error => {
            throw Error(error);
          });
        },
        onAdditionalDetails: (state, dropin) => {
          makeDetailsCall(state.data)
          // Your function calling your server to make a /payments/details request
          .then(response => {
            console.log(response);
            if (response.hasOwnProperty("action")) {
              dropin.handleAction(response.action);
            } else {
              if (response.resultCode == "Authorised") {
                dropin.setStatus('success', { message: 'Payment successful!' });
              } else {
                dropin.setStatus('error', { message: 'Something went wrong.'});
              }
            }
            // Drop-in will handle the action object from the /payments/details response
          })
          .catch(error => {
            throw Error(error);
          });
        }
      })
      .mount('#dropin');
    }
  });
}






function makePayment(data) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: 'payment/make_payment.php',
      type: 'post',
      data: {
        "countryCode": document.getElementById("country").value,
        "paymentMethod": data.paymentMethod,
        "storePaymentMethod": data.storePaymentMethod,
        "shopperReference": document.getElementById("email").value
      },
      success: function(paymentResponse) {
        paymentResponse = JSON.parse(paymentResponse);
        console.log(paymentResponse);
        resolve(paymentResponse);
      }
    });
  });
}

function makeDetailsCall(data) {

  console.log(data);
  return new Promise((resolve, reject) => {
    $.ajax({
      url: 'payment/payment_details.php',
      type: 'post',
      data: {
        "details": data.details,
        "paymentData": data.paymentData
      },
      success: function(paymentResponse) {
        paymentResponse = JSON.parse(paymentResponse);
        console.log(paymentResponse);
        resolve(paymentResponse);
      }
    });
  });
}



function payAtTerminal() {
  $.ajax({
    url: 'payment/pos_payment.php',
    type: 'post',
    data: {
      "shopperReference": document.getElementById("email").value
    },
    success: function(response) {
      response = JSON.parse(response);
      console.log(response);
      console.log(response.SaleToPOIResponse.PaymentResponse.Response.Result);
    }
  });
}

// Generic POST Helper
const httpPost = (endpoint, data) =>
    fetch('../payment/${endpoint}', {
        method: 'POST',
        headers: {
            Accept: 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(response => response.json());

// Fetches an originKey from the local server
const getOriginKey = () =>
    httpPost('originKeys')
        .then(response => {
            if (response.error || !response.originKeys) throw 'No originKey available';

            return response.originKeys[Object.keys(response.originKeys)[0]];
        })
        .catch(console.error);


