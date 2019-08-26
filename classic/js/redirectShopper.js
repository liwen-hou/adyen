function handleRedirectShopper(response) {
  const issuerUrl = response.issuerUrl;
  const md = response.md;
  const paRequest = response.paRequest;

  const form = document.createElement( 'form' );
  form.style.display = 'none';
  form.name = "redirectForm";
  form.action = issuerUrl;
  form.method = "POST";
  const input = document.createElement( 'input' );
  input.name = "PaReq";
  input.value = paRequest;
  form.appendChild( input );
  input.name = "MD";
  input.value = md;
  form.appendChild( input );
  input.name = "TermUrl";
  input.value = "https://18.138.204.96/classic/";
  form.appendChild( input );
	form.submit();
}
