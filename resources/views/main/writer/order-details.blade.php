@extends ('main.writer.partials.main-writer')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/noty/noty.css')}}">


@endsection

@section ('sidebar')

@include ('layouts.sidebar.writer.none')

@endsection


@section ('content')

<section>
<input name="order_id" class="hidden" value="{{$order->id}}">
<input name="writer_id" class="hidden" value="{{$userId}}">
    <div class="row">
        <div class="col-xl-8 mb-4 text-left">
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
                    <div class="badge badge-success px-2 py-1">Assigned</div>
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
                    @if ($isBidPlaced) <div class="badge badge-dark px-2 py-1 text-white">Unassigned</div> @else <div class="badge badge-green px-2 py-1 text-muted">Available</div> @endif
                @php
                        }
                @endphp
                <span class="text-muted ml-2">{{$order->topic}}</span> 
        </div>

        @if ($order->payment_status == 0 && $order->order_status != 8 && $order->order_status != 9)
                <div class="col-xl-4 mt-2 text-right">
                        <small class="bg-red shadow roundy p-3 text-white"><strong>We are reviewing your order.</strong></small>
                </div>
        @else 
            <div class="col-xl-2 mt-2 text-right"></div>
            <div class="col-xl-2 mt-2 text-right">
                @if ($order->order_status == 1)
                        @if($order->confirmation)
                        <div class="flex-grow-1 d-flex align-items-center">
                        <button id="orderManage" class="btn btn-dark" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Proceed</button>
                            <div aria-labelledby="userInfo" class="dropdown-menu">
                                <p id="{{$order->id}}" class="reassignIntent dropdown-item">Reassign Order</p>
                                <div class="dropdown-divider"></div>
                                <p id="{{$order->id}}" class="doneIntent dropdown-item">Submit as Done</p>
                            </div>
                        </div>
                        @else
                            <button id="acceptOrder" class="btn btn-dark" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Accept Job</button>
                                <div aria-labelledby="userInfo" class="dropdown-menu">
                                    <p id="{{$order->id}}" class="acceptIntent dropdown-item">Accept Job</p>
                                    <div class="dropdown-divider"></div>
                                    <p id="{{$order->id}}" class="rejectIntent dropdown-item">Reject Job</p>
                                </div>
                        @endif
                @elseif ($order->order_status == 3)
                <div class="flex-grow-1 d-flex align-items-center">
                    <form method="POST" action="/writer/revised/{{$order->id}}">
                        @csrf
                        <button class="btn btn-dark" type="submit">Revised <i class="fa fa-check-circle ml-2"></i></button>
                    </form>
                </div>
                @elseif ($order->order_status == 4 || $order->order_status == 5)
                    <small class="bg-warning shadow roundy p-3 text-dark"><strong>Awaiting approval</strong></small>  
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
                    @if($bidding)
                        <small class="bg-dark shadow roundy p-3 text-white"><i class="fa fa-check mr-2"></i><strong>Bid is Placed.</strong></small>
                    @else
                        <form action="/writer/bid" method="POST">
                            @csrf
                            <input class="form-control hidden" name="writer" value="{{$userId}}">
                            <input class="form-control hidden" name="order" value="{{$order->id}}">
                            <input class="form-control hidden" name="name" value="{{$userDetails['name']}}">
                            <input class="form-control hidden" name="email" value="{{$userDetails['email']}}">
                            <input class="form-control hidden" name="phone" value="{{$userDetails['phone']}}">
                            <input class="form-control hidden" name="rating" value="{{$userDetails['rating']}}">
                            <button class="btn btn-dark" type="submit">Bid<i class="fa fa-gavel ml-2"></i></button>
                        </form>
                    @endif
                @endif
            </div>
        @endif
    </div>

    @if ($order->order_status == 8 && $bidding)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 dark-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-dark"></div>
                    <div class="text-muted">You've placed a bid for this order. We will review your bid and decide whether you will fulfill this order.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 1)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 success-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-md-left">
                    <div class="dot mr-3 bg-success"></div>
                    <div class="text-muted text-smz">We have decided to award you this job. But first, make sure you click accept job button. Also, follow the writing instructions strictly. Click done, once you've uploaded the customer-ready document. If you need help, contact support.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 5)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 dark-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-md-left">
                    <div class="dot mr-3 bg-dark"></div>
                    <div class="text-muted">Thank you for completing the job. We are reviewing the paper for plagiarism and writing quality. We will notify you if the paper needs further revision. Otherwise, the paper will be sent to customer for approval.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 3)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 warning-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-md-left">
                    <div class="dot mr-3 bg-warning"></div>
                    <div class="text-muted">We have determined that your paper requires revision. See the the "Paper Revision" section for instructions and reason. You are required to revise the paper, then submit a refined copy of the paper. Once done, click "Revised" button to submit.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 4)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 violet-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-md-left">
                    <div class="dot mr-3 bg-violet"></div>
                    <div class="text-muted">Your submission meets our quality standards. We have forwarded it to the customer for final approval. Once approved by the customer, your job will be considered done and the order will be marked as finished.</div>
                </div>
            </div>
        </div>
    @endif

    @if ($order->order_status == 6)
        <div class="row mt-3 mb-4">
            <div class="col-sm-12 success-card bg-white shadow roundy p-4 text-muted text-sm">
                <div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
                    <div class="dot mr-3 bg-success"></div>
                    <div class="text-muted">Well done. Your work was approved by the customer. Thank you for completing the order. Check your payment section for your earnings.</div>
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
          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#files" role="tab" aria-controls="pills-contact" aria-selected="false">Files @if ($fileCount !=0 ) <div class="badge badge-pill badge-blue px-2 py-1">{{$fileCount}}</div> @endif</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="instructions" role="tabpanel" aria-labelledby="pills-home-tab">
          @include ('main.writer.partials.instructions')
      </div>
      <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="pills-profile-tab">
          @include ('main.writer.partials.messages')
      </div>
      <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="pills-contact-tab">
          @include ('main.writer.partials.files')
      </div>
    </div>
    
</section>
@endsection

@section ('scripts')
<script src="{{asset('/libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/libs/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{URL::asset('js/admin-details.js')}}"></script>
<script src="{{asset('js/create-messages.js')}}"></script>
<script src="{{asset('libs/jquery-confirm/jquery-confirm.min.js')}}"></script>
<script src="{{asset('js/messaging.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
@endsection