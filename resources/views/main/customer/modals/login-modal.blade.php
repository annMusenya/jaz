<div id="login" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">
	<div role="document" class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 id="login-modal" class="modal-title">Account Login</h4>
				<button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<form id="login-popup" method="POST" action="/login">
					@csrf
					<div class="generic-error alert danger-card shadow bg-red text-white text-sm hidden"></div>
					<div class="form-group">
					<label>Email</label>
					<input id="email" type="email" class="form-control form-control-md text-blue" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
					<div class="email-error text-danger mt-2 ml-2 text-sm hidden"></div>
					</div>
					<div class="form-group"> 
					<label>Password</label>
					    <input id="password" type="password" class="form-control form-control-md text-blue" name="password" required autocomplete="current-password" placeholder="Password"> 
                            <span toggle="#password" class="toggle-password show text-uppercase text-muted"><strong class="reveal-text">Show</strong></span>
                            <div class="password-error text-danger mt-2 ml-2 text-sm hidden"></div>
					</div>
					<div class="row flex mt-4">
						<div class="col-8-sm ml-3">
							<div class="form-group mb-4 text-sm">
								<div class="custom-control custom-checkbox">
									<input id="remember" name="remember" type="checkbox" class="custom-control-input"  {{ old('remember') ? 'checked' : '' }}>
									<label for="remember" class="custom-control-label">{{ __('Remember Me') }}</label>
								</div>
							</div>
						</div>
						<div class="col-4-sm mr-3 text-sm">
							@if (Route::has('password.request'))
								<a href="{{ route('password.request') }}">
									{{ __('Forgot Password?') }}
								</a>
							@endif
						</div>
					</div>
					<div class="row login-buttons">
					<div class="col-md-6 mb-3">
						<button id="login-modal-btn" type="button" class="btn btn-primary btn-sm shadow px-5">{{ __('Login') }}</button>
					</div>
					<div class="col-md-6">
						<div class="ml-1 text-sm">OR<a class="text-muted ml-3" href="/register"><strong>Register</strong></a></div>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>