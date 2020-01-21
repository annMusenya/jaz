<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-8 py-2">
                        <h2 class="h6 mb-0 text-uppercase text-muted">Messages</h2>
                    </div>
                    <div class="col-lg-4 text-right">
                        @if($order->order_status == 0 || $order->order_status == 1 || $order->order_status == 4 || $order->order_status == 8 || $order->order_status == 5 )<button class="btn btn-gray-500 text-right" type="button" data-toggle="modal" data-target="#create-message">New Message</button> @endif
                        @include('main.writer.modals.create-message')
                    </div>
                </div>
            </div>
            <div class="card-body">
                    @if (empty($messageCount))
                        <div class="file-icon text-center"><i class="fa fa-comments-o text-gray-300"></i></div>
                        <div class="text-gray-400 text-center mb-5">No messages created or shared for this order.</div>
                    @else
                                @foreach ($messages as $message)
                                    <div class="msg-accordion px-4 py-3 d-flex align-items-center justify-content-between mb-3 roundy bg-gray-100 row" data-toggle="collapse" href="#messageContent{{$message->id}}" role="button" aria-expanded="false" aria-controls="messageContent">
                                    <div class="icon bg-dark text-white"><i class="fas fa-envelope"></i></div>
                                    <div class="flex-grow-1 d-flex align-items-center">
                                        @if ($message->category == 1)
                                            <div class="text ml-3">
                                                <span class="text-muted mb-0 text-capitalize text-sm"><strong>{{'Support'}}</strong></span>
                                            </div>
                                        @elseif ($message->category == 2)
                                            <div class="text ml-3">
                                                <span class="h6 text-muted mb-0 text-capitalize text-sm"><strong>{{'Me'}}</strong></span>
                                            </div>
                                        @else
                                            <div class="text ml-3">
                                                <span class="h6 text-muted mb-0 text-capitalize text-sm"><strong>{{'Customer'}}</strong></span>
                                            </div>
                                        @endif
                                        <div class="text">
                                            <div class="icon text-gray-500"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                      
                                        <div class="text ml-1">
                                            <span class="text-muted mb-0 text-capitalize text-sm">
                                                <strong>
                                                    @if($message->recipient == "writer")
                                                        {{'Me'}}
                                                    @else
                                                        {{$message->recipient}}
                                                    @endif
                                                </strong>
                                            </span>
                                        </div>

                                        <div class="text ml-4">
                                            <p class="mb-0 text-muted text-capitalize text-sm">Order #{{$message->order_id}} :</p>
                                        </div>

                                        <div class="text ml-4">
                                            <p class="mb-0 text-primary h6 text-sm">{{$message->subject}}</p>
                                        </div>              
                                    </div>
                                    <div class="text ml-3">
                                        <p class="mb-0 text-muted text-sm text-link" onclick="javascript:window.location.href='/orders/{{$message->order_id}}'"><strong>{{"#".$message->order_id}}</strong></p>
                                    </div>
                                    <div class="text ml-3">
                                        <p class="mb-0 text-muted text-sm"> {{$message->created_at->format("M d, Y, g:ia")}}</p>
                                    </div>
                                    <div class="text ml-2">
                                        <div class="icon text-gray-400"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>
                                <div class="msg-collapse collapse mb-2 mt-3" id="messageContent{{$message->id}}">
                                    <div class="col-sm-12">
                                            <div class="text">
                                                <p class="text-muted"><strong class="ml-3 text-primary">{{$message->subject}}</strong></p>
                                            </div>
                                            <div class="text">
                                                <textarea class="form-control text-sm message-textarea" readonly>{{$message->message}}</textarea>
                                            </div>
                                    </div> 
                                    <!-- Reply Message -->
                                    <div class="col-sm-6">
                                        @include('main.writer.modals.reply-message')
                                        <!-- <button class="btn btn-dark text-sm" data-toggle="modal" data-target="#reply-message-{{$message->id}}"><i class="fas fa-reply mr-2"></i>Reply</button> -->
                                    </div>  
                                    <!-- End Reply Message -->
                                </div>
                                @endforeach

                    @endif
            </div>
        </div>
    </div>
</div>

