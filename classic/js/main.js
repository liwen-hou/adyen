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

 const base64Url = {
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
 };
