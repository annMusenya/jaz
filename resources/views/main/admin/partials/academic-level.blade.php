<div class="col-lg-12">

	<div class="collapse px-2 py-3 mb-4" id="academicLevelTable">

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h6 class="text-uppercase mb-0 text-muted">Manage Academic Levels</h6>
				</div>
				<div class="card-body">                          
					<table class="table table-striped table-sm card-text table-standard">
						@if (count($academicLevels))
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Label</th>
								<th>Description</th>
								<th>Status</th>
								<th>Cost</th>
								<th class="text-md-right">Manage</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($academicLevels as $level)
							<tr>
								<th scope="row">{{$level->id}}</th>
								<td>{{$level->name}}</td>
								<td class="text-gray"><strong> {{$level->label}} </strong></td>
								<td class="text-sm text-muted">{{$level->description}}</td>
								<td>
									@if ($level->status != 0)
									
									<p class="text-gray">Active</p>

									@else

									<p class="text-gray">Deleted</p>

									@endif
								</td>
								<td class="text-blue"><strong>{{'$'.number_format((float)$level->rate,2,'.','')}}</strong></td>
								<td class="text-md-right">
									<a href="#"><i class="fa fa-pencil action-icon no-anchor-style mr-3"></i></a>
									<a href="#"><i class="fa fa-trash-o action-icon no-anchor-style"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
						@else
						<div class="text-center table-icon"><i class="fa fa-frown-o"></i></div>
						<h6 class="text-center text-muted">You have not added academic levels</h6>
						@endif
					</table>
				</div>
				<div class="mb-3 px-5 text-md-right">
					<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-academic">Add New</button>
				</div>
			</div>
		</div>

		@include ('main.admin.modals.add-academic')

	</div>

</div>