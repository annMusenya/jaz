<div class="col-lg-12">

	<div class="collapse px-2 py-3 mb-4" id="disciplinesTable">

		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">                          
					<table id="subject-datatable" class="table table-striped table-sm card-text" width="100%" data-pagination="true" data-search="true">
						@if (count($subjects))
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Description</th>
								<th>Category</th>
								<th>Status</th>
								<th>Cost</th>
								<th class="text-md-right">Manage</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($subjects as $subject)
							<tr>
								<td scope="row">{{$subject->id}}</td>
								<td>{{$subject->name}}</td>
								<td class="text-sm text-muted">{{$subject->description}}</td>
								<td class="text-muted text-sm"><strong>{{$subject->category}}</strong></td>
								<td>
									@if ($subject->status != 0)
									
									<p class="text-gray">Active</p>

									@else

									<p>Deleted</p>

									@endif
								</td>
								<td class="text-blue"><strong>{{'$'. number_format((float)$subject->amount,2,'.','')}}</strong></td>
								<td class="text-md-right">
									<a href="#"><i class="fa fa-pencil action-icon no-anchor-style mr-3"></i></a>
									<a href="#"><i class="fa fa-trash-o action-icon no-anchor-style"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
						@else
						<div class="text-center table-icon"><i class="fa fa-frown-o"></i></div>
						<h6 class="text-center text-muted">You have not added disciplines</h6>
						@endif
					</table>
				</div>
				<div class="mb-3 px-5 text-md-right"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-subject">Add New</button></div>
			</div>
		</div>

		@include ('main.admin.modals.add-subject')

	</div>

</div>