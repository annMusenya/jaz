<div class="col-lg-12">

	<div class="collapse px-2 py-3 mb-4" id="citationsTable">

		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<h6 class="text-uppercase mb-0 text-muted">Manage Citation Styles</h6>
				</div>
				<div class="card-body">                          
					<table class="table table-striped table-sm card-text">
						@if (count($citations))
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Description</th>
								<th>Status</th>
								<th class="text-md-right">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($citations as $citation)
							<tr>
								<th scope="row">{{$citation->id}}</th>
								<td class="text-muted"><strong>{{$citation->name}}</strong></td>
								<td class="text-sm text-muted">{{$citation->description}}</td>
								<td>
									@if ($citation->status != 0)
									
									<p class="text-gray">Active</p>

									@else

									<p>Deleted</p>

									@endif
								</td>
								<td class="text-md-right">
									<a href="#"><i class="fa fa-pencil action-icon no-anchor-style mr-3"></i></a>
									<a href="#"><i class="fa fa-trash-o action-icon no-anchor-style"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
						@else
						<div class="text-center table-icon"><i class="fa fa-frown-o"></i></div>
						<h6 class="text-center text-muted">You have not added citation styles</h6>
						@endif
					</table>
				</div>
				<div class="mb-3 px-5 text-md-right"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-citation">Add New</button></div>
			</div>
		</div>

		@include ('main.admin.modals.add-citation')

	</div>

</div>