@extends ('layouts.main')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.customer.order')

@endsection


@section ('content')

<section>
    <div class="row">
        <div class="col-lg-6 mb-4 text-left">
            <h5 class="h5 text-uppercase mb-1 text-muted">Manage all orders</h5>
            <small class="text-muted">Manage all customer orders, assign writers and change order status.</small>
        </div>
    </div>
	<!-- Pending Orders -->

	@if ($pendingCount)

	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Pending({{$pendingCount}})</h5>
					<small>Orders that are awaiting your approval. Approve orders and assign writers.</small>
				</div>
				<div class="card-body">
					<table id="customer-pending" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">Paid</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($pendingOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/orders/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-red"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Pending</div>
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
											<input type="img" class="hidden" name="deadline" value="{{$order->deadline_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td><div class="text-gray-400 text-center">{{"$".number_format((float)$order->amount_paid,2,'.','')}}</div></td>
										<td><div class="text-muted">{{"$".number_format((float)$order->price_amount,2,'.','')}}</div></td>
									</tr>
								@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
	
	@endif 

	<!-- End Pending Orders -->


	<!-- Bidding Orders -->

	@if ($biddingCount)

	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Writer Selection({{$biddingCount}})</h5>
					<small>We are assigning your order to a suitable writer to meet your order requirements.</small>
				</div>
				<div class="card-body">
					<table id="customer-pending" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">Paid</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($biddingOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/orders/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-red"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Unassigned</div>
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
											<input type="img" class="hidden" name="deadline" value="{{$order->deadline_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td><div class="text-gray-400 text-center">{{"$".number_format((float)$order->amount_paid,2,'.','')}}</div></td>
										<td><div class="text-muted">{{"$".number_format((float)$order->price_amount,2,'.','')}}</div></td>
									</tr>
								@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
	
	@endif 

	<!-- End Bidding Orders -->

	<!-- Active Orders -->

	@if ($activeCount)
	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Active({{$activeCount}})</h5>
					<small>Orders that have been assigned and in progress to completion.</small>
				</div>
				<div class="card-body">
					<table id="customer-active" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">Paid</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($activeOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/orders/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-green"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Active</div>
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
											<input type="img" class="hidden" name="deadline" value="{{$order->deadline_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td><div class="text-gray-400">{{"$".number_format((float)$order->amount_paid,2,'.','')}}</div></td>
										<td><div class="text-muted">{{"$".number_format((float)$order->price_amount,2,'.','')}}</div></td>
									</tr>
								@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
	
	@endif 
	<!-- End Active Orders -->


	<!-- Done Orders -->

	@if ($doneCount)

	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Done({{$doneCount}})</h5>
					<small>The writer has completed the paper. We are reviewing it, before sending it to you.</small>
				</div>
				<div class="card-body">
					<table id="customer-done" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">Paid</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($doneOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/orders/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-dark"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Done</div>
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
											<input type="img" class="hidden" name="deadline" value="{{$order->deadline_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td><div class="text-gray-400 text-center">{{"$".number_format((float)$order->amount_paid,2,'.','')}}</div></td>
										<td><div class="text-muted">{{"$".number_format((float)$order->price_amount,2,'.','')}}</div></td>
									</tr>
								@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
	
	@endif 

	<!-- End Bidding Orders -->

	<!-- Done Orders -->

	@if ($deliveredCount)
	
	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Delivered({{$deliveredCount}})</h5>
					<small>Orders that are awaiting your review and approval to be considered finished.</small>
				</div>
				<div class="card-body">
					<table id="customer-delivered" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">Paid</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($deliveredOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/orders/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-violet"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Delivered</div>
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
											<input type="img" class="hidden" name="deadline" value="{{$order->deadline_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td><div class="text-gray-400">{{"$".number_format((float)$order->amount_paid,2,'.','')}}</div></td>
										<td><div class="text-muted">{{"$".number_format((float)$order->price_amount,2,'.','')}}</div></td>
									</tr>
								@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
	
	@endif 
	<!-- End Done Orders -->
	
	<!-- Revision Orders -->

	@if ($revisionCount)
	
	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Revision({{$activeCount}})</h5>
					<small>Order were delivered but you've requested revision.</small>
				</div>
				<div class="card-body">
					<table id="customer-revision" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">Paid</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($revisionOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/orders/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-warning"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Revision</div>
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
											<input type="img" class="hidden" name="deadline" value="{{$order->deadline_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td><div class="text-gray-400">{{"$".number_format((float)$order->amount_paid,2,'.','')}}</div></td>
										<td><div class="text-muted">{{"$".number_format((float)$order->price_amount,2,'.','')}}</div></td>
									</tr>
								@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
	
	@endif 
	<!-- End Revision Orders -->

	<!-- Rejected Orders -->

	@if ($rejectedCount)

	<div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Rejected({{$rejectedCount}})</h5>
					<small>Unfortunately we are unable to meet your order. We will refund you for any payments done.</small>
				</div>
				<div class="card-body">
					<table id="customer-done" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">Paid</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($rejectedOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/orders/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-red"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Rejected</div>
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
											<input type="img" class="hidden" name="deadline" value="{{$order->deadline_period}}">
											<div class="deadline-countdown text-primary"></div>
										</td>
										<td><div class="text-gray-400 text-center">{{"$".number_format((float)$order->amount_paid,2,'.','')}}</div></td>
										<td><div class="text-muted">{{"$".number_format((float)$order->price_amount,2,'.','')}}</div></td>
									</tr>
								@endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
	
	@endif 

	<!-- End Rejected Orders -->

	@if ($revisionCount == 0 && $deliveredCount == 0 && $activeCount == 0 && $pendingCount == 0 && $cancelledCount == 0 && $rejectedCount == 0)
	
	<div class="col-lg-12 text-center">
        <i class="o-document-1 text-gray-300 msg-icon mb-4"></i>
        <p class="h6 text-gray-400">You have no pending, active, delivered or cancelled orders.</p>
    </div>

	@endif

</section>
@endsection

@section ('scripts')
<script src="{{asset('/libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/libs/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{URL::asset('js/customer-orders.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
@endsection