@extends('backend.layout.admin_master')
@section('title', 'Edit New Restaurant')
@push('styles')
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
@section('content')
<div class="content-wrapper container-xxl p-0">
	<div class="content-header row">
		<div class="content-header-left col-md-9 col-12 mb-2">
			<div class="row breadcrumbs-top">
				<div class="col-12">
					<h2 class="content-header-title float-start mb-0">Edit Restaurant</h2>
					<div class="breadcrumb-wrapper">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route(currentUser().'Dashboard')}}">{{ currentUser() }}</a></li>
							<li class="breadcrumb-item"><a href="#">Restaurant</a></li>
							<li class="breadcrumb-item active">Edit</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="content-header-right col-md-3 col-6 mb-2">
		</div>
	</div>
	<!--begin::Notice-->
	@if( Session::has('response') )
	<div class="alert alert-{{Session::get('response')['class']}} alert-dismissible fade show" role="alert">
		<div class="alert-body">
			{{Session::get('response')['message']}}
		</div>
		<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif
	<!--end::Notice-->

	<div class="card">
		<!--begin::Form-->
		<form class="form" action="{{ route(currentUser().'.info.update',$restaurant->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('put')
			<div class="card-body">
				<div class="row form-group">
					<div class="col-md-3 mb-1">
						<label>State: <span class="text-danger sup">*</span></label>
						<select name="state_id" class="select2 form-control custom-select @if($errors->has('state_id')) {{ 'is-invalid' }} @endif" style="width: 100%; height:36px;">
							<option hidden>Choose State</option>
							@if(count($states) > 0)
							@foreach($states as $stat)
							<option value="{{ $stat->id }}" @if($stat->id == $restaurant->state_id) selected @endif>{{ $stat->name }}</option>
							@endforeach
							@endif
						</select>
						@if($errors->has('state_id'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('state_id') }}
						</small>
						@endif
					</div>
					<div class="col-md-3 mb-1">
						<label>City: <span class="text-danger sup">*</span></label>
						<select name="city_id" id="city_id" class="select2 form-control custom-select @if($errors->has('city_id')) {{ 'is-invalid' }} @endif" style="width: 100%; height:36px;">
						</select>
						@if($errors->has('city_id'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('city_id') }}
						</small>
						@endif
					</div>
					<div class="col-lg-6 mb-1">
						<label> Restaurant Name: <span class="text-danger sup">*</span></label>
						<input type="text" name="name" class="form-control @if($errors->has('name')) {{ 'is-invalid' }} @endif" placeholder="Restaurant name" value="{{ old('name', $restaurant->name) }}" />
						@if($errors->has('name'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('name') }}
						</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-4 mb-1">
						<label>Restaurant Logo</label>
						<input type="file" class="form-control" name="logo" accept=".png, .jpg, .jpeg" />
					</div>
					<div class="col-lg-4 mb-1">
						<label>Restaurant Featured Image</label>
						<input type="file" class="form-control" name="feature_image" accept=".png, .jpg, .jpeg" />
					</div>
					<div class="col-lg-2 mb-1">
						<label> Latitude: </label>
						<input type="text" name="latitude" class="form-control @if($errors->has('latitude')) {{ 'is-invalid' }} @endif" value="{{ old('latitude', $restaurant->latitude) }}" />
						@if($errors->has('latitude'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('latitude') }}
						</small>
						@endif
					</div>
					<div class="col-lg-2 mb-1">
						<label> Longitude: </label>
						<input type="text" name="longitude" class="form-control @if($errors->has('longitude')) {{ 'is-invalid' }} @endif" value="{{ old('longitude', $restaurant->longitude) }}" />
						@if($errors->has('longitude'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('longitude') }}
						</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-4 mb-1">
						<label> Delivery Time: </label>
						<select name="delivery_time" class="select2 form-control">
							<option hidden>Choose Delivery Slot</option>
							<option value="1" @if($restaurant->delivery_time == 1) selected @endif>15-20 Min</option>
							<option value="2" @if($restaurant->delivery_time == 2) selected @endif>20-30 Min</option>
							<option value="3" @if($restaurant->delivery_time == 3) selected @endif>30-40 Min</option>
							<option value="4" @if($restaurant->delivery_time == 4) selected @endif>40-50 Min</option>
						</select>
					</div>
					<div class="col-lg-4 mb-1">
						<label> Phone: </label>
						<input type="text" name="phone" class="form-control" value="{{ old('phone', $restaurant->phone) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Mobile: </label>
						<input type="text" name="mobile" class="form-control" value="{{ old('mobile', $restaurant->mobile) }}" />
					</div>
				</div>
				<div class="form-group row">
					@if(currentUser() =='owner')
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="available_for_delivery" name="available_for_delivery" {{  ($restaurant->available_for_delivery == 1 ? ' checked' : '') }}>
								<label class="form-check-label" for="available_for_delivery">Is Available For Delivery</label>
							</div>
						</div>
					</div>
					@endif
					<!-- <div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="closed" name="closed" {{  ($restaurant->closed == 1 ? ' checked' : '') }}>
								<label class="form-check-label" for="closed">Is Closed</label>
							</div>
						</div>
					</div> -->
					@if(currentUser() =='superadmin')
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="active" name="active" {{  ($restaurant->active == 1 ? ' checked' : '') }}>
								<label class="form-check-label" for="active">Is Active</label>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="isPromoted" name="isPromoted" {{  ($restaurant->isPromoted == 1 ? ' checked' : '') }}>
								<label class="form-check-label" for="isPromoted">Is Promoted</label>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="isPopular" name="isPopular" {{  ($restaurant->isPopular == 1 ? ' checked' : '') }}>
								<label class="form-check-label" for="isPopular">Is Populard</label>
							</div>
						</div>
					</div>
					@endif
				</div>
				@if(currentUser() =='superadmin')
				<div class="form-group row">
					<div class="col-lg-4 mb-1">
						<label> Delivery Fee: </label>
						<input type="text" name="delivery_fee" class="form-control" value="{{ old('delivery_fee', $restaurant->delivery_fee) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Delivery Range: </label>
						<input type="text" name="delivery_range" class="form-control" value="{{ old('delivery_range', $restaurant->delivery_range) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Admin Commission: </label>
						<div class="input-group input-group-merge">
							<input type="text" class="form-control" name="admin_commission" class="form-control" value="{{ old('admin_commission', $restaurant->admin_commission) }}" placeholder="10" aria-label="Amount (Percentage)">
							<span class="input-group-text">%</span>
						</div>
						<p class="text-muted">Commission in Percentage</p>
					</div>
				</div>
				@endif
				<div class="form-group row">
					<div class="col-lg-4 mb-1">
						<label> Opening Time: </label>
						<input type="time" name="opening_time" class="form-control" value="{{old('opening_time',$restaurant->opening_time) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Closing Time: </label>
						<input type="time" name="closing_time" class="form-control" value="{{old('closing_time',$restaurant->closing_time) }}" />
					</div>
					<div class="col-lg-4">
						<label>Upload Restaurant Gallery Image</label>
						<input type="file" class="form-control" name="gallery_img[]" accept=".png, .jpg, .jpeg" multiple />
						<p class="text-muted">You May Upload Multiple Images</p>
						@if($errors->has('gallery_img'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('gallery_img') }}
						</small>
						@endif
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-6 mb-1">
						<label> Address: </label>
						<textarea name="address" class="form-control">{{ old('address', $restaurant->address) }}</textarea>
					</div>
					<div class="col-lg-6 mb-1">
						<label> Other information: </label>
						<textarea name="infomation" class="form-control">{{ old('infomation', $restaurant->infomation) }}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-12 mb-1">
						<label> Description: </label>
						<textarea name="description" class="form-control" id="editor">{{ old('description', $restaurant->description) }}</textarea>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-lg-4"></div>
					<div class="col-lg-8">
						<button type="submit" class="btn btn-primary mr-2">Update</button>
						<a href="{{route(currentUser().'.info.index')}}" class="btn btn-secondary">Cancel</a>
					</div>
				</div>
			</div>
		</form>
		<!--end::Form-->
	</div>
	<!--end::Card-->
	@endsection
	@push('scripts')
	<!-- Include the Quill library -->
	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	<!-- Initialize Quill editor -->
	<script>
		/*var quill = new Quill('#editor', {
    theme: 'snow'
  });*/

		// when page is ready
		/*	$(document).ready(function() {
			$('.form-check-input').change(function(){
		
				$(this).val($(this).attr('checked') ? '1' : '0');
});
    })*/
		$(document).ready(function() {

			// Checkbox instead of on:off 1:0
			$('input:checkbox').on('change', function() {
				this.value = this.checked ? 1 : 0;
			}).change();


			showStateId({{$restaurant->state_id}});
			$('[name=state_id]').on('change', function() {
				var stateId = $(this).val();
				if (stateId) {
					showStateId(stateId);
				} else {
					$('#city_id').empty();
				}
			});

			function showStateId(stateId) {
				var url = "{{route(currentUser().'.getCity',':stateId')}}";
				url = url.replace(':stateId', stateId);
				$.ajax({
					url: url,
					type: "GET",
					data: {
						"_token": "{{ csrf_token() }}"
					},
					dataType: "json",
					success: function(data) {
						if (data) {
							$('#city_id').empty();
							$('#city_id').append('<option hidden>Choose City</option>');
							$.each(data, function(key, city) {
								$('select[name="city_id"]').append('<option value="' + city.id + '" ' + ({{$restaurant->city_id}} == city.id ? 'selected' : '') + '>' + city.name + '</option>');
							});
						} else {
							$('#city_id').empty();
						}
					}
				});
			}
		});
	</script>
	@endpush