@extends('backend.layout.admin_master')
@section('title', 'Food List')
@section('content')
@push('styles')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
								<li class="breadcrumb-item"><a href="#">Food</a></li>
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
								All Food List Here...
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
														<th>Food information</th>
														<th>Is Featured</th>
														<th>Is Popular</th>
														<th>Food Status</th>
													</tr>
												</thead>

												<tbody>
													@if(count($foods))
													@foreach($foods as $index => $food)
													<tr role="row">
														<td>{{++$index}}</td>
														<td>
															<div class="d-flex flex-column">
                											<span class="fw-bolder mb-25"><img src="{{asset('/')}}storage/app/public/images/food/thumbnail/{{$food->thumbnail}}" alt="" class="img-thumbnail thumb-sm mr-1" width="100px"> </span>
                											</div>
															<p class="m-0 text-center"><strong> Name: {{$food->name}} </strong></p>
															@php $restaurant = \App\Models\Restaurant::find($food->restaurant_id); @endphp
															<p class="m-0 text-center"><strong> Restaurant: {{$restaurant->name}} </strong></p>
															<p class="m-0 text-center"><strong> Category: {{$food->category->name}} </strong></p>
														</td>
														<td>
															<input data-id="{{$food->id}}" class="featured" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $food->featured ? 'checked' : '' }}>
														</td>
														<td>
														<input data-id="{{$food->id}}" class="popular" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $food->popular ? 'checked' : '' }}>
														</td>
														<td>
															@if($food->active == 1)
                											<span class="badge rounded-pill badge-light-primary me-1">Available</span>
                											@else
                											<span class="badge rounded-pill badge-light-danger me-1">Not Available</span>
                											@endif
														</td>
										            </tr>
            										@endforeach
            										@endif
            									</tbody>
    										</table>
    										{{$foods->links()}}
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
	<script>
		$(document).ready(function () {
			$('#myTable').DataTable();
		});

		$(function() {
			$('.featured').change(function() {
				var featured = $(this).prop('checked') == true ? 1 : 0; 
				var id = $(this).data('id'); 
				
				$.ajax({
					type: "GET",
					dataType: "json",
					url: '{{ route('superadmin.changefoodFeatured') }}',
					data: {'featured': featured, 'id': id},
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
			$('.popular').change(function() {
				var popular = $(this).prop('checked') == true ? 1 : 0; 
				var id = $(this).data('id'); 
				
				$.ajax({
					type: "GET",
					dataType: "json",
					url: '{{ route('superadmin.changefoodPopular') }}',
					data: {'popular': popular, 'id': id},
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