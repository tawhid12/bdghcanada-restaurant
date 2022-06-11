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
															<p class="m-0 text-center">Address:{{$res->address}}</p>
															<p class="m-0 text-center">Longitude{{$res->latitude}}</p>
															<p class="m-0 text-center">Latitude{{$res->longitude}}</p>
															<p class="m-0 text-center"><strong>Phone: {{$res->phone}}<br>Mobile: {{$res->mobile}}</strong></p>
														</td>
														<td>
															@if($res->isPromoted == 1)
                											<span class="badge rounded-pill badge-light-primary me-1">Yes</span>
                											@else
                											<span class="badge rounded-pill badge-light-danger me-1">No</span>
                											@endif
														</td>
														<td>
															@if($res->isPopular == 1)
                											<span class="badge rounded-pill badge-light-primary me-1">Yes</span>
                											@else
                											<span class="badge rounded-pill badge-light-danger me-1">No</span>
                											@endif
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
	<script>
		$(document).ready(function () {
			$('#myTable').DataTable();
		});
	</script>
	@endpush