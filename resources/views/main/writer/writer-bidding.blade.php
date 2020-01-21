@extends ('main.writer.partials.main-writer')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.writer.bids')

@endsection


@section ('content')

    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">My Bids</h5>
					<small>Orders that you've bid for. You will only see bids for available orders. Then you can manage your bids.</small>
				</div>
				<div class="card-body">
				@if ($writerBiddingCount)
					<table id="bidding-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-sm text-muted h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">CPP</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($ordersBidding as $order)
									<tr id="{{$order->id}}" onclick="window.location='/writer/order-details/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-dark"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Bid placed</div>
													<small class="text-gray-400 text-sm mt-1">{{"#".$order->id}}</small>
												</div>
											</div>
										</td>
										<td>
											<div class="text-muted">{{$order->topic}}</div>
											<input class="hidden" name="paper" value="{{$order->paper_type}}">
											<small class="paper-type text-gray-400 text-sm mt-1">
												@php 
													$index = $order->paper_type;
													$documentName = $documents[$index-1];
													echo $documentName;
												@endphp
											</small>
										</td>
										<td>
											<div class="text-muted">{{$order->subject}}</div>
											<input id="{{$order->id}}" class="hidden" name="academic" value="{{$order->academic_level}}">
											<small class="academic-level text-gray-400 text-sm mt-1">
												@php 
													$academicLevel = $order->academic_level;
													switch($academicLevel){
														case "45":
															echo "High School";
														break;
														case "46":
															echo "Undergraduate (Years 1-2)";
														break;
														case "47":
															echo "Undergraduate (Years 3-4)";
														break;
														case "48":
															echo "Masters";
														break;
														case "49":
															echo "Doctoral";
														break;
													}
												@endphp
											</small>
										</td>
										<td>
											<div class="text-muted text-center">{{$order->pages}}</div>
										</td>
										<td id="{{$order->id}}" class="text-center deadline">
											<input type="img" class="hidden" name="deadline" value="{{$order->writer_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td class="text-center">
											<div class="text-gray-400">
											@php
												$cost = $order->writer_amount;
												$pages = $order->pages;

												if ($pages > 0):
													$cpp = $cost/$pages;
													echo "$".number_format((float)$cpp,2,'.','');
												else:
													echo "$0.00";
												endif;

											@endphp
											</div>
										</td>
										<td><div class="text-muted">{{"$".number_format((float)$order->writer_amount,2,'.','')}}</div></td>
									</tr>
								@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
		@else
		<div class="col-lg-12 text-center">
    	    <i class="fa fa-gavel text-gray-300 msg-icon mb-4"></i>
    	    <p class="h6 text-gray-400">You currently have no bids on available orders.</p>
  		</div>
		@endif
    </div>

@endsection

@section ('scripts')
<script src="{{asset('/libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/libs/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{URL::asset('js/admin-main.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
@endsection