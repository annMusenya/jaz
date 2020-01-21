@extends ('main.admin.partials.main-admin')

@section ('sidebar')

@include ('layouts.sidebar.admin-sidebar.none')

@endsection

@section ('content')

<section>
<div class="row">
    <div class="col-lg-6 mb-4 text-left">
        <h6 class="h5 text-uppercase mb-1 text-muted">Personal Info</h6>
        <small class="text-muted">Manage your personal account info.</small>
    </div>
</div>
<div class="row">
    <div class="col-lg-2">
        <img src="{{asset('img/user.svg')}}" class="img-fluid rounded-circle shadow" width="120px" height="auto">
        <div class="mt-3 ml-4 text-muted">Basic Info</div>
    </div>
    <div class="col-lg-10">
        <div class="text-muted text-sm">Enter your name, username and primary email address. You can change your primary email address at any time.</div>
        <div class="row mt-4">
            <div class="col-md-3 text-muted"><strong>Username</strong></div>
            <div class="col-md-9 text-capitalize text-primary">{{$userDetails["name"]}}</div>
            <hr>
            <div class="col-md-3 text-muted"><strong>Phone</strong></div>
            <div class="col-md-9 text-primary">{{$userDetails["phone"]}}</div>
            <hr>
            <div class="col-md-3 text-muted"><strong>Primary Email</strong></div>
            <div class="col-md-9 text-primary">{{$userDetails["email"]}}</div>
            <hr>
            <div class="col-md-3 text-muted"><strong>Account Type</strong></div>
            <div class="col-md-9 text-primary">{{$userDetails["role"]}}</div>
            <hr>
            <div class="col-md-3 text-muted"><strong>Status</strong></div>
            <div class="col-md-9 text-primary">
                @if ($userDetails["subscription"])
                    <div class="badge badge-green px-2 py-1">Active</div>
                @endif
                <small class="text-muted">(Since {{$date}})</small>
            </div>
            <div class="col-md-10 mt-2 text-right"><button class="btn btn-primary btn-sm">Edit</button></div>
        <div>
    </div>
</div>
</section>

@endsection


@section ('scripts')
<script src="{{asset('libs/tel/js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{asset('libs/tel/js/utils.js')}}"></script>
<script src="{{asset('js/writer-register.js')}}"></script>
@endsection