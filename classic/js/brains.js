function handleResponse(response) {
	console.log(response);

	switch(response.resultCode) {
		case "RedirectShopper":
			handleRedirectShopper(response);
			break;
		case "Authorised":
			handleAuthorised(response);
			break;
		case "IdentifyShopper":
		 	handleIdentifyShopper(response);
		 	break;
		case "ChallengeShopper":
			handleChallengeShopper(response);
			break;
		default:
			handleOther(response);
			break;
	}
}

// Payment button action handling

$(document).ready(function () {
	$("#payButton").click(function (event) {
		event.preventDefault();
		var paymentFormData = $("#paymentForm form").serialize();
		showLoading();

		$.post('./submitters/payment.php', paymentFormData,
			function(data) {
				console.log(data);
				handleResponse(data)
			}, 'json');

		// Remove form from view
		$("#paymentForm").slideUp();
	});
});
