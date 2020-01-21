@extends ('layouts.main')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/noty/noty.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.customer.none')

@endsection


@section ('content')

<section>
    <div class="row">
        <div class="col-xl-8 mb-4 text-left">
            <div class="text-uppercase mb-1 text-muted h5">Order #{{$id}}</div>
                @php
                    $status = $order->order_status;
                    switch ($status)
                        {
                            case 0:
                @endphp
                    @if ($order->payment_status == 0)
                        <div class="badge badge-red px-2 py-1">Unpaid</div>
                    @else
                        <div class="badge badge-red px-2 py-1">Unassigned</div>
                    @endif
                @php
                            break;
                            case 1:
                @endphp
                    <div class="badge badge-orange px-2 py-1">Assigned</div>
                @php
                            break;
                            case 2:
                @endphp
                    <div class="badge badge-gray-500 px-2 py-1 text-dark">Cancelled</div>
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
                    <div class="badge badge-dark px-2 py-1 text-white">Unassigned</div>
                @php
                            break;
                            case 9:
                @endphp
                    <div class="badge badge-red px-2 py-1 text-white">Rejected</div>
                @php
                        }
                @endphp
                <span class="text-muted ml-2">{{$order->topic}}</span> 
            </div>

                <div class="col-xl-4 mt-2 text-right">
                    @if ($order->order_status == 0)
                        @if ($order->payment_status == 0)
                        <div class="row">
                            <div class="col-sm-8 text-right"> 
                                <form method="POST" action="/pay/order/{{$order->id}}">
                                    @csrf
                                    <input class="form-control hidden" name="amount" value="{{$order->price_amount}}">
                                    <input class="form-control hidden" name="order_topic" value="{{$order->topic}}">
                                    <input class="form-control hidden" name="order_subject" value="{{$order->subject}}">
                                    <button id="pay-order" class="btn btn-dark" type="submit">Pay <i class="fa fa-credit-card ml-2"></i></button>
                                </form>
                            </div>
                            <div class="col-sm-4">
                                <button id="{{$order->id}}" class="btn btn-dark cancel-btn" type="button">Cancel</button>
                            </div>
                        </div>
                        @else 
                            <button class="btn btn-dark" type="button" onclick="window.location='https://tawk.to/chat/5db59bb5df22d91339a14dcf/default'" target="blank">Support <i class="fa fa-support ml-2"></i></button>
                        @endif
                    @elseif ($order->order_status == 1)
                            <button class="btn btn-dark" type="button" onclick="window.location='https://tawk.to/chat/5db59bb5df22d91339a14dcf/default'" target="blank">Support <i class="fa fa-support ml-2"></i></button>
                    @elseif ($order->order_status == 2)
                        @if ($order->payment_status == 1)
                            <button class="btn btn-dark" type="button">Ask Refund <i class="fa fa-credit-card ml-2"></i></button>
                        @else
                            <button id="{{$order->id}}" class="btn btn-dark restore-btn" type="button">Restore Order <i class="fa fa-refresh ml-2"></i></button>
                        @endif
                    @elseif ($order->order_status == 3)
                        <button class="btn btn-dark" type="button">Support <i class="fa fa-support ml-2"></i></button>  
                    @elseif ($order->order_status == 4) 
                    <button id="manageOrder" class="btn btn-dark" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Proceed</button>
                                <div aria-labelledby="userInfo" class="dropdown-menu">
                                    <p id="{{$order->id}}" class="approveIntent dropdown-item">Approve</p>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#setRevision">Request Revision</a>
                                </div>
                    @elseif ($order->order_status == 5)
                        <button class="btn btn-dark" type="button">Support <i class="fa fa-support ml-2"></i></button>
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
                            <button class="btn btn-gray-400" type="button"  data-toggle="modal" data-target="#setRevision">More Revision?</button>
                            <button class="btn btn-dark ml-2" type="button" data-toggle="modal" data-target="#review">Your Review <i class="fa fa-comments ml-2"></i></button>
                        @endif
                    @elseif ($order->order_status == 8)
                        <small class="bg-dark shadow roundy p-3 text-white"><strong>We are reviewing your order.</strong></small>
                    @elseif ($order->order_status == 9)
                        @if($order->payment_status)
                            <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#review">Ask for Refund</button>
                        @else
                            <button class="btn btn-dark" type="button">Support <i class="fa fa-support ml-2"></i></button>
                        @endif
                    @endif
                </div>
    </div>

    @if ($order->order_status == 0)
        @if ($order->payment_status == 0)
            <div class="row mt-3 mb-4">
                <div class="col-sm-12 danger-card bg-white shadow roundy p-4 text-muted text-sm">
                    <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                        <div class="dot mr-3 bg-red"></div>
                        <div class="text-muted">Order is unpaid. Be notified, that we will assign a new deadline for your paper based on the time payment is processed. The earlier you pay, the better.</div>
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-3 mb-4">
                <div class="col-sm-12 dark-card bg-white shadow roundy p-4 text-muted text-sm">
                    <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                        <div class="dot mr-3 bg-dark"></div>
                        <div class="text-muted">Thank you for placing an order. We will immediately find the most suitable writer to fulfill your order. Thanks for your patience.</div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @if ($order->order_status == 8)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 dark-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-dark"></div>
                    <div class="text-muted">Thank you for placing an order. We will immediately find the most suitable writer to fulfill your order. Thanks for your patience.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 1)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 orange-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-orange"></div>
                    <div class="text-muted">A writer has been assigned to write your paper. You can contact the writer by writing to them a message, or live chat with support.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 2)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 dark-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-gray-500"></div>
                    <div class="text-muted">You cancelled this order. Please note if you had made payment, you will be refunded. Otherwise, you can still restore the order to active.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 3)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 orange-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-orange"></div>
                    <div class="text-muted">Your order is ready. However, we are revising the paper to guarantee the best quality possible. Once revision is done, you will receive the paper.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 4)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 violet-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-violet"></div>
                    <div class="text-muted">Your order is ready. Check the files section to review. Once satisfied, click proceed and approve to download. If you feel it needs revision, set the order on revision.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 5)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 dark-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-dark"></div>
                    <div class="text-muted">The writer has completed the paper. Now, our quality team is reviewing the work to ensure instructions are followed, and the paper is plagiarism free.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 6)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 success-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-success"></div>
                    <div class="text-muted">Your paper is finished. It means, you've approved the final paper. You can send us feedback and rate our services to help us improve. Thank you!</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 9)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 danger-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-red"></div>
                    <div class="text-muted">Unfortunately, we are unable to meet your order request. We are so sorry. Please know we rarely reject orders. You can place a new order anytime, and we'll be happy to deliver.</div>
                </div>
            </div>
        </div>
    @endif
    
    <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#instructions" role="tab" aria-controls="pills-home" aria-selected="true">Instructions</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#messages" role="tab" aria-controls="pills-profile" aria-selected="false">Messages @if ($messageCount !=0 ) <div class="badge badge-pill badge-blue px-2 py-1">{{$messageCount}}</div> @endif </a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#files" role="tab" aria-controls="pills-contact" aria-selected="false">Files @if ($orderFileCount !=0 ) <div class="badge badge-pill badge-blue px-2 py-1">{{$orderFileCount}}</div> @endif</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="instructions" role="tabpanel" aria-labelledby="pills-home-tab">
          @include ('main.customer.partials.instructions')
      </div>
      <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="pills-profile-tab">
          @include ('main.customer.partials.messages')
      </div>
      <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="pills-contact-tab">
          @include ('main.customer.partials.files')
      </div>
    </div>

    
    @include ('main.customer.modals.set-revision')
    @include ('main.customer.modals.review')
    
</section>
@endsection

@section ('scripts')

<script src="{{asset('/libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('libs/noty/noty.min.js')}}"></script>
<script src="{{asset('js/admin-details.js')}}"></script>
<script src="{{asset('js/create-messages.js')}}"></script>
<script src="{{asset('js/customer-messaging.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
<script src="{{asset('libs/jquery-confirm/jquery-confirm.min.js')}}"></script>

@endsection