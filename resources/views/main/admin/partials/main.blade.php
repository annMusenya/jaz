<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('layouts.head')
<body>
  @include ('main.admin.partials.header')
  <div class="d-flex align-items-stretch">
    @yield ('sidebar')
    <div class="page-holder w-100 d-flex flex-wrap">
      <div class="preloader">
          <div class="spinner-border m-5" role="status">
            <span class="sr-only">Loading...</span>
          </div>
      </div>
      <div class="main-content container-fluid px-xl-5">
        <section class="py-5">
          @yield ('content')
        </section>
      </div>
      @include ('layouts.footer')  
    </div>
  </div>
      @include ('layouts.scripts')
      @yield ('scripts')
</body>
</html>