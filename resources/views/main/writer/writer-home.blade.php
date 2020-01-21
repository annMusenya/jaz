@extends ('main.writer.partials.main-writer')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.writer.order')

@endsection


@section ('content')

<section>
    <div class="row">
        <div class="col-lg-6 mb-4 text-left">
            <h5 class="h5 text-uppercase mb-1 text-muted">Available Orders</h5>
            <small class="text-muted">Bid to get assigned papers in order to write and earn.</small>
        </div>
    </div>

    @if ($availableCount)
    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Available Orders({{$availableCount}})</h5>
					<small>Orders that are available for bidding. Click on an order to read instruction details and bid.</small>
				</div>
				<div class="card-body">
					<table id="available-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td>CPP</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($availableOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/writer/order-details/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-green"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Available</div>
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
											<input type="text" class="hidden" name="deadline" value="{{$order->writer_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td>
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
    </div>

    @endif
    
    @if ($availableCount == 0)
	
	<div class="col-lg-12 text-center">
        <i class="o-document-1 text-gray-300 msg-icon mb-4"></i>
        <p class="h6 text-gray-400">There are no available jobs for bidding.</p>
    </div>

	@endif

</section>
@endsection

@section ('scripts')
<script src="{{asset('/libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/libs/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{URL::asset('js/writer-orders.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
@endsection