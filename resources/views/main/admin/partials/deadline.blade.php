<div class="col-lg-12">

	<div class="collapse px-2 py-3 mb-4" id="deadlineTable">

		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">                          
					<table id="deadline-datatable" class="table table-striped card-text" width="100%" data-pagination="true" data-search="true">
						@if (count($deadlines))
						<thead>
							<tr>
								<th>#</th>
								<th>Academic Level</th>
								<th>Label</th>
								<th>Description</th>
								<th>Period</th>
								<th>Status</th>
								<th>Cost</th>
								<th class="text-md-right">Manage</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($deadlines as $deadline)
							<tr>
								<td scope="row">{{$deadline->id}}</td>
								<td>{{$deadline->name}}</td>
								<td class="text-gray"><strong> {{$deadline->label}} </strong></td>
								<td class="text-sm text-muted">{{$deadline->description}}</td>
								<td class="text-muted"><strong>{{$deadline->hours . ' Hours'}}</strong></td>
								<td>
									@if ($deadline->status != 0)
									
									<p class="text-gray">Active</p>

									@else

									<p class="text-gray">Deleted</p>

									@endif
								</td>
								<td class="text-blue"><strong>{{'$'.number_format((float)$deadline->rate,2,'.','')}}</strong></td>
								<td class="text-md-right">
									<a href="#"><i class="fa fa-pencil action-icon no-anchor-style mr-3"></i></a>
									<a href="#"><i class="fa fa-trash-o action-icon no-anchor-style"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
						@else
						<div class="text-center table-icon"><i class="fa fa-frown-o"></i></div>
						<h6 class="text-center text-muted">You have not added deadline periods</h6>
						@endif
					</table>
				</div>
				<div class="mb-3 px-5 text-md-right"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-deadline">Add New</button></div>
			</div>
		</div>

		@include ('main.admin.modals.add-deadline')

	</div>

</div>