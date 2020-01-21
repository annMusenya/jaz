@extends ('main.admin.partials.main-admin')
@section ('custom-styles')
<link rel="stylesheet" type="text/css" href="{{URL::asset('libs/noty/noty.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('libs/bootstrap-table/bootstrap-table.min.css')}}">
@endsection
@section ('sidebar')
@include ('layouts.sidebar.admin-sidebar.settings')
@endsection
@section ('content')
<section>
	<div class="row">
		<div class="col-lg-6 mb-4 text-left">
			<h5 class="h5 text-uppercase mb-1 text-muted">Order System Settings</h5>
			<small class="text-muted">Make changes by adding new subjects, academic levels, pricing or even deadlines.</small>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="message card px-5 py-3 mb-4">
				<a class="setting no-anchor-style" data-toggle="collapse" href="#academicLevelTable" role="button" aria-expanded="false" aria-controls="academicLevelTable">
					<div class="row">
						<div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<div class="icon icon-lg shadow mr-3 text-gray"><i class="fab fa-graduation-cap"></i></div>
							<h6 class="mb-0">Academic Levels</h6>
						</div>
						<div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<p class="mb-0 mt-3 mt-lg-0 text-sm">Make changes to academic levels and their pricing. Add, update or delete academic levels.</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		@include ('main.admin.partials.academic-level')
		<div class="col-lg-12">
			<div class="message card px-5 py-3 mb-4">
				<a class="no-anchor-style" data-toggle="collapse" href="#documentTypeTable" role="button" aria-expanded="false" aria-controls="documentTypeTable">
					<div class="row">
						<div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<div class="icon icon-lg shadow mr-3 text-gray"><i class="fab fa-file-text-o"></i></div>
							<h6 class="mb-0">Type of Document</h6>
						</div>
						<div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<p class="mb-0 mt-3 mt-lg-0 text-sm">Manage different types of paper that appear in the order system.</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		@include ('main.admin.partials.document-type')
		<div class="col-lg-12">
			<div class="message card px-5 py-3 mb-4">
				<a class="no-anchor-style" data-toggle="collapse" href="#disciplinesTable" role="button" aria-expanded="false" aria-controls="disciplinesTable">
					<div class="row">
						<div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<div class="icon icon-lg shadow mr-3 text-gray"><i class="fab fa-book"></i></div>
							<h6 class="mb-0">Disciplines Offered</h6>
						</div>
						<div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<p class="mb-0 mt-3 mt-lg-0 text-sm">Manage what appears in the disciplines or subjects section of your order form.</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		@include ('main.admin.partials.disciplines')
		<div class="col-lg-12">
			<div class="message card px-5 py-3 mb-4">
				<a class="no-anchor-style" data-toggle="collapse" href="#deadlineTable" role="button" aria-expanded="false" aria-controls="deadlineTable">
					<div class="row">
						<div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<div class="icon icon-lg shadow mr-3 text-gray"><i class="fab fa-calendar"></i></div>
							<h6 class="mb-0">Deadline Periods</h6>
						</div>
						<div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<p class="mb-0 mt-3 mt-lg-0 text-sm">Manage order deadlines by adjusting periods, spreads and rates.</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		@include ('main.admin.partials.deadline')
		<div class="col-lg-12">
			<div class="message card px-5 py-3 mb-4">
				<a class="no-anchor-style" data-toggle="collapse" href="#citationsTable" role="button" aria-expanded="false" aria-controls="citationsTable">
					<div class="row">
						<div class="col-lg-3 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<div class="icon icon-lg shadow mr-3 text-gray"><i class="fab fa-quote-right"></i></div>
							<h6 class="mb-0">Citation Styles</h6>
						</div>
						<div class="col-lg-9 d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
							<p class="mb-0 mt-3 mt-lg-0 text-sm">Manage different referencing styles for paper orders.</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		@include ('main.admin.partials.citations')
	</div>
	<div class="row">
		@include ('main.admin.partials.notifications-settings')
		@include ('main.admin.partials.account-settings')
	</div>
</section>
@endsection
@section ('scripts')
<script src="{{URL::asset('js/admin-custom.js')}}"></script>
<script src="{{URL::asset('libs/noty/noty.min.js')}}"></script>
<script src="{{URL::asset('libs/bootstrap-table/bootstrap-table.min.js')}}"></script>
<script src="{{URL::asset('libs/select2/js/select2.min.js')}}"></script>
@endsection