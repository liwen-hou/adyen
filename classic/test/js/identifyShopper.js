function handleIdentifyShopper(response) {
	threeds2Token = response.additionalData["threeds2.threeDS2Token"];
	const serverTransactionID = response.additionalData['threeds2.threeDSServerTransID'];
	const threeDSMethodURL = response.additionalData['threeds2.threeDSMethodURL'];
	const threedsContainer = document.getElementById('threedsContainer');
	const dataObj = {
		threeDSServerTransID : serverTransactionID,
		threeDSMethodNotificationURL : "https://18.138.204.96/classic/test/lib/notification.php"
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
}
