@extends('backend.layout.admin_master')
@section('title', 'Add New Restaurant')
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
					<h2 class="content-header-title float-start mb-0">Add Restaurant</h2>
					<div class="breadcrumb-wrapper">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route(currentUser().'Dashboard')}}">{{ currentUser() }}</a></li>
							<li class="breadcrumb-item"><a href="#">Restaurant</a></li>
							<li class="breadcrumb-item active">Add New</li>
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
		<form class="form" action="{{ route(currentUser().'.info.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<div class="row form-group">
					<div class="col-md-3 mb-1">
						<label>State: <span class="text-danger sup">*</span></label>
						<select name="state_id" class="select2 form-control custom-select @if($errors->has('state_id')) {{ 'is-invalid' }} @endif" style="width: 100%; height:36px;">
							<option hidden>Choose State</option>
							@if(count($states) > 0)
							@foreach($states as $stat)
							<option value="{{ $stat->id }}">{{ $stat->name }}</option>
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
						<input type="text" name="name" value="{{ old('name') }}" class="form-control @if($errors->has('name')) {{ 'is-invalid' }} @endif" placeholder="Restaurant name" />
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
						<input type="text" name="latitude" class="form-control" value="{{old('latitude') }}" />
					</div>
					<div class="col-lg-2 mb-1">
						<label> Longitude: </label>
						<input type="text" name="longitude" class="form-control" value="{{old('longitude') }}" />
					</div>

				</div>
				<div class="form-group row">
					<div class="col-lg-4 mb-1">
						<label> Delivery Time: </label>
						<select name="delivery_time" class="select2 form-control">
							<option hidden>Choose Delivery Slot</option>
							<option value="1">15-20 Min</option>
							<option value="2">20-30 Min</option>
							<option value="3">30-40 Min</option>
							<option value="4">40-50 Min</option>
						</select>
					</div>
					<div class="col-lg-4 mb-1">
						<label> Phone: </label>
						<input type="text" name="phone" class="form-control" value="{{old('phone') }}" />

					</div>
					<div class="col-lg-4 mb-1">
						<label> Mobile: </label>
						<input type="text" name="mobile" class="form-control" value="{{old('mobile') }}" />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="available_for_delivery" name="available_for_delivery">
								<label class="form-check-label" for="available_for_delivery">Is Available For Delivery</label>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="closed" name="closed">
								<label class="form-check-label" for="closed">Is Closed</label>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="active" name="active">
								<label class="form-check-label" for="active">Is Active</label>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="isPromoted" name="isPromoted">
								<label class="form-check-label" for="isPromoted">Is Promoted</label>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="isPopular" name="isPopular">
								<label class="form-check-label" for="isPopular">Is Populard</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-4 mb-1">
						<label> Opening Time: </label>
						<input type="time" name="opening_time" class="form-control" value="{{old('opening_time') }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Closing Time: </label>
						<input type="time" name="closing_time" class="form-control" value="{{old('closing_time') }}" />
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
						<textarea name="address" class="form-control">{{old('address') }}</textarea>
					</div>
					<div class="col-lg-6 mb-1">
						<label> Other information: </label>
						<textarea name="infomation" class="form-control">{{old('infomation') }}</textarea>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-lg-12 mb-1">
						<label> Description: </label>
						<textarea name="description" class="form-control" id="editor">{{ old('description') }}</textarea>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-lg-4"></div>
					<div class="col-lg-8">
						<button type="submit" class="btn btn-primary mr-2">Submit</button>
						<button type="reset" class="btn btn-secondary">Cancel</button>
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
		/* var quill = new Quill('#editor', {
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



			$('[name=state_id]').on('change', function() {
				var stateId = $(this).val();
				if (stateId) {
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
									console.log(city);
									$('select[name="city_id"]').append('<option value="' + city.id + '">' + city.name + '</option>');
								});
							} else {
								$('#city_id').empty();
							}
						}
					});
				} else {
					$('#city_id').empty();
				}
			});
		});
	</script>
	@endpush