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
														<th>Approve</th>
														<th>Action</th>
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
															<p class="m-0 text-center">Delivery Fee:-{{$res->delivery_fee}}  Delivery Range:-{{$res->delivery_range}}km Commission:-{{$res->admin_commission}}km</p>
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
															@php
															$now = Carbon\Carbon::now();
															$start = Carbon\Carbon::parse($res->opening_time);
															$end = Carbon\Carbon::parse($res->closing_time);
															@endphp
															@if ($now->between($start, $end)) 
																<span class="badge rounded-pill badge-light-success me-1">Open</span>
															@else
																<span class="badge rounded-pill badge-light-danger me-1">Close</span>
															@endif
														</td>
														<td>
															@if($res->active == 1)
                											<span class="badge rounded-pill badge-light-primary me-1">Yes</span>
                											@else
                											<span class="badge rounded-pill badge-light-danger me-1">No</span>
                											@endif
														</td>
														<td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                                </button>
                                                                <div class="dropdown-menu" style="">
																@if($res->galleries->count() > 0)
																<a class="dropdown-item" href="{{route(currentUser().'.gallery.show',[encryptor('encrypt', $res->id)])}}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                        <span>Gallery Image</span>
                                                                    </a>
																@endif
                                                                    <a class="dropdown-item" href="{{route(currentUser().'.info.edit',[encryptor('encrypt', $res->id)])}}">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                        <span>Edit</span>
                                                                    </a>
																	<form action="{{route(currentUser().'.info.destroy', [encryptor('encrypt', $res->id)])}}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{$res->name}} ?');">
																	@method('DELETE')    
																	@csrf
																	<button type="submit" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg><span>Delete</span></button>
																	
																	</form>
                                                                </div>
                                                            </div>
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