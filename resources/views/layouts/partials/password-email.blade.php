<form id="password-reset" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group row">

        <div class="col-md-12">
            <input id="email" type="email" class="form-control border-0 shadow form-control-lg text-blue @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
            @error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
            @enderror 
        </div>
    </div>
    <button id="password-reset-btn" type="submit" class="btn btn-primary shadow px-5">{{ __('Reset Password') }}</button>
    <span href="/login" class="text-right text-muted ml-4 text-sm">Remembered? <a href="/login">Login</a></span>
</form>