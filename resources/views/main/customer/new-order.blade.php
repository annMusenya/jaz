@extends ('layouts.main')

@section ('custom-styles')
<link rel="stylesheet" type="text/css" href="{{asset('libs/dropzone/basic.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/dropzone/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/select2.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/filer/css/jquery.filer.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/filer/css/themes/jquery.filer-dragdropbox-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/noty/noty.css')}}">
@endsection

@section ('sidebar')

@include ('layouts.sidebar.customer.new-order')

@endsection

@section ('content')

      <form id="order-form" method="POST" action="/paypal-checkout" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-4 mb-5">
            @include ('main.customer.steps.step-one')
          </div>
          <div class="col-lg-4 mb-5">
            @include ('main.customer.steps.step-two')
          </div>
          <div class="col-lg-4 mb-5">
            @include ('main.customer.steps.step-three')
          </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-5 text-center">
             <h5 id="total-price" class="h4 text-uppercase mb-0">Total Price: <span class="text-primary grandTotal"></span></h5>
             <input type="text" name="price_amount" class="form-control hidden">
             <input type="text" name="writer_amount" class="form-control hidden">
             <input type="text" name="writer_deadline" class="form-control hidden">
                  @if ($userDetails["category"] == 3)
                    <button id="proceed-btn" class="btn btn-success mt-3" type="button" data-toggle="modal" data-target="#checkout">Proceed to Payment</button>
                  @else
                    <button class="btn btn-success mt-3" type="button" data-toggle="modal" data-target="#login">Proceed to Payment</button>
                  @endif
            </div>
        </div>
            @include ('main.customer.modals.checkout-modal')
        </form>
      </div>
        <div class="col-lg-12 text-center">
          <img src="{{asset('img/payment.svg')}}" alt="we accept">
        </div>
      <hr>
      <div class="row mt-3">
        <div class="col-md-12">
            <h6 class="text-secondary h6 text-center">By clicking "Proceed" button you hereby agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a> of custom-written.com</h6>
        </div>
        <div class="col-md-12">
            <p class="text-gray-500 text-center text-sm">Disclaimer: All the research and custom writing services provided by the Company have limited use as stated in the Terms and Conditions. The customer ordering the services is not in any way authorized to reproduce or copy both completed paper (essay, term paper, research paper coursework, dissertation, others) or specific parts of it without proper referencing. The company is not responsible and will not report to any third parties due to unauthorized utilization of its works.</p>
        </div>
      </div>
	  
	  @include ('main.customer.modals.login-modal')

@endsection

@section ('scripts')

<script type="text/javascript" src="{{asset('js/order-form.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/momentjs/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/filer/js/jquery.filer.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/filer.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/noty/noty.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/order-system.js')}}"></script>
<script src="{{asset('libs/jquery-confirm/jquery-confirm.min.js')}}"></script>
<script type="text/javascript" src="{{asset('libs/select2/js/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('js/login.js')}}"></script>

@endsection 
