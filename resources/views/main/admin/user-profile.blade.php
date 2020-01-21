@extends ('main.admin.partials.main-admin')

@section ('custom-styles')
<link rel="stylesheet" type="text/css" href="{{asset('libs/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/noty/noty.css')}}">
@endsection


@section ('sidebar')

@include ('layouts.sidebar.admin-sidebar.none')

@endsection

@section ('content')
<!--
<section>
    @if($userCategory == "2")
     <div class="col-lg-12 mb-4 text-left">
        <h6 class="h5 text-uppercase mb-1 text-muted">Writer Stats</h6>
        <small class="text-muted">User Reviews and Statistics. Track your user information.</small> 
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-violet"></div>
              <div class="text">
                <h6 class="mb-0">Data consumed</h6><span class="text-gray">145,14 GB</span>
              </div>
            </div>
            <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-green"></div>
              <div class="text">
                <h6 class="mb-0">Open cases</h6><span class="text-gray">32</span>
              </div>
            </div>
            <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text">
                <h6 class="mb-0">Work orders</h6><span class="text-gray">400</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-red"></div>
              <div class="text">
                <h6 class="mb-0">New invoices</h6><span class="text-gray">123</span>
              </div>
            </div>
            <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
          </div>
        </div>
    </div>

    @endif

    @if($userCategory == "3")
     <div class="col-lg-12 mb-4 text-left">
        <h6 class="h5 text-uppercase mb-1 text-muted">Customer Stats</h6>
        <small class="text-muted">User Reviews and Statistics. Track your user information.</small> 
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-violet"></div>
              <div class="text">
                <h6 class="mb-0">Orders Placed</h6><span class="text-gray"><strong>{{$clientOrders}}</strong></span>
              </div>
            </div>
            <div class="icon text-white bg-primary"><i class="o-document-1"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-green"></div>
              <div class="text">
                <h6 class="mb-0">Open cases</h6><span class="text-gray">32</span>
              </div>
            </div>
            <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-blue"></div>
              <div class="text">
                <h6 class="mb-0">Work orders</h6><span class="text-gray">400</span>
              </div>
            </div>
            <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
          <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1 d-flex align-items-center">
              <div class="dot mr-3 bg-red"></div>
              <div class="text">
                <h6 class="mb-0">New invoices</h6><span class="text-gray">123</span>
              </div>
            </div>
            <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
          </div>
        </div>
    </div>
    @endif
</section> -->

<section>
    <div class="row">
        <div class="col-lg-12 mb-4 text-left">
            <h6 class="h5 text-uppercase mb-1 text-muted">User Info</h6>
            <small class="text-muted">Manage user information and their account.</small>
        </div>
        <div class="col-lg-2">
            <img src="{{asset('img/user.svg')}}" class="img-fluid rounded-circle shadow" width="120px" height="auto">
            <div class="mt-3 ml-4 text-muted">Basic Info</div>
        </div>
        <div class="col-lg-10">
            <div class="text-muted text-sm"></div>
            <div class="row mt-4">
                <input name="user_id" class="form-control hidden" value="{{$accountId}}">
                <div class="col-md-3 text-muted"><strong>Name</strong></div>
                <div class="col-md-9 text-capitalize text-primary">{{$accountDetails["name"]}}</div>
                <hr>
                <div class="col-md-3 text-muted"><strong>Phone</strong></div>
                <div class="col-md-9 text-primary">{{$accountDetails["phone"]}}</div>
                <hr>
                <div class="col-md-3 text-muted"><strong>Primary Email</strong></div>
                <div class="col-md-9 text-primary">{{$accountDetails["email"]}}</div>
                <hr>
                <div class="col-md-3 text-muted"><strong>Account Type</strong></div>
                <div class="col-md-9 text-primary">{{$accountDetails["role"]}}</div>
                <hr>
                <div class="col-md-3 text-muted"><strong>Country</strong></div>
                <div class="col-md-9 text-primary">{{$accountDetails["country"]}}</div>
                <hr>
                <div class="col-md-3 text-muted"><strong>Status</strong></div>
                <div class="col-md-9 text-primary">
                    @if($accountDetails["status"])
                        <div class="badge badge-green px-2 py-1">Active</div>
                    @else
                        <div class="badge badge-danger px-2 py-1">Suspended</div>
                    @endif
                    <small class="text-muted">(Since {{$date}})</small> 
                </div>

                @if($userRole == "Writer")

                    <div class="col-md-10 mt-2 text-right">
                        @if($accountDetails["status"])
                            <button class="btn btn-gray-500 suspend-user">Suspend</button> 
                        @else 
                            <button class="btn btn-dark restore-user">Restore</button> 
                        @endif
                        <button class="btn btn-danger ml-3 delete-user"><i class="fa fa-trash"></i></button>
                    </div>

                @endif
            <div>
        </div>
    </div>
</section>

@endsection


@section ('scripts')
<script src="{{asset('libs/tel/js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{asset('libs/tel/js/utils.js')}}"></script>
<script src="{{asset('js/user-manager.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{asset('libs/jquery-confirm/jquery-confirm.min.js')}}"></script>
@endsection