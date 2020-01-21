<form id="customer-login" method="POST" action="/login">
    @csrf
	<div class="generic-error alert danger-card shadow bg-red text-white hidden"></div>
    <div class="form-group row">
        <div class="col-md-12">
            <input id="email" type="email" class="form-control border-0 shadow form-control-lg text-blue" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
            <div class="email-error text-danger mt-2 ml-2 text-sm hidden"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <input id="password" type="password" class="form-control border-0 shadow form-control-lg text-blue" name="password" required autocomplete="current-password" placeholder="Password"> 
			<span toggle="#password" class="toggle-password show text-uppercase text-muted"><strong class="reveal-text">Show</strong></span>
            <div class="password-error text-danger mt-2 ml-2 text-sm hidden"></div>
        </div>
    </div>
    <div class="row flex mt-4">
      <div class="col-8-sm ml-3">
          <div class="form-group mb-4">
              <div class="custom-control custom-checkbox">
              <input id="remember" name="remember" type="checkbox" class="custom-control-input"  {{ old('remember') ? 'checked' : '' }}>
              <label for="remember" class="custom-control-label">{{ __('Remember Me') }}</label>
              </div>
          </div>
        </div>
        <div class="col-4-sm mr-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
        </div>
  </div>
    <button id="customer-login-btn" type="button" class="btn btn-primary shadow px-5">{{ __('Login') }}</button> <span class="or">{{ 'Are you new here? '}} <a class="h6 text-primary" href="/register">Register</a></span>
</form>