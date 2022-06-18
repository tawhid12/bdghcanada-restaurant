@extends('backend.layout.admin_master')
@section('title', 'City List')
@section('content')
<div class="content-wrapper container-xxl p-0">




	<!--end::Notice-->
	<div class="content-body">
		<!-- Responsive tables start -->
		<!-- <button type="button" class="btn btn-outline-success waves-effect" id="progress-bar">Success Progress Bar</button> -->
		<div class="row" id="table-responsive">
			<div class="col-12">
				<div class="card">
					<!-- <div class="card-header">
						<h4 class="card-title">
							All Category List Here...
						</h4>
						<div class="d-flex justify-content-end">
							<a href="{{route(currentUser().'.addNewStateForm')}}"
								class="btn btn-primary font-weight-bolder  waves-effect waves-float waves-light">
								<i class="la la-list"></i>New Category</a>
						</div>
					</div> -->
					<div class="card-body">



						<!-- Basic table -->
						<section id="basic-datatable">
							<div class="row">
								<div class="col-12">
									<div class="card">
										<table class="table table-striped text-center table-bordered datatables-basic table">
											<thead>
												<tr>
													<th>Provience Name</th>
													<th>City Code</th>
													<th>City Name</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@if(count($allCity))
												@foreach($allCity as $city)
												<tr>
													<td>{{$city->state->name}}</td>
													<td>{{$city->code}}</td>
													<td>{{$city->name}}</td>
													<td>
														@if($city->status == 1)
														<span class="badge badge-soft-success">Active</span>
														@else
														<span class="badge badge-soft-danger">Inactive</span>
														@endif
													</td>
													<td>
														<div class="dropdown">
															<button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
																<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
																	<circle cx="12" cy="12" r="1"></circle>
																	<circle cx="12" cy="5" r="1"></circle>
																	<circle cx="12" cy="19" r="1"></circle>
																</svg>
															</button>
															<div class="dropdown-menu" style="">
																<a class="dropdown-item" href="{{route(currentUser().'.editCity',[Replace($city->name), encryptor('encrypt', $city->id)])}}">
																	<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50">
																		<path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
																	</svg>
																	<span>Edit</span>
																</a>

																<a class="dropdown-item" onclick="return confirm('Are you sure to delete?')" href="{{route(currentUser().'.deleteCity', [Replace($city->name), encryptor('encrypt', $city->id)])}}">
																	<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50">
																		<polyline points="3 6 5 6 21 6"></polyline>
																		<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
																	</svg>
																	<span>Delete</span>
																</a>

															</div>
														</div>
													</td>
												</tr>
												@endforeach
												@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<!--/ Basic table -->



					</div>
				</div>
			</div>
			<!-- Responsive tables end -->
		</div>
	</div>
	@endsection
	@push('scripts')
	<script>
		var dt_basic_table = $('.datatables-basic');
		if (dt_basic_table.length) {
			dt_basic_table.DataTable({

				dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
				displayLength: 7,
				lengthMenu: [7, 10, 25, 50, 75, 100],
				buttons: [{
						extend: 'collection',
						className: 'btn btn-outline-secondary dropdown-toggle me-2',
						text: feather.icons['share'].toSvg({
							class: 'font-small-4 me-50'
						}) + 'Export',
						buttons: [{
								extend: 'print',
								text: feather.icons['printer'].toSvg({
									class: 'font-small-4 me-50'
								}) + 'Print',
								className: 'dropdown-item',
								exportOptions: {
									columns: [1, 2, 3]
								}
							},
							{
								extend: 'csv',
								text: feather.icons['file-text'].toSvg({
									class: 'font-small-4 me-50'
								}) + 'Csv',
								className: 'dropdown-item',
								exportOptions: {
									columns: [1, 2, 3]
								}
							},
							{
								extend: 'excel',
								text: feather.icons['file'].toSvg({
									class: 'font-small-4 me-50'
								}) + 'Excel',
								className: 'dropdown-item',
								exportOptions: {
									columns: [1, 2, 3]
								}
							},
							{
								extend: 'pdf',
								text: feather.icons['clipboard'].toSvg({
									class: 'font-small-4 me-50'
								}) + 'Pdf',
								className: 'dropdown-item',
								exportOptions: {
									columns: [1, 2, 3]
								}
							},
							{
								extend: 'copy',
								text: feather.icons['copy'].toSvg({
									class: 'font-small-4 me-50'
								}) + 'Copy',
								className: 'dropdown-item',
								exportOptions: {
									columns: [1, 2, 3]
								}
							}
						],
						init: function(api, node, config) {
							$(node).removeClass('btn-secondary');
							$(node).parent().removeClass('btn-group');
							setTimeout(function() {
								$(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
							}, 50);
						}
					},
					/*{
					    text: feather.icons['plus'].toSvg({
					        class: 'me-50 font-small-4'
					    }) + 'Add New Record',
					    className: 'create-new btn btn-primary',
					    attr: {
					        'data-bs-toggle': 'modal',
					        'data-bs-target': '#modals-slide-in'
					    },
					    init: function(api, node, config) {
					        $(node).removeClass('btn-secondary');
					    },
					}*/

				],

				language: {
					paginate: {
						// remove previous & next text from pagination
						previous: '&nbsp;',
						next: '&nbsp;'
					}
				}
			});
			$('div.head-label').html('<h4 class="mb-0">Dashboard</h4><div class="breadcrumb-wrapper"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{route(currentUser()."Dashboard")}}">{{ encryptor("decrypt", Session::get("username")) }}</a></li><li class="breadcrumb-item"><a href="#">City</a></li><li class="breadcrumb-item active">List</li></ol></div>');

			$('.card-header').before('<div class="row"><div class="col-xs-12"><a href="{{route(currentUser().".addNewCityForm")}}" class="dt-button create-new btn btn-primary"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>Add New City</span></a></div></div>');



		}
		@if(Session::has('response'))
		toastr.options = {
			"closeButton": true,
			"progressBar": true
		}
		toastr.success("{{Session::get('response')['message']}}");
		@endif
	</script>
	@endpush