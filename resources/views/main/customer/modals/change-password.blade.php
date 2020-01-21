<div id="change-password" tabindex="-1" role="dialog" aria-labelledby="checkout-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">
  <div role="document" class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="checkout-modal" class="modal-title">Change Password</h4>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form id="customer-password" method="POST" action="/reset-password/">
				@csrf
				<div class="generic-error alert danger-card shadow bg-red text-white text-sm hidden"></div>
				    <div class="form-group">
				        <label>Old Password</label>
				            <input id="password" type="password" class="form-control form-control-md text-blue" name="password"  required  autofocus placeholder="Old Password">
                            <div class="password-error text-danger mt-2 ml-2 text-sm hidden"></div>
				    </div>
				    <div class="form-group"> 
				        <label>New Password</label>
				            <input id="password" type="password" class="form-control form-control-md text-blue" name="new_password" required placeholder="New Password"> 
                            <div class="new-password-error text-danger mt-2 ml-2 text-sm hidden"></div>
				    </div>
				</div>
				<div class="col-md-12 mb-3 text-right"> 
					<button id='{{$userDetails["id"]}}' type="button" class="btn btn-primary shadow px-5 password-modal-btn">{{ __('Change') }}</button>
				</div>
			</form>
      </div>
  </div>
</div>