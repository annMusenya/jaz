@extends ('main.admin.partials.main-admin')

@section ('custom-styles')
<link rel="stylesheet" type="text/css" href="{{asset('libs/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/noty/noty.css')}}">
@endsection

@section ('sidebar')

@include ('layouts.sidebar.admin-sidebar.main')

@endsection


@section ('content')

<section>
    <input name="order_id" class="hidden" value="{{$order->id}}">
    <div class="row">
        <div class="col-xl-6 mb-4 text-left">
            <div class="text-uppercase mb-1 text-muted h5">Order #{{$id}}</div>
                @php
                    $status = $order->order_status;
                    switch ($status)
                        {
                            case 0:
                @endphp
                    <div class="badge badge-red px-2 py-1">Unassigned</div>
                @php
                            break;
                            case 1:
                @endphp
                    <div class="badge badge-green px-2 py-1">Assigned</div>
                @php
                            break;
                            case 2:
                @endphp
                    <div class="badge badge-gray-500 px-2 py-1 text-white">Cancelled</div>
                @php
                            break;
                            case 3:
                @endphp
                    <div class="badge badge-warning px-2 py-1">Revision</div>
                @php
                            break;
                            case 4:
                @endphp
                    <div class="badge badge-violet px-2 py-1 text-dark">Delivered</div>
                @php
                            break;
                            case 5:
                @endphp
                    <div class="badge badge-dark px-2 py-1 text-white">Done</div>
                @php
                            break;
                            case 6:
                @endphp
                    <div class="badge badge-success px-2 py-1 text-white">Finished</div>
                @php
                            break;
                            case 8:
                @endphp
                    <div class="badge badge-warning px-2 py-1 text-dark">Bidding</div>
                @php
                            break;
                            case 9:
                @endphp
                    <div class="badge badge-danger px-2 py-1 text-white">Rejected</div>
                @php
                        }
                @endphp
                
                <span class="text-muted ml-2">{{$order->topic}}</span> 

        </div>
        <div class="col-xl-2 mb-2">
            <a class="no-anchor-style" href="/admin/user/{{$order->customer_id}}">
            <div class="bg-white shadow roundy p-4 h-50 d-flex align-items-center justify-content-between">
              <div class="flex-grow-1 d-flex align-items-center">
                <div class="dot mr-3 bg-gray-500"></div>
                <div class="text">
                  <span class="mb-0 text-sm text-blue">Client Details</span>
                </div>
              </div>
            </div>
            </a>
        </div>
        @if ($order->writer_id)
        <div class="col-xl-2 mb-2">
            <a class="no-anchor-style" href="/admin/user/{{$order->writer_id}}">
            <div class="bg-violet shadow roundy p-4 h-50 d-flex align-items-center justify-content-between">
              <div class="flex-grow-1 d-flex align-items-center">
                <div class="text-white"><i class="fa fa-user mr-3"></i></div>
                <div class="text">
                  <span class="mb-0 text-white text-sm text-capitalize">Writer Details</span>
                </div>
              </div>
            </div>
            </a>
        </div>
        @else
        <div class="col-xl-2 mb-2">
            <div class="bg-violet shadow roundy p-4 h-50 d-flex align-items-center justify-content-between">
              <div class="flex-grow-1 d-flex align-items-center">
                <div class="dot mr-3 bg-white"></div>
                <div class="text">
                  <span class="mb-0 text-white text-sm">Unassigned</span>
                </div>
              </div>
            </div>
        </div>
        @endif
        <div class="col-xl-2 mt-2">
            @if ($order->order_status == 0)
                @if($order->payment_status == 1)
                    <div class="text-right ml-5">
                        <button id="manageOrder" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-dark">Manage</button>
                            <div aria-labelledby="userInfo" class="dropdown-menu">
                                <a id="{{$order->id}}" href="#" class="activate-bidding dropdown-item">Activate Bidding</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#writers">Assign Writer</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#rejectOrder">Reject Order</a>
                            </div>
                    </div>
                @else
                    <div class="flex-grow-1 d-flex align-items-center">
                        <button id="{{$order->id}}" class="btn btn-dark ask-payment" type="button">Request Pay?</button>
                    </div>
                @endif
            @elseif ($order->order_status == 1)
                @if($order->confirmation)
                    <small class="bg-warning shadow roundy p-3 text-dark"><strong>Awaiting Writer Done</strong></small>  
                @else
                    <small class="bg-warning shadow roundy p-3 text-dark"><strong>Awaiting Acceptance</strong></small>
                @endif
            @elseif ($order->order_status == 2)
            <div class="flex-grow-1 d-flex align-items-center">
                <button class="btn btn-dark" type="button">Contact Client</button>
            </div>
            @elseif ($order->order_status == 3)
            <div class="flex-grow-1 d-flex align-items-center">
                    <form method="POST" action="/order/deliver/{{$order->id}}">
                        @csrf
                        <button class="btn btn-dark" type="submit">Deliver Paper</button>
                    </form>
                </div>     
            @elseif ($order->order_status == 4)
            <small class="bg-warning shadow roundy p-3 text-dark"><strong>Awaiting approval</strong></small>  
            @elseif ($order->order_status == 5)
            <div class="text-right ml-5">
                <button id="doneOptions" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-dark">Manage</button>
                    <div aria-labelledby="doneOptions" class="dropdown-menu">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#setRevision">Set on Revision</a>
                        <div class="dropdown-divider"></div>
                        <p id="{{$order->id}}" class="deliverIntent dropdown-item">Deliver to Client</p>
                    </div>
            </div>
            @elseif ($order->order_status == 6)
                    @if ($reviewCount)
                        <div class="text-center text-muted text-sm"><strong>Rating of {{$review->rating}} out of 5</strong></div>
                        <div class="text-center">
                                  @if ($review->rating == "0")
                                <div class="text-center">
                                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
                                </div>
                                @elseif ($review->rating == "1")
                                <div class="text-center">
                                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
                                </div>
                                @elseif ($review->rating == "2")
                                <div class="text-center">
                                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
                                </div>
                                @elseif ($review->rating == "3")
                                <div class="text-center">
                                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
                                </div>
                                @elseif ($review->rating == "4")
                                <div class="text-center">
                                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-gray-400 fa fa-star"></i>
                                </div>
                                @elseif ($review->rating == "5")
                                <div class="text-center">
                                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
			        	                    <i class="text-warning fa fa-star"></i>
                                </div>
                                @endif
                        </div>
                    @else
                    <small class="bg-warning shadow roundy p-3 text-dark"><strong>No Client Rating</strong></small>
                    @endif
            @elseif ($order->order_status == 8)
            <div class="flex-grow-1 d-flex align-items-center">
                <button class="btn btn-dark" type="button" onclick="window.location='/admin/bids/{{$order->id}}'">View Bids <i class="fa fa-gavel ml-2"></i></button>
            </div>
            @elseif ($order->order_status == 9)
            <div class="text-right">
                <button class="btn btn-dark" type="button"><i class="fas fa-align-right"></i></button>
            </div>
            @endif
        </div>
    </div>
    
    <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#instructions" role="tab" aria-controls="pills-home" aria-selected="true">Instructions</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#messages" role="tab" aria-controls="pills-profile" aria-selected="false">Messages @if ($messageCount !=0 ) <div class="badge badge-pill badge-blue px-2 py-1">{{$messageCount}}</div> @endif</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#files" role="tab" aria-controls="pills-contact" aria-selected="false">Files @if ($fileCount !=0 ) <div class="badge badge-pill badge-blue px-2 py-1">{{$fileCount}}</div> @endif</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="instructions" role="tabpanel" aria-labelledby="pills-home-tab">
          @include ('main.admin.partials.instructions')
      </div>
      <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="pills-profile-tab">
          @include ('main.admin.partials.messages')
      </div>
      <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="pills-contact-tab">
          @include ('main.admin.partials.files')
      </div>
    </div>

    @include ('main.admin.modals.writers')
    @include ('main.admin.modals.reject-order')
    @include ('main.admin.modals.set-revision')
    
</section>

@endsection

@section ('scripts')
<script src="{{URL::asset('js/admin-details.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
<script src="{{asset('libs/jquery-confirm/jquery-confirm.min.js')}}"></script>
<script src="{{asset('js/admin-messaging.js')}}"></script>
<script src="{{asset('js/create-messages.js')}}"></script>

<script type="text/javascript">

    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
    });
      
    function allowAccess(){
        let id = $("a.allow-access").attr("id");
        $.ajax({
            url: "/allow-file-access/"+id,
            method: "post",
            dataType: "json",
            success: function(response){
                if(response["success"]){
                    new Noty({
                            text: "<div class='roundy'>"+response["message"]+"</div>",
                            type   : 'information',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                    }).show();
                    setTimeout(function () {
                            location.reload();
                    }, 3000);
                }else{
                    new Noty({
                            text: "<div class='roundy'>Sorry, some error has occurred while changing this file access to writers. Try again later.</div>",
                            type   : 'error',
                            theme  : 'metroui',
                            layout : 'topRight',
                            timeout: 2000
                    }).show();
                }
            }
        });
    }

</script>
@endsection