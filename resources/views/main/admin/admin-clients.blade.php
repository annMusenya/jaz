@extends ('main.admin.partials.main-admin')

@section ('custom-styles')
<link rel="stylesheet" type="text/css" href="{{asset('libs/tel/css/intlTelInput.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables-net/custom/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/select2/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/jquery-confirm/jquery-confirm.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('libs/noty/noty.css')}}">
@endsection 

@section ('sidebar')

@include ('layouts.sidebar.admin-sidebar.client')

@endsection

@section ('content')

<section>
    <div class="row">
        <div class="col-lg-6 mb-4 text-left">
            <h5 class="h5 text-uppercase mb-1 text-muted">Manage Customers</h5>
            <small class="text-muted">View customers profile and manage their subscription.</small>
        </div>
    </div>

@if ($clientCount)
    <div class="row mb-5">
		<div class="col-lg-12">
			<div class="card">
                <div class="card-header">
					<h5 class="text-uppercase mb-0 text-primary mb-1">Customer Database</h5>
					<small>Manage customer accounts and their details.</small>
				</div>
				<div class="card-body">
					<table id="clients-table" class="table card-text table-standard ks-table-lg">
							<thead>
								<tr class="text-uppercase text-muted text-sm h6">
									<td>#</td>
									<td>Name</td>
									<td>Phone</td>
									<td>Email</td>
                                    <td class="text-center">Country</td>
									<td class="text-center">Status</td>
								</tr>
							</thead> 
							<tbody>
								@foreach ($clients as $client) 
									<tr id="{{$client->id}}" onclick="window.location='/admin/user/{{$client->id}}'" target="blank">
										<td>
											<div class="text-muted text-capitalize">{{$client->id}}</div>
										</td>
										<td>
											<div class="text-muted text-capitalize">{{$client->name}}</div>
										</td>
										<td>
											<div class="text-muted">{{$client->phone}}</div>
										</td>
										<td>
                                            <div class="text-muted">{{$client->email}}</div>
										</td>
										<td class="text-center">
                                            <div class="text-muted">{{$client->country}}</div>
										</td>
                                        <td class="text-center">
                                            @if ($client->status)
                                                <div class="badge badge-success px-2 py-1">Active</div>
											@else
                                                <div class="badge badge-red px-2 py-1">Inactive</div>
											@endif
										</td>
									</tr>
								 @endforeach
							</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
@endif

	@if ($clientCount == 0)
	
	<div class="col-lg-12 text-center">
        <i class="fa fa-users text-gray-300 msg-icon mb-4"></i>
        <p class="h6 text-gray-400">There are no registered customers. Consider advertising.</p>
    </div>

	@endif

</section>

@endsection


@section ('scripts')
<script src="{{asset('/libs/datatables-net/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/libs/datatables-net/media/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('libs/tel/js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{asset('libs/noty/noty.min.js')}}"></script>
<script src="{{asset('libs/momentjs/moment.min.js')}}"></script>
<script src="{{asset('libs/jquery-confirm/jquery-confirm.min.js')}}"></script>
<script src="{{asset('libs/tel/js/utils.js')}}"></script>
<script src="{{URL::asset('js/admin-main.js')}}"></script>

@endsection