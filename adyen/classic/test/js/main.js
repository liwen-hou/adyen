var form = document.getElementById('adyen-encrypted-form');
// See https://github.com/Adyen/CSE-JS/blob/master/Options.md for details on the options to use.
var key ="10001|CB66AC908159D85884339ED0378350BD53BB4FB2206EB72CF6EDB5F98FD8101DC102CCA05D69D3B146A566F431B1B34E73A4FEFAE43B390F791A1AD84108E618664F240B11CBCE64CB7BE4101CB6042948820D4F9ED02A666EF6236DDFE043300CA8276CF0C5F933695FE96F72227943423DE34479A847ED8050392EB658919534AFC57246769C65A1B0FAA841BC7EEADF30DCD2C3428FA16B1FBCB5BC90E6C6F717050095984A099CA944EFDC7435BE1ADDA5D244CAB3FC8D12753B6E141D2C63F8B42FA3D90912AD6395E47682C573959DF16DAC61F17282B28DA7DED579F224933D31B2D34449138A4D41BD559C568698B6C97459F9DAB4F70C17758D005D";
var options = {};
// Set a element that should display the card type
options.cardTypeElement = document.getElementById('cardType');

var encryptedBlobFieldName = "encryptedData";
var threeds2Token = new String();
options.name = encryptedBlobFieldName;
options.onsubmit = function(e) {
  var encryptedData = form.elements[encryptedBlobFieldName].value;
  // ... Your AJAX code here ....

  console.log(encryptedData);
  $.ajax({
    url: 'lib/make_payment.php',
    type: 'post',
    data: {
      'adyen-encrypted-data':encryptedData
    },
    success: function(responseData) {
      responseData = JSON.parse(responseData);
      handleResponse(responseData);
    }
  }),
  e.preventDefault();

};

window.addEventListener("message", (e) =>
{
  if(e.origin === "https://18.138.204.96"){
    const eventData = e.data;
    // IdentifyShopper (3DSMethod) response
    if(eventData.hasOwnProperty("threeDSMethodData")){
      // If you haven't already performed the next /authorise3ds2 call from your notification URL this
      // represents a good place to initiate the an API request
      $.ajax({
        url: 'lib/3ds2Auth.php',
        type: 'post',
        data: {
          'threeDS2Token':threeds2Token
        },
        success: function(response) {
          response = JSON.parse(response);
          handleResponse(response);
        }
      });

    }

    // Challenge response
    if(eventData.hasOwnProperty('cres')){

      // If you haven't already performed the next /authorise3ds2 call from your notification URL this
      // represents a good place to initiate the an API request
      cres = JSON.parse(base64Url.decode(eventData.cres));

      // authorise3DS2RequestAfterChallenge(eventData.transStatus, eventData.threeDSServerTransID);
      $.ajax({
        url: 'lib/challengeAuth.php',
        type: 'post',
        data: {
          'transStatus':cres.transStatus,
          'threeDS2Token':threeds2Token
        },
        success: function(response) {
          response = JSON.parse(response);
          handleResponse(response);
        }
      });
    }

    // Run code to remove the iframe from the '#threedsContainer' element
    // hideIframe();
  }
});

var encryptedForm = adyen.encrypt.createEncryptedForm( form, key, options);
encryptedForm.addCardTypeDetection(options.cardTypeElement);
