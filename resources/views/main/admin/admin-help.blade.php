@extends ('main.admin.partials.main-admin')

@section ('sidebar')

@include ('layouts.sidebar.admin-sidebar.help')

@endsection

@section ('content')

<section>
<div class="row">
    <div class="col-lg-6 mb-4 text-left">
        <h5 class="h5 text-uppercase mb-1 text-muted">Help Guide</h5>
        <small class="text-muted">The how-tos and guidelines on application use.</small>
    </div>
    <div class="col-lg-12 text-center">
        <i class="fa fa-hand-peace-o text-gray-200 msg-icon mb-4"></i>
        <p class="h4 text-gray-500">Chill, we'll get this section up.</p>
    </div>
</div>
</section>

@endsection


@section ('scripts')

<script src="{{URL::asset('libs/dropzone/dropzone.min.js')}}"></script>

@endsection