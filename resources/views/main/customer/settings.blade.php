@extends ('layouts.main')

@section ('sidebar')

@include ('layouts.sidebar.customer.settings')

@endsection

@section ('content')

<section>
<div class="row">
    <div class="col-lg-6 mb-4 text-left">
        <h5 class="h5 text-uppercase mb-1 text-muted">Manage Settings</h5>
        <small class="text-muted">Manage your account settings here. Your profile and account.</small>
    </div>
    <div class="col-lg-12 text-center">
        <i class="fa fa-warning text-gray-400 msg-icon mb-4"></i>
        <p class="h4 text-gray-500">Sorry, we are upgrading our settings.</p>
    </div>
</div>
</section>

@endsection