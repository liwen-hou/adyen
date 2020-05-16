var form = document.getElementById('adyen-encrypted-form');
// See https://github.com/Adyen/CSE-JS/blob/master/Options.md for details on the options to use.
var key ="10001|B23ADD4735498542F397D9105A7DFD8767BF8FD222E63CEAFD0CA9360756D7700B0D6206B7C5A58B3B2DA27C17F60DE13D675868B9AF4945A715028005696F88E09000B5175F45F5F3EC20A7F13CABEC8BE9111DD0C63269F67615074039535BD2B01F1F81288554915A25504B091CC55F5A57ED97FB1F719B8F91E26ECE0DD7A655BE32EC4B31E09ED4A60791FB425786759371E85F266043683102F6F04E8F5E50CB8F1639E3C65A1F4FF1A16DA2EF73C1B8DBE84F1C6611009BC3D4D795A04C1CC7693D57C6FA3A698A432FFF0F450086F594799586BC5F163482B637187679D460684001D450974807D6F1C049FCBCEC3788D477066589C853470AF32CE3";
var options = {};
// Set a element that should display the card type
options.cardTypeElement = document.getElementById('cardType');

var encryptedBlobFieldName = "encryptedData";
var threeds2Token = new String();
options.name = encryptedBlobFieldName;
options.onsubmit = function(e) {
  var encryptedData = form.elements[encryptedBlobFieldName].value;
  // ... Your AJAX code here ....
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
