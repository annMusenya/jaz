<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h2 class="h6 mb-0 text-uppercase text-muted">Order Details</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="left d-flex align-items-center">
                            <div class="text">
                                  <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Title:</span></p>
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
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Cost:</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-muted">
                            <h6 class="text-sm text-blue">{{"$".number_format((float)(($order->price_amount)),2,'.','')}}</h6>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-3">
                        <div class="left d-flex align-items-center">
                            <div class="text">
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Payment Status:</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-muted">
                                @if($order->payment_status == 0)
                                    <h6 class="text-sm text-danger">Unpaid <i class="fas fa-times-circle ml-1"></i></h6>
                                @else
                                    <h6 class="text-sm text-violet">Paid <i class="fa fa-check-circle ml-1"></i></h6>
                                @endif
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
                            <input class="hidden" name="deadline" value="{{$order->deadline_period}}">
                            <h6 id="deadline" class="text-sm text-primary"></h6> 
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <div class="left d-flex align-items-center">
                            <div class="text">
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Timezone:</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-muted">
                            <h6 id="deadline" class="text-sm">{{$order->timezone}}</h6> 
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <div class="left d-flex align-items-center">
                            <div class="text">
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Academic Level:</span></p>
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
                                        echo("Undergraduate (years 1-2)");
                                    break;
                                    case 47:
                                        echo("Undergraduate (years 3-4)");
                                    break;
                                    case 48:
                                        echo("Masters");
                                    break;
                                    case 49:
                                        echo("Doctoral");
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
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Writer Category:</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-muted">
                            <h6 class="text-sm text-blue text-capitalized">{{$order->writer_category}}</h6>  
                        </div>
                    </div>
                </div>

                @if ($order->powerpoint)
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <div class="left d-flex align-items-center">
                            <div class="text">
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Slides:</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-muted">
                            <h6 class="text-sm">{{$order->powerpoint. " PPT Slides"}}</h6>  
                        </div>
                    </div>
                </div>
                @endif
				
				
				@if ($order->charts)
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <div class="left d-flex align-items-center">
                            <div class="text">
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Charts:</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-muted">
                            <h6 class="text-sm">{{$order->charts. " Charts"}}</h6>  
                        </div>
                    </div>
                </div>
                @endif

                @if ($order->samples == 1)
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <div class="left d-flex align-items-center">
                            <div class="text">
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Writer Samples:</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-muted">
                            <h6 class="text-sm">Attach 3 writer samples</h6>  
                        </div>
                    </div>
                </div>
                @endif

                @if ($order->copy_sources == 1)
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <div class="left d-flex align-items-center">
                            <div class="text">
                              <p class="mb-0 d-flex align-items-center text-muted text-sm"><span>Copy of Sources:</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="text-muted">
                            <h6 class="text-sm">Attach copy of sources used</h6>  
                        </div>
                    </div>
                </div>
                @endif

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

    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                <h2 class="h6 mb-0 text-uppercase text-muted">Paper Instructions</h2>
            </div>
            <div class="card-body">
                @if ($order->instructions)
                    <div class="text-muted text-sm">{{$order->instructions}}</div>
                @else
                    <div class="file-icon text-center"><i class="fa fa-warning text-gray-300"></i></div>
                    <div class="text-gray-400 text-center">No instructions provided.</div>
                @endif
            </div>
        </div>
        @if ($order->comments)
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="h6 mb-0 text-uppercase text-muted">Reported Issues</h2>
            </div>
            <div class="card-body">
                @if ($order->comments)
                    <div class="text-muted">{{$order->comments}}</div>
                @else
                    <div class="file-icon text-center"><i class="fa fa-warning text-gray-300"></i></div>
                    <div class="text-gray-400 text-center">No instructions problems reported.</div>
                @endif
            </div>
        </div>
        @endif

        @if ($order->revision_reason)
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="h6 mb-0 text-uppercase text-muted">Paper Revision</h2>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-lg-12"><p class="text-primary text-uppercase"><strong class="text-primary text-sm"><i class="fa fa-bookmark mr-2"></i>{{$order->revision_reason}}</strong></p></div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><p class="text-gray-500 text-sm">{{$order->revision}}</div>
                </div>
            </div>
        </div>
        @endif

        @if ($order->rejection_reason)
        <div class="card mt-4">
            <div class="card-header">
                <h2 class="h6 mb-0 text-uppercase text-muted">Why is this paper rejected?</h2>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-lg-12"><p class="text-primary text-uppercase"><strong class="text-primary ml-2">{{$order->rejection_reason}}</strong></p></div>
                </div>
                <div class="row">
                    <div class="col-lg-12"><p class="text-gray-500">{{$order->rejection}}</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>