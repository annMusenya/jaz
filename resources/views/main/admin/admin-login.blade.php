@extends ('layouts.partials.auth')

@section ('content')

<div class="page-holder d-flex align-items-center">

  <div class="container">

    <div class="row align-items-center py-5">

      <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">

        <div class="pr-lg-5"><img src="{{URL::asset('img/banner1.svg')}}" alt="" class="img-fluid"></div>

      </div>

      <div class="col-lg-5 px-lg-4">

        <h1 class="text-base text-primary text-uppercase mb-4">custom-written.com</h1>

        <h2 class="mb-4">Administrator Login</h2>

        <p class="text-muted">Please remember to keep your passwords safe. Change passwords regularly, for security.</p>

        @include ('main.admin.partials.login-form')

      </div>

    </div>

    <p class="mt-5 mb-0 text-gray-400 text-center">

      &copy; {{date('Y')}} <a href="http://custom-writing.co" target="_blank">custom-written.com</a> | All Rights Reserved.

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
<script src="{{asset('vendor/chart.js/chart.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="{{asset('js/front.js')}}"></script>
<script src="{{asset('js/login.js')}}"></script>

@endsection