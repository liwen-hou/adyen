<?php
date_default_timezone_set("Asia/Singapore");
?>

<!DOCTYPE html>
<html class="html">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="robots" content="noindex"/>
  <title>Adyen Checkout</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">

</head>
<body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">Adyen Payment Experience</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="/">Checkout API</a>
      <a class="p-2 text-dark" href="/sdk">Checkout SDK</a>
      <a class="p-2 text-dark" href="/pos">POS</a>
      <a class="p-2 text-dark" href="/classic">Classic Integration</a>
    </nav>
  </div>
  <div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="assets/img/checkout.png" alt="" width="100" height="100">
      <h2 class="heading">One More Step to Your Seasonal Favorites</h2>
      <p class="lead">Complete the checkout process powered and secured by Adyen by filling in the information below, and your items will be on the way!</p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span>Your cart</span>
          <span class="badge badge-secondary badge-pill">3</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Product name</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">€5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Second product</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">€3</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Third item</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">€92.99</span>
          </li>
        </ul>
      </div>


      <div class="col-md-6">
        <div id="shopperDetails">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span>Confirm and Pay</span>
          </h4>

          <div class="card">
            <div class="card-body">
              <form id="adyen-encrypted-form">
                <div class="mb-3">
                  <span>Card Number:</span><span id="cardType"></span>
                  <input class="form-control" type="text" size="20" data-encrypted-name="number"/>
                </div>
                <div class="mb-3">
                  <span>Holder Name:</span>
                  <input class="form-control" type="text" size="20" data-encrypted-name="holderName"/>
                </div>
                <div class="mb-3">
                    <label for="adyen-encrypted-form-expiry-month">
                        <span>Expiration (MM/YYYY)</span>
                        <input type="text" value="10"   id="adyen-encrypted-form-expiry-month" maxlength="2" size="2" autocomplete="off" data-encrypted-name="expiryMonth" /> /
                    </label>
                    <!-- Do not use two input elements inside a single label. This will cause focus issues on the seoncd and latter fields using the mouse in various browsers -->
                    <input type="text" value="2020" id="adyen-encrypted-form-expiry-year" maxlength="4" size="4" autocomplete="off" data-encrypted-name="expiryYear" />
                </div>
                <div class="mb-3">
                  <span>CVC</span>
                  <input class="form-control" type="text" size="4" data-encrypted-name="cvc"/>
                </div>
                <div class="mb-3">
                  <input type="hidden" value="<?php echo (new DateTime())->format('c');?>" data-encrypted-name="generationtime"/>
                  <input class="btn btn-primary btn-lg btn-block" type="submit" value="Pay"/>
              </form>
            </div>
          </div>
        </div>


      </div>

    </div>
  </div>
  <script type="text/javascript" src="https://test.adyen.com/hpp/cse/js/8115614281177653.shtml"></script>
  <script type="text/javascript">
    /**
     * @function encodeBase64URL
     *
     * @desc Takes a string and encodes it as a base64url string
     * (https://en.wikipedia.org/wiki/Base64#URL_applications)
     * (See also https://tools.ietf.org/html/rfc7515)
     *
     * @example const jsonStr = JSON.stringify( {name:'john', surname:'smith'} );
     *          const base64url = base64URL.encode(jsonStr);
     *
     * @param dataStr {String} - data, as a string, to be encoded
     *
     * @returns base64url {String} : a base64url encoded string
     */
     const encodeBase64URL = (dataStr) => {
       let base64 = window.btoa(dataStr);
       let base64url = base64.split('=')[0]; // Remove any trailing '='s

       base64url = base64url.replace(/\+/g, '-'); // 62nd char of encoding
       base64url = base64url.replace(/\//g, '_'); // 63rd char of encoding

       return base64url;
     };

     /**
     * @function decodeBase64URL
     *
     * @desc Takes a base64url encoded string and decodes it to a regular string
     * (See also https://tools.ietf.org/html/rfc7515)
     *
     * @example const dataStr = base64URL.decode(base64url)
     *          const decodedObj = JSON.parse(dataStr);
     *
     * @param str {String} - base64url encoded string
     *
     * @returns {String} - a regular string
     */
     const decodeBase64URL = (str) => {
       let base64 = str;
       base64 = base64.replace(/-/g, '+'); // 62nd char of encoding
       base64 = base64.replace(/_/g, '/'); // 63rd char of encoding
       switch (base64.length % 4) // Pad with trailing '='s
       {
         case 0:
         break; // No pad chars in this case
         case 2:
         base64 += "=="; break; // Two pad chars
         case 3:
         base64 += "="; break; // One pad char
         default:
         if(window.console && window.console.log){
           window.console.log('### base64url::decodeBase64URL::  Illegal base64url string!');
         }
       }

       try {
         return window.atob(base64);
       } catch (e) {
         throw new Error(e);
       }
     };

     const base64URL = {
       encode : encodeBase64URL,
       decode: decodeBase64URL
     };

     /**
     * @function createForm
     *
     * @desc Generic function for creating a form element with a target attribute
     *
     * @param name {String} - the name of the form element
     * @param action {String} - the action for the form element
     * @param target {String} - the target for the form element (specifies where the submitted result will open i.e. an iframe)
     * @param inputName {String} - the name of the input element holding the base64Url encoded JSON
     * @param inputValue {String} - the base64Url encoded JSON
     *
     * @returns {Element} - Created form element
     */
     const createForm = (name, action, target, inputName, inputValue) => {

       if (!name || !action || !target || !inputName || !inputValue) {
         throw new Error('Not all required parameters provided for form creation');
       }

       if (name.length === 0 || action.length === 0 || target.length === 0 || inputName.length === 0 || inputValue.length === 0) {
         throw new Error('Not all required parameters have suitable values');
       }

       const form = document.createElement( 'form' );
       form.style.display = 'none';
       form.name = name;
       form.action = action;
       form.method = "POST";
       form.target = target;
       const input = document.createElement( 'input' );
       input.name = inputName;
       input.value = inputValue;
       form.appendChild( input );
       return form;
     };

     const configObject = {};
     configObject.container = void 0;

     const addIframeListener = (iframe, callback) => {
       if (iframe.attachEvent){
         // IE fallback
         iframe.attachEvent("onload", function(){
           if (callback && typeof callback === "function") {
             callback(iframe.contentWindow);
           }
         });
       } else {
         iframe.onload = function(){
           if (callback && typeof callback === "function") {
             callback(iframe.contentWindow);
           }
         };
       }
     };

     /**
     * @function createIframe
     *
     * @desc Generic function for creating an iframe element with onload listener and adding iframe to passed container element
     *
     * @param container {HTMLElement} - the container to place the iframe onto, defaults to document body
     * @param name {String} - the name for the iframe element
     * @param width {String} - the width of the iframe, defaults to 0
     * @param height {String} - the height of the iframe, defaults to 0
     * @param callback { Function } - optional, the callback to fire after the iframe loaded content
     *
     * @returns {Element} - Created iframe element
     */
     const createIframe = (container, name, width = '0', height = '0', callback) => {
       if (!name || name.length === 0){
         throw new Error('Name parameter missing for iframe');
       }

       // Resolve holding element for generated iframe else default to body
       if (container instanceof HTMLElement) {
         configObject.container = container;
       } else {
         configObject.container = document.body;
       }

       const iframe = document.createElement('iframe');

       iframe.classList.add(name + 'Class');
       iframe.width = width;
       iframe.height = height;
       iframe.name = name;
       iframe.setAttribute('frameborder', '0');
       iframe.setAttribute('border', '0');

       const noIframeElContent = document.createTextNode('<p>Your browser does not support iframes.</p>');
       iframe.appendChild(noIframeElContent);

       configObject.container.appendChild(iframe);

       addIframeListener(iframe, callback);

       return iframe;
     };

     var form = document.getElementById('adyen-encrypted-form');
     // See https://github.com/Adyen/CSE-JS/blob/master/Options.md for details on the options to use.
     var key ="10001|BBAD60A5F4A892C824D7313DDFA5200FDB037972332E161F34889AB5F35F00D178855C0747E414991FABBF53775E825DFC2B74AC4BFE4AFBE67405C6BAA39AE22624FE87E44E933DE21022237178F5235E954E17C6397D7922BF00039B722DA3ABC5108EAE9CB65F50D247E441A85D72A90B936B888FCD1B0223DF09354F8CC6345168D197FAE515535A5D4511D42979CEA3BC692BA66FA6E7A4D3649C8BB05F1CDC7193B136C064BA9A78BB1C7FA20B23CDAC6A6534C4F1C6B0B98FFEC0CC8A03667AC75E8AF6C8B03C5AD50A0D9297DADCE3CED1DD6FD472A4E498EBCBEE9C3A51718C5C24697C6A6FC9B40FA089DDFE6DE49473DFBBC9E17ADE00899184A1";
     var options = {};
     // Set a element that should display the card type
     options.cardTypeElement = document.getElementById('cardType');

     var encryptedBlobFieldName = "encryptedData";

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
             console.log(responseData);
             JSON.parse(responseData);
             if(responseData.resultCode == "IdentifyShopper") {
               console.log("submit to issuer");
               const perform3DSDeviceFingerprint = (responseData) =>
               {
                 const serverTransactionID = responseData.additionalData['threeds2.threeDSServerTransID'];
                 const threeDSMethodURL = responseData.additionalData['threeds2.threeDSMethodURL'];
                 const threedsContainer = document.getElementById('threedsContainer');
                 const dataObj = {
                   threeDSServerTransID : serverTransactionID,
                   threeDSMethodNotificationURL : "https://18.138.204.96/classic/lib/notification.php"
                 };
                 const stringifiedDataObject = JSON.stringify(dataObj);
                 // Encode data
                 const base64URLencodedData = base64Url.encode(stringifiedDataObject);
                 const IFRAME_NAME = 'threeDSMethodIframe';

                 // Create hidden iframe
                 const iframe = createIframe(threedsContainer, IFRAME_NAME, '0', '0');
                 // Create a form that will use the iframe to POST data to the threeDSMethodURL
                 const form =  createForm('threedsMethodForm', threeDSMethodURL, IFRAME_NAME, 'threeDSMethodData', base64URLencodedData);
                 threedsContainer.appendChild(form);
                 setTimeout( function () {
                   threedsContainer.removeChild( form );
                 }, 1000 );
                 form.submit();
                 window.addEventListener("message", (e) =>
                 {
                   if(e.origin === "https://18.138.204.96/classic/lib/notification.php"){
                     const eventData = e.data;
                     // IdentifyShopper (3DSMethod) response
                     if(eventData.hasOwnProperty('threeDSCompInd')){

                       // If you haven't already performed the next /authorise3ds2 call from your notification URL this
                       // represents a good place to initiate the an API request
                       console.log(eventData);
                       // authorise3DS2RequestAfterIdentifyingShopper(eventData.threeDSCompInd);
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
               };
             };
           }
         }),

         e.preventDefault();
     };

     var encryptedForm = adyen.encrypt.createEncryptedForm( form, key, options);
     encryptedForm.addCardTypeDetection(options.cardTypeElement);




     </script>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
