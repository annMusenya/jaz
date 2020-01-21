<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group row">
        <div class="col-md-12">
            <input id="name" type="text" class="form-control border-0 shadow form-control-lg text-blue @error('name') is-invalid @enderror text-capitalize" name="name" value="{{ old('name') }}" required autocomplete="name"  placeholder="Username">

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <input id="email" type="email" class="form-control border-0 shadow form-control-lg text-blue @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <input id="phone" type="text" class="form-control border-0 shadow form-control-lg text-blue @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row hidden">
        <div class="col-md-12">
            <input id="country" type="text" class="form-control border-0 shadow form-control-lg text-blue  @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}">
            @error('country')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <input id="password" type="password" class="form-control border-0 shadow form-control-lg text-blue @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                <span toggle="#password" class="toggle-password show text-uppercase text-muted"><strong class="reveal-text">Show</strong></span>
                <div class="password-error text-danger mt-2 ml-2 text-sm hidden"></div>
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
            <div class="password-error text-danger mt-2 ml-2 text-sm hidden"></div>
        </div>
    </div>
    
    <div class="form-group mb-4 mt-4">
        <div class="custom-control custom-checkbox">
          <input id="customCheck1" type="checkbox" class="custom-control-input" checked>
          <label for="customCheck1" class="custom-control-label">I agree to the <a href="#">terms and conditions.</a></label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary shadow px-5">{{ __('Register') }}</button><span class="px-2 text-sm">I have an account<a href="/login"><strong class="ml-2">Login</strong></a></span>
</form>
