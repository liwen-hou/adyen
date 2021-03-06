
function hideForm(){
  document.getElementById("emaildiv").style.display="none";
}

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
      $('#selectPaymentMethods').html('<div id="dropin"></div>');
      const configuration = {
        locale: "en-GB",
        environment: "test",
        clientKey: "test_A4PGCNMRORGXRC3AH2WSIZT374WHDWNB",
        paymentMethodsResponse: response
      };
      const checkout = new AdyenCheckout(configuration);

      const dropin = checkout
      .create('dropin', {
        paymentMethodsConfiguration: {

          card: { //Example optional configuration for Cards
            hasHolderName: true,
            holderNameRequired: true,
            enableStoreDetails: true,
            name: 'Credit or debit card'
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
          console.log(state.data)
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
  console.log(data);
  return new Promise((resolve, reject) => {
    $.ajax({
      url: 'payment/make_payment.php',
      type: 'post',
      data: {
        "paymentMethod": data.paymentMethod,
        "storePaymentMethod": data.storePaymentMethod,
        "accountCode": window.$("#accountCode").val(),
        "shopperReference": window.$("#shopperReference").val()
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
