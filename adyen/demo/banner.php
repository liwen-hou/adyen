<?php
    session_start();
?>

<div class="py-5 text-center">
  <img data-toggle="modal" data-target="#updateLogoModal" id="logo" class="d-block mx-auto mb-4" src="https://ga0.imgix.net/logo/o/112563-1519298310-3838809?ixlib=rb-1.0.0&ch=Width%2CDPR&auto=format" alt="" width="72" height="72">
  <h2 id="merchantName" data-toggle="modal" data-target="#updateMerchantName">Merchant Name</h2>
  <h5>Powered by Adyen</h5>
</div>


<!-- Modal for Logo -->
<div class="modal fade" id="updateLogoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateLogoModalLabel">Logo Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="logoLink" class="form-control" style="min-width: 100%" value=""></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateLogo()" class="btn btn-primary">Save Logo</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Merchant Name -->
<div class="modal fade" id="updateMerchantName" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateLogoModalLabel">Merchant Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="merchantNameInput" class="form-control" style="min-width: 100%" value=""></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateText()" class="btn btn-primary">Save Name</button>
      </div>
    </div>
  </div>
</div>