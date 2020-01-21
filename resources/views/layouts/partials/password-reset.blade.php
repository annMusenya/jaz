<form id="reset-password" method="POST" action="/reset/password">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group row">
        <div class="col-md-12">
            <input id="email" type="email" class="form-control border-0 shadow form-control-lg text-blue @error('email') is-invalid @enderror hidden" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <input id="password" type="password" class="form-control border-0 shadow form-control-lg text-blue @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-12">
            <input id="password-confirm" type="password" class="form-control border-0 shadow form-control-lg text-blue" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-12">
		   <button id="password-reset-btn" type="submit" class="btn btn-primary shadow px-5">{{ __('Reset Password') }}</button>
        </div>
    </div>
</form>