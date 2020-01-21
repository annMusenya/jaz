@extends ('layouts.main')

@section ('custom-styles')

<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/media/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">

@endsection

@section ('sidebar')

@include ('layouts.sidebar.customer.payments')

@endsection

@section ('content')

<section>
<div class="row">
    <div class="col-lg-6 mb-4 text-left">
        <h5 class="h5 text-uppercase mb-1 text-muted">Manage Your Payments</h5>
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
                <h2 class="h6 mb-0 text-uppercase">All Payments</h2>
            </div>
            <div class="card-body">
              @if ($paymentCount)
					<table id="payments-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>Order</td>
									<td>Pay Id</td>
									<td>Paid By</td>
									<td>Statement</td>
									<td>Status</td>
									<td class="text-center">Cost</td>
									<td class="text-right">Paid</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($payments as $payment)
									<tr id="{{$payment->id}}" onclick="window.location='/orders/{{$payment->order_id}}'">
										<td>
                                            <small class="text-gray-400 text-sm mt-1">{{"#".$payment->order_id}}</small>
										</td>
										<td>
											<div class="text-muted text-sm">{{$payment->payment_id}}</div>
										</td>
										<td>
											<div class="text-muted text-sm">{{$payment->user_name}}</div>
										</td>
										<td>
											<div class="text-muted text-sm">{{$payment->statement}}</div>
										</td>
										<td class="text-center">
                                            <div class="text-muted text-sm">
                                            @if($payment->status)
                                                <div class="badge badge-success px-2 py-1">Paid</div>
                                            @else
                                                <div class="badge badge-warning text-dark px-2 py-1">Unpaid</div>
                                            @endif
                                            </div>
										</td>
										<td class="text-center">
                                            <div class="text-muted text-sm">{{$payment->total_amount}}</div>
										</td>
										<td class="text-right">
                                            <div class="text-muted text-sm">{{$payment->amount_paid}}</div>
										</td>
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
                          <div class="h6 text-muted text-center">You have not made any payments transactions yet.</div>
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
            <h1 class="mb-5"><i class="fab fa-cc-paypal"></i></h1>
            <div class="d-flex justify-content-between align-items-end pt-3">
              <div class="text-uppercase">
                <div class="font-weight-bold d-block">My Wallet</div><small class="text-gray">Wallet Balance</small>
              </div>
              <h5 class="mb-0">$0.00</h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card rounded credit-card bg-hover-gradient-dark">
          <div class="content d-flex flex-column justify-content-between p-4">
            <h1 class="mb-5"><i class="o-document-1"></i></h1>
            <div class="d-flex justify-content-between align-items-end pt-3">
              <div class="text-uppercase">
                <div class="font-weight-bold d-block">Purchases</div><small class="text-gray">Your total purchases</small>
              </div>
              <h5 class="mb-0">
                @php
                 $totalExpenditure = 0;
                 foreach($orderPayments as $payment){
                   $totalExpenditure += $payment->amount_paid;
                 }
                 echo '$'.$totalExpenditure;
                @endphp
              </h5>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4 mb-lg-0">
        <div class="card">
          <div class="card-header">
              <h3 class="h6 text-uppercase mb-0">Recharge Wallet</h3>
          </div>
          <div class="card-body">
              <form method="POST">
                  <div class="row">
					  <div class="col-lg-12"><label class="form-control-label text-base">Your wallet deposit in US dollars ($)</label></div>
                      <div class="col-lg-7">
                        <div class="form-group">
							<input class="text-muted form-control" type="number" min="1" name="amount_recharge" placeholder="Amount">
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Recharge</button>
                        </div>
                      </div>
                      <div class="col-lg-12 text-center mt-2">
                          <img src="{{asset('img/payment.svg')}}" alt="we accept">
                      </div>
                  </div>
              </form>
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
<script src="{{URL::asset('js/payments.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
@endsection