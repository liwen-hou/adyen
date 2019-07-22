function handleIdentifyShopper(response) {
	threeds2Token = responseData.additionalData["threeds2.threeDS2Token"];
	perform3DSDeviceFingerprint(responseData);
}
