@extends ('main.admin.partials.main-admin')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.admin-sidebar.payments')

@endsection

@section ('content')

<section>
<div class="row">
    <div class="col-lg-6 mb-4 text-left">
        <h5 class="h5 text-uppercase mb-1 text-muted">Manage Payments</h5>
        <small class="text-muted">Manage payments to your account, execute refunds and pay writers.</small>
    </div>
    <div class="col-lg-6 text-right">
        
    </div>
</div>
</section>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                    <h2 class="h6 mb-0 text-uppercase">Orders Transactions</h2>
            </div>
            <div class="card-body">
			  @if ($paymentCount)
          <table id="payments-table" class="table card-text table-standard ks-table-lg">
						<thead>
							<tr class="text-uppercase text-muted text-sm h6">
								<td>Order Id</td>
								<td>Client</td>
								<td>Email</td>
								<td class="text-center">Transaction</td>
								<td class="text-center">Means</td>
								<td class="text-center">Status</td>
								<td class="text-right">Amount Paid</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($allPayments as $payment)
							<tr id="{{$payment->id}}" class="text-sm" onclick="window.location='/orders/{{$payment->order_id}}'">
                  <td class="text-muted">{{$payment->order_id}}</td>
                  <td class="text-muted">{{$payment->user_name}}</td>
                  <td class="text-muted">{{$payment->user_email}}</td>
                  <td class="text-muted text-center">
                    @if($payment->type == "1")
                        <span class="text-red">Order Payment</span>
                    @elseif ($payment->type == "2")
                        <span class="text-red">Wallet Recharge</span>
                    @else
                        <span class="text-red">Refund</span>
                    @endif
                  </td>
                  <td class="text-muted text-center">{{$payment->means}}</td>
                  <td class="text-gray-400 text-center">
                    @if ($payment->status)
                        <div class="badge badge-success px-2 py-1 text-white">Received</div>
                    @else
                        <div class="badge badge-danger px-2 py-1 text-white">Pending</div>
                    @endif
                  </td>
                  <td class="text-primary h6 text-right">{{"$".number_format((float)$payment->amount_paid,2,'.','')}}</td>
							</tr>
              @endforeach
            </tbody>
					</table>


                
              @else
                <div class="row">
                      <div class="col-md-12 text-center">
                          <i class="fa fa-credit-card text-gray-400 msg-icon"></i>
                      </div>
                      <div class="col-md-12 mt-4">
                          <div class="h6 text-muted text-center">You have not made any order sales yet.</div>
                      </div>
                </div>
              @endif

            </div>
        </div>
    </div>
</div>
<div class="row mt-4 text-dark">
    <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card rounded credit-card bg-hover-gradient-blue">
          <div class="content d-flex flex-column justify-content-between p-4">
            <h1 class="mb-5"><i class="fab fa-money"></i></h1>
            <div class="d-flex justify-content-between align-items-end pt-3">
              <div class="text-uppercase">
                <div class="font-weight-bold d-block">Revenue</div><small class="text-gray">Amount Received</small>
              </div>
              <h5 class="mb-0">
				  @php 
				 	 $totalIncome = 0;
                 	 foreach($allPayments as $payment){
                 	   $totalIncome += $payment->amount_paid;
                 	 }
                 	echo '$'.$totalIncome;
				  @endphp
			  </h5>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card rounded credit-card bg-hover-gradient-dark">
          <div class="content d-flex flex-column justify-content-between p-4">
            <h1 class="mb-5"><i class="fa fa-money"></i></h1>
            <div class="d-flex justify-content-between align-items-end pt-3">
              <div class="text-uppercase">
                <div class="font-weight-bold d-block">Expense</div><small class="text-gray">Total Amount Paid</small>
              </div>
              <h5 class="mb-0">-$0.00</h5>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card rounded credit-card bg-hover-gradient-red">
          <div class="content d-flex flex-column justify-content-between p-4">
            <h1 class="mb-5"><i class="o-document-1"></i></h1>
            <div class="d-flex justify-content-between align-items-end pt-3">
              <div class="text-uppercase">
                <div class="font-weight-bold d-block">Orders</div><small class="text-gray">Finished Orders</small>
              </div>
              <h5 class="mb-0">0</h5>
            </div>
          </div>
        </div>
    </div>
    
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
