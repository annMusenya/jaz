@extends ('main.admin.partials.main-admin')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.admin-sidebar.main')

@endsection


@section ('content')

<section>
    <div class="row">
        <div class="col-lg-6 mb-4 text-left">
            <h5 class="h5 text-uppercase mb-1 text-muted">Manage all orders</h5>
            <small class="text-muted">Manage all customer orders, assign writers and change order status.</small>
        </div>
    </div>

	@if ($pendingCount)
	
    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Pending Orders({{$pendingCount}})</h5>
					<small>Orders that are awaiting your approval. Approve orders and assign writers.</small>
				</div>
				<div class="card-body">
					<table id="pending-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order Id</td>
									<td>Topic Title</td>
									<td>Discipline</td>
									<td class="text-center">Pages</td>
									<td class="text-center">Deadline</td>
									<td class="text-center">Status</td>
									<td>Cost</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($pendingOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/admin/order/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													@if ($order->payment_status)
														<div class="dot mr-3 bg-red"></div>
													@else
														<div class="dot mr-3 bg-red"></div>
													@endif
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
															echo "Undergrad (Years 1-2)";
														break;
														case "47":
															echo "Undergrad (Years 3-4)";
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
										<td class="text-center">
											@if ($order->payment_status)
												<div class="text-sm text-success h6">Paid</div>
											@else
												<div class="text-sm text-danger h6">Unpaid</div>
											@endif
											
										</td>
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

	@if ($biddingCount)
	
    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">On Bidding({{$biddingCount}})</h5>
					<small>Orders that are on bidding stage. Click an order to see bids.</small>
				</div>
				<div class="card-body">
					<table id="bidding-table" class="table card-text table-standard ks-table-lg">
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
								@foreach ($biddingOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/admin/order/{{$order->id}}'">
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
										<td>
											<div class="text-gray-400">
											@php
												$cost = $order->price_amount;
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

	@if ($activeCount)

    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Assigned Orders({{$activeCount}})</h5>
					<small>Orders that have been assigned to writers and are in progress.</small>
				</div>
				<div class="card-body">
					<table id="active-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted h6 text-sm">
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
								@foreach ($activeOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/admin/order/{{$order->id}}'">
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
										<td>
											<div class="text-gray-400">
											@php
												$cost = $order->price_amount;
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


	@if ($cancelledCount)

    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Cancelled Orders({{$cancelledCount}})</h5>
					<small>Orders that have been cancelled.</small>
				</div>
				<div class="card-body">
					<table id="cancelled-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted h6 text-sm">
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
								@foreach ($cancelledOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/admin/order/{{$order->id}}'">
										<td>
											<div class="row">
												<div class="col-sm-1 flex-grow-1 d-flex align-items-center p-3">
													<div class="dot mr-3 bg-gray-400"></div>
												</div>
												<div class="col-sm-8">
													<div class="text-muted">Cancelled</div>
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
										<td>
											<div class="text-gray-400">
											@php
												$cost = $order->price_amount;
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

	@if ($doneCount)

    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Done Orders({{$doneCount}})</h5>
					<small>Orders that have been completed by writers awaiting delivery to customers.</small>
				</div>
				<div class="card-body">
					<table id="done-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted h6 text-sm">
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
								@foreach ($doneOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/admin/order/{{$order->id}}'">
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
										<td>
											<div class="text-gray-400">
											@php
												$cost = $order->price_amount;
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

	@if ($deliveredCount)

    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Delivered Orders({{$deliveredCount}})</h5>
					<small>Orders that have been delivered to customers awaiting approval.</small>
				</div>
				<div class="card-body">
					<table id="delivered-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted h6 text-sm">
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
								@foreach ($deliveredOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/admin/order/{{$order->id}}'">
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
										<td>
											<div class="text-gray-400">
											@php
												$cost = $order->price_amount;
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

	@if ($revisionCount)

    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Revision Orders({{$revisionCount}})</h5>
					<small>Orders that have been returned for revision.</small>
				</div>
				<div class="card-body">
					<table id="revision-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted h6 text-sm">
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
								@foreach ($revisionOrders as $order)
									<tr id="{{$order->id}}" onclick="window.location='/admin/order/{{$order->id}}'">
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
										<td>
											<div class="text-gray-400">
											@php
												$cost = $order->price_amount;
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

	@if ($pendingCount == 0 && $biddingCount == 0 && $activeCount == 0 && $cancelledCount == 0 && $revisionCount == 0 && $doneCount == 0 && $deliveredCount == 0)
	
	<div class="col-lg-12 text-center">
        <i class="fa fa-smile text-gray-300 msg-icon mb-4"></i>
        <p class="h6 text-gray-400">No pending, active, done or delivered orders. Check biddings section for orders on bidding.</p>
		<button class="btn btn-primary mt-3" onclick="location.href='/admin/bidding';" target="__blank">Go to Bidding</button>
    </div>

	@endif

</section>
@endsection

@section ('scripts')
<script src="{{asset('/libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/libs/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{URL::asset('js/admin-main.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
@endsection