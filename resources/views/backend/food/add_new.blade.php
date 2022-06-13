@extends('backend.layout.admin_master')
@section('title', 'Add New Food')
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
					<h2 class="content-header-title float-start mb-0">Add Food</h2>
					<div class="breadcrumb-wrapper">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route(currentUser().'Dashboard')}}">{{ currentUser() }}</a></li>
							<li class="breadcrumb-item"><a href="#">Food</a></li>
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
		<form class="form" action="{{ route(currentUser().'.addNewFood') }}" method="POST" enctype="multipart/form-data">
			@csrf

			<div class="card-body">
				<div class="row form-group">
					<div class="col-md-4 mb-1">
						<label>Select Restaurant: <span class="text-danger sup">*</span></label>
						<select name="restaurant_id" class="select2 form-control custom-select @if($errors->has('restaurant_id')) {{ 'is-invalid' }} @endif" style="width: 100%; height:36px;">
							<option hidden>Choose Restaurant</option>
							@if(count($allRestaurant) > 0)
							@foreach($allRestaurant as $res)
							<option value="{{ $res->id }}">{{ $res->name }}</option>
							@endforeach
							@endif
						</select>
						@if($errors->has('restaurant_id'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('restaurant_id') }}
						</small>
						@endif
					</div>
					<div class="col-lg-4 mb-1">
						<label> Food Item Name: <span class="text-danger sup">*</span></label>
						<input type="text" name="name" value="{{ old('name') }}" class="form-control @if($errors->has('name')) {{ 'is-invalid' }} @endif" placeholder="Food Item name" />
						@if($errors->has('name'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('name') }}
						</small>
						@endif
					</div>





					<div class="col-md-4 mb-1">
						<label>Product Type / Category: <span class="text-danger sup">*</span></label>
						<select name="category_id" class="select2 form-control custom-select @if($errors->has('category')) {{ 'is-invalid' }} @endif" style="width: 100%; height:36px;">
							<option hidden>Choose Category</option>
							@if(count($allCategory) > 0)
							@foreach($allCategory as $cat)
							<option value="{{ $cat->id }}">{{ $cat->name }}</option>
							@endforeach
							@endif
						</select>
						@if($errors->has('category'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('category') }}
						</small>
						@endif
					</div>
				</div>



				<div class="form-group row">
					<div class="col-md-4 mb-1">
						<label>Product Image:</label>
						<input type="file" name="thumbnail" class="form-control" />
					</div>
					<div class="col-lg-2 mb-1">
						<label> Price: </label>
						<input type="text" name="price" class="form-control @if($errors->has('name')) {{ 'is-invalid' }} @endif" value="{{old('price') }}" />
						@if($errors->has('price'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('price') }}
						</small>
						@endif
					</div>
					<div class="col-lg-3 mb-1">
						<label> Discount Type: </label>
						<select class="select2 form-control custom-select" name="discount_type">
							<option hidden>Choose Discount Type</option>
							<option value="1">Fixed</option>
							<option value="2">Percentage</option>
						</select>
						<p class="text-muted">Type Fixed amount or Percentage in discount price</p>
					</div>
					<div class="col-lg-2 mb-1">
						<label> Discount Price: </label>
						<input type="text" name="discount_price" class="form-control" value="{{old('discount_price') }}" />
						
					</div>
					<div class="col-lg-1 mb-1">
						<label> Unit: </label>
						<input type="text" name="unit" class="form-control" value="{{old('unit') }}" />
					</div>

				</div>
				<div class="form-group row">
					<div class="col-lg-4 mb-1">
						<label> Food Capacity: </label>
						<input type="text" name="capacity" class="form-control" value="{{old('capacity') }}" placeholder="2" />
						<p class="text-muted">Type How Many Person fit for this item</p>
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="featured" name="featured">
								<label class="form-check-label" for="featured">Is Featured</label>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="popular" name="popular">
								<label class="form-check-label" for="popular">Is Popular</label>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="deliverable" name="deliverable">
								<label class="form-check-label" for="deliverable">Deliverable Product</label>
							</div>
						</div>
					</div>

				</div>
				<div class="form-group row">
					<div class="col-12 mb-1">
						<label>Serve Days: </label>
						<div class="demo-inline-spacing">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="week_day[6]" id="Saturday" value="6">
								<label class="form-check-label" for="Saturday">Saturday</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="week_day[0]" id="Sunday" value="0">
								<label class="form-check-label" for="Sunday">Sunday</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="week_day[1]" id="Monday" value="1">
								<label class="form-check-label" for="Monday">Monday</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="week_day[2]" id="Tuesday" value="2">
								<label class="form-check-label" for="Tuesday">Tuesday</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="week_day[3]" id="Wednesday" value="3">
								<label class="form-check-label" for="Wednesday">Wednesday</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="week_day[4]" id="Thursday" value="4">
								<label class="form-check-label" for="Thursday">Thursday</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="week_day[5]" id="Friday" value="5">
								<label class="form-check-label" for="Friday">Friday</label>
							</div>
						</div>
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
		});
	</script>
	@endpush