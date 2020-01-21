<form id="admin-register-form" method="POST" action="/admin/register">
    @csrf
    <div class="form-group row">
        <div class="col-md-12">
            <input id="name" type="text" class="form-control border-0 shadow form-control-lg text-blue @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name"  placeholder="Username" autofocus>
            <div id="name-error" class="text-sm text-danger mt-2"></div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <input id="email" type="email" class="form-control border-0 shadow form-control-lg text-blue @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
            <div id="email-error" class="text-sm text-danger mt-2"></div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <input id="phone" type="text" class="form-control border-0 shadow form-control-lg text-blue @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
            <div id="phone-error" class="text-sm text-danger mt-2"></div>
        </div>
    </div>

    <div class="form-group row hidden">
        <div class="col-md-12">
            <input id="country" type="text" class="form-control border-0 shadow form-control-lg text-blue  @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}">
            <div id="country-error" class="text-sm text-danger mt-2"></div>
        </div>
    </div>

    <div class="form-group row">

        <div class="col-md-12">
            <input id="password" type="password" class="form-control border-0 shadow form-control-lg text-blue @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
            <div id="password-error" class="text-sm text-danger mt-2"></div>
            <span toggle="#password" class="toggle-password show text-uppercase text-muted"><strong class="reveal-text">Show</strong></span>
            <div class="password-error text-danger mt-2 ml-2 text-sm hidden"></div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <input id="password-confirm" type="password" class="form-control border-0 shadow form-control-lg text-blue" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
        </div>
    </div>
    <button id="register-btn" type="submit" class="btn btn-primary shadow">{{ __('Register') }}</button> <span class="h6 or"></span><span class="px-2 text-sm ml-2">Already have an account? <a href="/admin/login"><strong>Login</strong></a></span>
</form>