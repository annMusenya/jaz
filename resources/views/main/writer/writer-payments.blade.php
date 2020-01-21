@extends ('main.writer.partials.main-writer')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.writer.payments')

@endsection


@section ('content')

<section>
    <div class="row">
        <div class="col-lg-6 mb-4 text-left">
            <h5 class="h5 text-uppercase mb-1 text-muted">Manage your Earnings</h5>
            <small class="text-muted">Request payment and view transaction history.</small>
        </div>
		<div class="col-lg-6 text-right text-muted">
			<span>Unrequested Funds:</span>
			<span class="h5 ml-2 text-dark">$0.00</span>
		</div>
    </div>

    <div class="row">
	<div class="col-lg-12 mb-4 text-left">
            <p class="col-sm-12 danger-card bg-white shadow roundy p-4 text-muted text-sm">You can request payment twice a month 30th or 31st day to the 3rd and from the 14th to the 18th day (start-end at 8 PM (GMT+0)). Your payment will be processed up to and including the 5th or the 20th day accordingly.</p>
        </div>
    	<div class="col-lg-6">
    	    <div class="card">
    	        <div class="card-header">
						<h2 class="h6 mb-0 text-uppercase">My Earnings</h2>
    	        </div>
    	        <div class="card-body">
    	          	@if ($earnings)
    	            <p class="text-gray mb-3">View all your order payments and recent transactions.</p>
    	            <table id="payments-table" class="table card-text table-standard ks-table-lg">
						      		<thead>
						      			<tr class="text-uppercase text-muted">
										  <tr class="text-uppercase text-muted h6 text-sm">
						      				<td>Order Id</td>
						      				<td>Earning</td>
						      				<td>Bonus</td>
						      				<td>Status</td>
						      				<td class="text-right">Date</td>
						      			</tr>
						      			</tr>
						      		</thead>
						      		<tbody>
						      			
    	                    		</tbody>
    						      </table>
    	              @else
    	                <div class="row">
    	                      <div class="col-md-12 text-center">
    	                          <i class="fa fa-credit-card text-gray-400 msg-icon"></i>
    	                      </div>
    	                      <div class="col-md-12 mt-1">
    	                          <div class="h6 text-muted text-center">You don't have any transactions.</div>
    	                      </div>
    	                </div>
    	              @endif
    	        </div>
    	    </div>
        </div>
    	<div class="col-lg-6">
    	    <div class="card">
    	        <div class="card-header">
						<h2 class="h6 mb-0 text-uppercase">Payment Details</h2>
    	        </div>
    	        <div class="card-body">
    	            <div class="row">
						<div class="col-sm-3">
							<div class="text-gray-500 text-center">Active</div>
							<div class="h3 text-muted text-center">{{$active}}</div>
						</div>
						<div class="col-sm-3">
							<div class="text-gray-500 text-center">Delivered</div>
							<div class="h3 text-muted text-center">{{$delivered}}</div>
						</div>
						<div class="col-sm-3">
							<div class="text-gray-500 text-center">Disputed</div>
							<div class="h3 text-muted text-center">{{$disputed}}</div>
						</div>
						<div class="col-sm-3">
							<div class="text-gray-500 text-center">Finished</div>
							<div class="h3 text-muted text-center">{{$finished}}</div>
						</div>
					</div>
					<div class="row mt-5 mb-1 align-items-center">
						<div class="col-sm-3">
							<div class="text-muted">Earnings:</div>
							<div><span class="h6 text-success">+ $0.00</span></div>
						</div>
						<div class="col-sm-3">
							<div class="text-muted">Fines:</div>
							<div><span class="h6 text-danger">- $0.00</span></div>
						</div>
						<div class="col-sm-6 text-right">
							<button class="btn btn-dark" type="button">Request Payment</button>
						</div>
					</div>
    	        </div>
    	    </div>
        </div>
    </div>

	<!-- 15% -> Reason - Lateness, 25% -> Plagiarism -->
	
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