@extends('backend.layout.admin_master')
@section('title', 'Product List')
@section('content')
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
							</ol>
						</div>
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
							@if(count($restaurant) < 1)
							<div class="d-flex justify-content-end">
								<a href="{{route(currentUser().'.info.create')}}" class="btn btn-primary font-weight-bolder  waves-effect waves-float waves-light">
									<i class="la la-list"></i>New Restaurant
								</a>
							</div>
							@endif
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<div id="myTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
									<div class="row">
										<div class="col-sm-12">
											<table class="table table-striped text-center table-bordered dt-responsive dataTable">
												<thead>
													<tr>
														<th>SL.</th>
														<th>Restaurant Information</th>
														<th>Restaurant Status</th>
														<th>Active</th>
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
															<p class="m-0 text-center"><strong> Address: {{$res->address}} </strong></p>
															<p class="m-0 text-center"><strong> Latitude: {{$res->latitude}} | Longitude: {{$res->longitude}}</strong></p>
															<p class="m-0 text-center"><strong> Phone: {{$res->phone}} | Mobile: {{$res->mobile}}</strong></p>
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
																<span class="badge rounded-pill badge-light-danger me-1">Open</span>
															@else
															<span class="badge rounded-pill badge-light-danger me-1">Close</span>
															@endif
														</td>
														<td>
														@if($res->active == 1)
                											<span class="badge rounded-pill badge-light-primary me-1">Active</span>
                											@else
                											<span class="badge rounded-pill badge-light-danger me-1">Inactive</span>
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
	<script>
		$(document).ready(function () {
			$('#myTable').DataTable();
		});
	</script>
	@endpush