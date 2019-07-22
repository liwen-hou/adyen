function handleIdentifyShopper(response) {
	threeds2Token = response.additionalData["threeds2.threeDS2Token"];
	perform3DSDeviceFingerprint(response);
}
