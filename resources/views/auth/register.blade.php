@extends ('layouts.partials.auth')

@section ('custom-styles')
<link rel="stylesheet" type="text/css" href="{{asset('libs/tel/css/intlTelInput.min.css')}}">
@endsection 

@section ('content')

<div class="page-holder d-flex align-items-center">

  <div class="container">

    <div class="row align-items-center py-5">

      <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">

        <div class="pr-lg-5"><img src="{{URL::asset('img/banner1.svg')}}" alt="" class="img-fluid"></div>

      </div>

      <div class="col-lg-5 px-lg-4">

        <h1 class="text-base text-primary text-uppercase mb-4"><a href="/">custom-written.com</a></h1>

        <h2 class="mb-4">Register a New Account</h2>

        <p class="text-muted">Get Fast, affordable, turnitin safe papers - written from scratch to your exact instructions by selected UK and US writers.</p>

        @include ('layouts.partials.register-form')

      </div>

    </div>

    <p class="mt-5 mb-0 text-gray-400 text-center">

      &copy; {{date('Y')}} <a href="http://custom-written.com" target="_blank">custom-written.com</a> | All Rights Reserved.

    </p>

    <p class="mt-5 mb-0 text-gray-400 text-center"></p>

  </div>

</div>


@endsection

@section ('scripts')
<script src="{{asset('libs/tel/js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{asset('libs/tel/js/utils.js')}}"></script>
<script src="{{asset('js/register.js')}}"></script>
@endsection