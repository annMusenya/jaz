@extends ('main.admin.partials.main-admin')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.admin-sidebar.none')

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
    </div>

    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Bids</h5>
					<small>Assign a writer to this order.</small>
				</div>
				<div class="card-body">
				 @if ($order->order_status == "8")
					<table id="bids-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-sm h6 text-muted">
									<td>Writer</td>
									<td>Email</td>
									<td>Phone</td>
									<td class="text-center">Rating</td>
									<td class="text-right">Assign</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($bids as $bid)
								<tr id="{{$bid->id}}">
                                <td>
                                    <div class="text-muted text-capitalize">{{$bid->writer_name}}</div>
								</td>
                                <td>
                                    <div class="text-muted">{{$bid->writer_email}}</div>
								</td>
                                <td>
                                    <div class="text-muted">{{$bid->writer_phone}}</div>
								</td>
                                <td>
								@if ($bid->writer_rating == "0")
                      			<div class="text-center">
                      			    <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
                      			</div>
                      			@elseif ($bid->writer_rating == "1")
                      			<div class="text-center">
                      			    <i class="text-warning fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
                      			</div>
                      			@elseif ($bid->writer_rating == "2")
                      			<div class="text-center">
                      			    <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
                      			</div>
                      			@elseif ($bid->writer_rating == "3")
                      			<div class="text-center">
                      			    <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
                      			</div>
                      			@elseif ($bid->writer_rating == "4")
                      			<div class="text-center">
                      			    <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-gray-400 fa fa-star"></i>
                      			</div>
                      			@elseif ($bid->writer_rating == "5")
                      			<div class="text-center">
                      			    <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
				      			            <i class="text-warning fa fa-star"></i>
                      			</div>
                      			@endif
								</td>
                                <td class="text-right">
									<form action="/admin/assign/{{$order->id}}" method="POST">
										@csrf
										<input class="form-control hidden" name="id" value="{{$bid->writer_id}}">
										<input class="form-control hidden" name="name" value="{{$bid->writer_name}}">
                                    	<button class="btn btn-primary btn-sm">Assign</button>
									</form>
								</td>
								</tr>
                                @endforeach
							</tbody>
					</table>
					@else
					<div class="row">
    				    <div class="col-lg-12 text-center">
    				        <i class="fa fa-smile text-gray-200 msg-icon mb-4"></i>
    				        <p class="h4 text-gray-500">This order is not available for bidding.</p>
    				    </div>
    				</div>
					@endif
				</div>
			</div>
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
<script src="{{URL::asset('js/admin-main.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
@endsection