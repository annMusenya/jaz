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

        <h1 class="text-base text-primary text-uppercase mb-4">custom-written.com</h1>

        <h2 class="mb-4">Create an Admin Account</h2>

        <p class="text-muted">Manage users, orders and payments. All in one dashboard. An admin has super admin privileges. Make sure you keep your password a secret.</p>

        @include ('main.admin.partials.register-form')

      </div>

    </div>

    <p class="mt-5 mb-0 text-gray-400 text-center">

      &copy; {{date('Y')}} <a href="http://custom-written.com" target="_blank">custom-written.com</a> | All Rights Reserved.

      <br>Developed by Leonard

    </p>

    <p class="mt-5 mb-0 text-gray-400 text-center"></p>

  </div>

</div>


@endsection

@section ('scripts')
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/popper.js/umd/popper.min.js')}}"> </script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="{{asset('js/front.js')}}"></script>
<script src="{{asset('libs/tel/js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{asset('libs/tel/js/utils.js')}}"></script>
<script src="{{asset('js/register.js')}}"></script>
@endsection