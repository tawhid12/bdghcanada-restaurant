@extends('backend.layout.admin_master')
@section('title', 'Add New Coupon')
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
					<h2 class="content-header-title float-start mb-0">Add Coupon</h2>
					<div class="breadcrumb-wrapper">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route(currentUser().'Dashboard')}}">{{ currentUser() }}</a></li>
							<li class="breadcrumb-item"><a href="#">Coupon</a></li>
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
		<form class="form" action="{{ route(currentUser().'.coupon.update',$coupon->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('put')
			<div class="card-body">
				<div class="row form-group">
					<div class="col-lg-4 mb-1">
						<label> Coupon Name: <span class="text-danger sup">*</span></label>
						<input type="text" name="name" value="{{ old('name', $coupon->name) }}" class="form-control @if($errors->has('name')) {{ 'is-invalid' }} @endif" placeholder="Food Item name" />
						@if($errors->has('name'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('name') }}
						</small>
						@endif
					</div>

					<div class="col-lg-4 mb-1">
						<label> Coupon Code: <span class="text-danger sup">*</span></label>
						<input type="text" name="code" value="{{ old('code',$coupon->code) }}" class="form-control @if($errors->has('code')) {{ 'is-invalid' }} @endif" placeholder="Food Item name" />
						@if($errors->has('code'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('code') }}
						</small>
						@endif
					</div>
					<div class="col-md-4 mb-1">
						<label>Coupon Icon:</label>
						<input type="file" name="icon" class="form-control" />
					</div>



</div>


<div class="form-group row">


					<div class="col-lg-3 mb-1">
						<label> Discount Type: </label>
						<select class="select2 form-control custom-select" name="discount_type">
							<option hidden>Choose Discount Type</option>
							<option value="1" @if($coupon->discount_type == 1) selected @endif>Percentage</option>
							<option value="2" @if($coupon->discount_type == 2) selected @endif>Fixed</option>
						</select>
						<p class="text-muted">Type Fixed amount or Percentage in discount</p>
					</div>
					<div class="col-lg-2 mb-1">
						<label> Discount: </label>
						<input type="text" name="discount" class="form-control @if($errors->has('discount')) {{ 'is-invalid' }} @endif" value="{{old('discount',$coupon->discount) }}" />
						@if($errors->has('discount'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('discount') }}
						</small>
						@endif
					</div>
					<div class="col-lg-2 mb-1">
						<label> Max Discount: </label>
						<input type="text" name="max_discount" class="form-control @if($errors->has('max_discount')) {{ 'is-invalid' }} @endif" value="{{old('max_discount',$coupon->max_discount) }}" />
						@if($errors->has('max_discount'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('max_discount') }}
						</small>
						@endif
					</div>
					<div class="col-lg-3 mb-1">
						<label> Expairy Date: </label>
						<input type="date" name="expires_at" class="form-control @if($errors->has('expires_at')) {{ 'is-invalid' }} @endif" value="{{old('discount',$coupon->expires_at) }}" />
						@if($errors->has('expires_at'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('expires_at') }}
						</small>
						@endif
					</div>
					<div class="col-lg-2">
						<div class="mb-1">
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="enabled" name="enabled"  @if($coupon->enabled ==1 ) checked @endif>
								<label class="form-check-label" for="enabled">Is Enabled</label>
							</div>
						</div>
					</div>

				</div>
				
				
				<div class="form-group row">
					<div class="col-lg-12 mb-1">
						<label> Description: </label>
						<textarea name="description" class="form-control" id="editor">{{ old('description',$coupon->description) }}</textarea>
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