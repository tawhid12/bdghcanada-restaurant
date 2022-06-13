@extends('backend.layout.admin_master')
@section('title', 'Product List')
@section('content')
@push('styles')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/assets/css/plugins/forms/pickers/form-pickadate.css">
    <!-- END: Page CSS-->
@endpush
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-12">
						<h2 class="content-header-title float-start mb-0">Dashboard</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a
										href="{{route(currentUser().'Dashboard')}}">{{ encryptor('decrypt', Session::get('username')) }}</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Restaurant</a></li>
								<li class="breadcrumb-item active">List</li>
								<li>
									
								</li>
							</ol>
													
						</div>

					</div>
				</div>
			</div>
			<div class="d-flex justify-content-end">
										<div class="col-md-4">
										<div class="input-group">
                                                <input type="text" class="form-control" placeholder="" aria-label="Amount">
                                                <button class="btn btn-outline-primary waves-effect" type="submit">Search !</button>
                                            </div>
										</div>
</div>
		</div>

		<div class="content-body">
			<!-- Responsive tables start -->
			<div class="row" id="table-responsive">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">
								All Restaurant List Here...
							</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">

								<div id="myTable_wrapper" class="">

									<div class="row">
										<div class="col-sm-12">
											<table class="table table-striped text-center table-bordered dt-responsive dataTable">
												<thead>
													<tr>
														<th>SL.</th>
														<th>Restaurant information</th>
														<th>Is Promoted</th>
														<th>Is Popular</th>
														<th>Restaurant Status</th>
														<th>Active</th>
													</tr>
												</thead>

												<tbody>
													@if(count($restaurant))
													@foreach($restaurant as $index => $res)
													<tr role="row">
														<td>{{++$index}}</td>
														<td>
															<p class="m-0 text-center"><strong> Name: {{$res->name}} </strong></p>
															<p class="m-0 text-center">Address:-{{$res->address}}</p>
															<p class="m-0 text-center">Longitude:-{{$res->latitude}}</p>
															<p class="m-0 text-center">Latitude:-{{$res->longitude}}</p>
															<p class="m-0 text-center"><strong>Phone:- {{$res->phone}}<br>Mobile: {{$res->mobile}}</strong></p>
														</td>
														<td>
															<input data-id="{{$res->id}}" class="isPromoted" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $res->isPromoted ? 'checked' : '' }}>
														</td>
														<td>
															<input data-id="{{$res->id}}" class="isPopular" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $res->isPopular ? 'checked' : '' }}>
														</td>
														<td>
															@if($res->available_for_delivery == 1)
                											<span class="badge rounded-pill badge-light-primary me-1">Delivery Open</span>
                											@else
                											<span class="badge rounded-pill badge-light-danger me-1">Delivery Close</span>
                											@endif
															<br>
															@if($res->closed == 1)
															<span class="badge rounded-pill badge-light-danger me-1">Close</span>
                											@else
                											<span class="badge rounded-pill badge-light-primary me-1">Open</span>
                											@endif
														</td>
														<td>
														@if($res->active == 1)
                											<span class="badge rounded-pill badge-light-primary me-1">Active</span>
                											@else
                											<span class="badge rounded-pill badge-light-danger me-1">Inactive</span>
                											@endif
														</td>
										            </tr>
            										@endforeach
            										@endif
            									</tbody>
    										</table>
    										{{$restaurant->links()}}
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<!-- Responsive tables end -->
    	</div>
	</div>
	@endsection
	@push('scripts')
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<!-- BEGIN: Page Vendor JS-->
	<script src="{{asset('/')}}backend/assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{asset('/')}}backend/assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{asset('/')}}backend/assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{asset('/')}}backend/assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{asset('/')}}backend/assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <!-- END: Page Vendor JS-->

	 <!-- BEGIN: Page JS-->
	 <script src="{{asset('/')}}backend/assets/js/scripts/forms/pickers/form-pickers.js"></script>
    <!-- END: Page JS-->

	<script>
		$(document).ready(function () {
			$('#myTable').DataTable();
		});

		$(function() {
			$('.isPromoted').change(function() {
				var isPromoted = $(this).prop('checked') == true ? 1 : 0; 
				var id = $(this).data('id'); 
				
				$.ajax({
					type: "GET",
					dataType: "json",
					url: '{{ route('superadmin.changerestaurantFeatured') }}',
					data: {'isPromoted': isPromoted, 'id': id},
					success: function(data){
					console.log(data.success)
					},
					error:function(request,error){
						console.log(arguments);
						console.log("Error:"+error);
					}
				});
			})
		});

		$(function() {
			$('.isPopular').change(function() {
				var isPopular = $(this).prop('checked') == true ? 1 : 0; 
				var id = $(this).data('id'); 
				
				$.ajax({
					type: "GET",
					dataType: "json",
					url: '{{ route('superadmin.changerestaurantPopular') }}',
					data: {'isPopular': isPopular, 'id': id},
					success: function(data){
					console.log(data.success)
					},
					error:function(request,error){
						console.log(arguments);
						console.log("Error:"+error);
					}
				});
			})
		})
	</script>
	@endpush