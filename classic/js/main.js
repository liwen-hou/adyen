var form = document.getElementById('adyen-encrypted-form');
// See https://github.com/Adyen/CSE-JS/blob/master/Options.md for details on the options to use.
var key ="10001|BBAD60A5F4A892C824D7313DDFA5200FDB037972332E161F34889AB5F35F00D178855C0747E414991FABBF53775E825DFC2B74AC4BFE4AFBE67405C6BAA39AE22624FE87E44E933DE21022237178F5235E954E17C6397D7922BF00039B722DA3ABC5108EAE9CB65F50D247E441A85D72A90B936B888FCD1B0223DF09354F8CC6345168D197FAE515535A5D4511D42979CEA3BC692BA66FA6E7A4D3649C8BB05F1CDC7193B136C064BA9A78BB1C7FA20B23CDAC6A6534C4F1C6B0B98FFEC0CC8A03667AC75E8AF6C8B03C5AD50A0D9297DADCE3CED1DD6FD472A4E498EBCBEE9C3A51718C5C24697C6A6FC9B40FA089DDFE6DE49473DFBBC9E17ADE00899184A1";
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
  console.log(e);
  if(e.origin === "https://18.138.204.96"){
    const eventData = e.data;
    console.log(eventData);
    // IdentifyShopper (3DSMethod) response
    if(eventData.hasOwnProperty('threeDSMethodData')){

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
    if(eventData.hasOwnProperty('transStatus') && eventData.hasOwnProperty('threeDSServerTransID')){

      // If you haven't already performed the next /authorise3ds2 call from your notification URL this
      // represents a good place to initiate the an API request
      console.log(eventData);
      // authorise3DS2RequestAfterChallenge(eventData.transStatus, eventData.threeDSServerTransID);
    }

    // Run code to remove the iframe from the '#threedsContainer' element
    // hideIframe();
  }
});

var encryptedForm = adyen.encrypt.createEncryptedForm( form, key, options);
encryptedForm.addCardTypeDetection(options.cardTypeElement);
