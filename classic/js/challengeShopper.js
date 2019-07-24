

function handleChallengeShopper(response) {

  const challengeWindowSize = config.validateChallengeWindowSize('04');// Corresponds to a 600px x 400px iframe size

  // Extract the ACS hosted url that will provide the content for the challenge iframe
  const acsURL = response.additionalData['threeds2.threeDS2ResponseData.acsURL'];

  // Collate the data required to make a cReq
  const cReqData = {
      threeDSServerTransID : response.additionalData['threeds2.threeDS2ResponseData.threeDSServerTransID'],
      acsTransID : response.additionalData['threeds2.threeDS2ResponseData.acsTransID'],
      messageVersion : response.additionalData['threeds2.threeDS2ResponseData.messageVersion'],
      messageType : 'CReq',
      challengeWindowSize
  };

  const stringifiedDataObject = JSON.stringify(cReqData);

  // Encode data
  const base64URLencodedData = base64Url.encode(stringifiedDataObject);

  const IFRAME_NAME = 'threeDSChallengeIframe';

  const threedsContainer = document.getElementById('threedsContainer');

  const iframeSizesArr = getChallengeWindowSize(challengeWindowSize);

  // Create iframe with challenge window dimensions
  const iframe = createIframe(threedsContainer, IFRAME_NAME, iframeSizesArr[0], iframeSizesArr[1]);

  // Create a form that will use the iframe to POST data to the acsURL
  const form =  createForm('cReqForm', acsURL, IFRAME_NAME, 'creq', base64URLencodedData);

  threedsContainer.appendChild(form);

  setTimeout( function () {
      threedsContainer.removeChild( form );
  }, 1000 );

  form.submit();

}
