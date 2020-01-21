<div class="col-lg-8 mb-4 text-left">
        <h5 class="h5 text-uppercase mb-1 text-muted">Paper Order #{{$id}}
        <div class="badge badge-primary px-2 py-1">
        @php
            $status = $order->order_status;
            switch ($status)
                {
                    case 0:
                        echo("Pending");
                    break;
                    case 1:
                        echo("Active");
                    break;
                    case 2:
                        echo("Finished");
                    break;
                    case 3:
                        echo("Cancelled");
                    break;
                    case 4:
                        echo("Revision");
                }
        @endphp
        </div>
        </h5>
        <small>Manage this order and download your paper when it's ready and finished.</small>
</div>
<div class="col-lg-4 mb-4 text-right">
    @if ($order->order_status == 5)
    <button class="btn btn-dark btn-sm" type="button" data-toggle="modal" data-target="#revision">Set to Revision</button>
    <button class="btn btn-dark btn-sm" type="button" data-toggle="modal" data-target="#dispute">Dispute Order</button>

    @include ('main.customer.modals.dispute')
    @include ('main.customer.modals.revision')
    
    @endif
</div>

<div class="row">
        <div class="col-lg-6">
            <div class="card">
                  <div class="card-header">
                    <h2 class="h6 mb-0 text-uppercase">Order Details</h2>
                  </div>
                  <div class="card-body">
                    <p class="text-gray mb-4 text-sm">These are the writing instructions you provided when placing the order. To change these instructions, contact support team.</p>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Topic:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">{{$order->topic}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Level:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">
                                @php 
                                $academic_level = $order->academic_level;
                                switch ($academic_level)
                                    {
                                        case 45:
                                            echo("High School");
                                        break;
                                        case 46:
                                            echo("Undergraduate");
                                        break;
                                        case 47:
                                            echo("Undergraduate");
                                        break;
                                        case 48:
                                            echo("Masters and Graduate");
                                        break;
                                        case 49:
                                            echo("Doctoral and PhD");
                                    }
                                @endphp
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Document:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">
                                    @php
                                        $document = $order->paper_type;
                                        $array = ["","Essay (any type)","Research Papers","Coursework","Discussion Essay","Admission Essay","Analysis (any type)","Annotated Bibliography","Argumentative Essays","Article Review","Assignment","Blog Post","Book/Movie Review","Business Plan","Capstone Project","Case Study","College Essays","Creative Writing","Creative Thinking","Dissertation","Homework","Journal Article","Lab Report","Literature Analysis","Memo/Letter","Outline","Personal Reflection","Poem","Presentation/PPT","Project","Question Answer","Reflection Essay","Report (any type)","Research Proposal","See paper instructions","Speech","Summary","Term Paper","Thesis/Thesis Chapter","Other"];
                                        echo ($array[$document]);
                                    @endphp
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Subject:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">{{$order->subject}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Pages:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">
                                @php
                                    $spacing = $order->word_spacing;
                                    $pages = $order->pages;
                                    echo ($pages." pages,  ".$spacing." spaced.");
                                @endphp    
                            </div>
                        </div>
                    </div>
                    @if($order->instructions)
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Instructions:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">{{$order->instructions}}</h6>  
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Style:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">{{$order->citation}}</h6>  
                            </div>
                        </div>
                    </div>
                    @if ($order->references != 0)
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Sources:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">{{$order->references}}</h6>  
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Writer:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">{{$order->assigned_writer}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Deadline:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">{{$order->deadline_period}}</h6>  
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-3">
                            <div class="left d-flex align-items-center">
                                <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Order Placed:</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="text-muted">
                                <h6 class="text-sm">
                                    @php
                                        $date = $order->created_at;
                                        echo ($date->diffForHumans());
                                    @endphp
                                </h6>  
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>