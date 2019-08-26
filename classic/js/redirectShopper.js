function handleRedirectShopper(response) {
  const issuerUrl = response.issuerUrl;
  const md = response.md;
  const paRequest = response.paRequest;

  const form = document.createElement( 'form' );
  form.style.display = 'none';
  form.name = "redirectForm";
  form.action = issuerUrl;
  form.method = "POST";
  const fieldPaReq = document.createElement( 'input' );
  fieldPaReq.name = "PaReq";
  fieldPaReq.value = paRequest;
  form.appendChild( fieldPaReq );
  const fieldMd = document.createElement( 'input' );
  fieldMd.name = "MD";
  fieldMd.value = md;
  form.appendChild( fieldMd );
  const fieldTermUrl = document.createElement( 'input' );
  fieldTermUrl.name = "TermUrl";
  fieldTermUrl.value = "https://18.138.204.96/classic/";
  form.appendChild( fieldTermUrl );
  $(document.body).append(form);
	form.submit();
}
