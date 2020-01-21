@extends ('main.writer.partials.main-writer')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.writer.help')

@endsection


@section ('content')

<section>
    <div class="row">
        <div class="col-lg-6 mb-4 text-left">
            <h5 class="h5 text-uppercase mb-1 text-muted">Help Center</h5>
            <small class="text-muted">Welcome to our help center. Read faqs and guidelines.</small>
        </div>
    </div>

    <div class="row">
	    <div class="col-lg-12 text-center">
            <i class="fa fa-crown text-gray-300 msg-icon mb-4"></i>
                <p class="h6 text-gray-400">Keep calm. We are updating our knowledgebase.</p>
        </div>
    </div>

</section>
@endsection

@section ('scripts')
<script src="{{asset('/libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/libs/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{URL::asset('js/admin-main.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
@endsection