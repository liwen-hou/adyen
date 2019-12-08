
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
        originKey: "pub.v2.8115614281177653.aHR0cHM6Ly8xOC4xMzguMjA0Ljk2.k4q0rMm7mIIsE8olkDyOE7MQ66jCtUF8KbwNHAX3ACY",
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
        "commission": window.$("#commission").val(),
        "vat": window.$("#vat").val(),
        "accountCode1": window.$("#accountCode1").val(),
        "accountCode2": window.$("#accountCode2").val(),
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



function form3dSubmit(response) {
  const form = document.createElement('form');
  form.method = 'post';
  form.action = response.redirect.url;
  const hiddenMD = document.createElement('input');
  hiddenMD.type = 'hidden';
  hiddenMD.name = 'MD';
  hiddenMD.value = encodeURI(response.redirect.data.MD);
  form.appendChild(hiddenMD);
  const hiddenPaReq = document.createElement('input');
  hiddenPaReq.type = 'hidden';
  hiddenPaReq.name = 'PaReq';
  hiddenPaReq.value = encodeURI(response.redirect.data.PaReq);
  form.appendChild(hiddenPaReq);
  const hiddenTermUrl = document.createElement('input');
  hiddenTermUrl.type = 'hidden';
  hiddenTermUrl.name = 'TermUrl';
  hiddenTermUrl.value = encodeURI("http://localhost:4999/payment/3D_details.php");
  form.appendChild(hiddenTermUrl);
  document.body.appendChild(form);
  form.submit();
}

function form3ds2Submit(type, paymentData, authResult) {

  $.ajax({
    url: 'payment/3DS2_results.php',
    type: 'post',
    data: {
      "type": type,
      "paymentData": paymentData,
      "authResult": authResult
    },
    success: function(response) {
      response = JSON.parse(response);
      console.log(response.resultCode);
      if (response.resultCode === "ChallengeShopper") {
        const checkout = new AdyenCheckout();
        $('#shopperDetails').html('<div id="threeDS2"></div>');
        const threeDS2Challenge = checkout
        .create('threeDS2Challenge', {
          challengeToken: response.authentication['threeds2.challengeToken'],
          onComplete: function(challengeData) {
            challengeResult = challengeData.data.details["threeds2.challengeResult"];

            form3ds2Submit("challenge", response.paymentData, challengeResult);

          }, // Gets triggered whenever the Component has a result
          onError: function() {}, // Gets triggered on error
          size: '01' // Defaults to '01'
        })
        .mount('#threeDS2');
      } else {
        window.location.href = 'payment/payment_result.php?resultCode=' + response.resultCode;
      }

    }
  });

}
