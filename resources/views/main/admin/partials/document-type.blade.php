<div class="col-lg-12">

	<div class="collapse px-2 py-3 mb-4" id="documentTypeTable">

		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">                          
					<table id="document-datatable" class="table table-striped table-bordered" width="100%" data-pagination="true" data-search="true">
						@if (count($documents))
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Description</th>
								<th>Status</th>
								<th class="text-md-right">Manage</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($documents as $document)
							<tr>
								<td scope="row">{{$document->id}}</td>
								<td>{{$document->name}}</td>
								<td class="text-sm text-muted">{{$document->description}}</td>
								<td>
									@if ($document->status != 0)
									
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
						<h6 class="text-center text-muted">You have not added document types</h6>
						@endif
					</table>
				</div>
				<div class="mb-3 px-5 text-md-right">
					<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-document">Add New</button>
				</div>
			</div>
		</div>

		@include ('main.admin.modals.add-document')

	</div>

</div>