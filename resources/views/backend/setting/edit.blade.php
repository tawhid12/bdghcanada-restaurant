@extends('backend.layout.admin_master')
@section('title', 'Edit Company Profile')
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
					<h2 class="content-header-title float-start mb-0">Edit Settings</h2>
					<div class="breadcrumb-wrapper">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route(currentUser().'Dashboard')}}">{{ currentUser() }}</a></li>
							<li class="breadcrumb-item"><a href="#">Company Profile</a></li>
							<li class="breadcrumb-item active">Settings</li>
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
		<form class="form" action="{{ route(currentUser().'.settings.update',$setting->id) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('put')
			<div class="card-body">
				<div class="row form-group">
					<div class="col-lg-4 mb-1">
						<label> Name: <span class="text-danger sup">*</span></label>
						<input type="text" name="name" value="{{ old('name', $setting->name) }}" class="form-control @if($errors->has('name')) {{ 'is-invalid' }} @endif" placeholder="Food Item name" />
						@if($errors->has('name'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('name') }}
						</small>
						@endif
					</div>
					<div class="col-lg-4 mb-1">
						<label> Phone: </label>
						<input type="text" name="phone" class="form-control" value="{{old('phone',$setting->phone) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Mobile: </label>
						<input type="text" name="mobile" class="form-control" value="{{old('mobile',$setting->mobile) }}" />
					</div>
					<div class="col-md-4 mb-1">
						<label>Coupon Icon:</label>
						<input type="file" name="logo" class="form-control" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Facebook: </label>
						<input type="text" name="facebook" class="form-control" value="{{old('facebook',$setting->facebook) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Youtube: </label>
						<input type="text" name="youtube" class="form-control" value="{{old('youtube',$setting->youtube) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Twitter: </label>
						<input type="text" name="twitter" class="form-control" value="{{old('twitter',$setting->twitter) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Google Plus: </label>
						<input type="text" name="google_plus" class="form-control" value="{{old('google_plus',$setting->google_plus) }}" />
					</div>
					<div class="col-lg-4 mb-1">
						<label> Instagram: </label>
						<input type="text" name="instatagram" class="form-control" value="{{old('instatagram',$setting->instatagram) }}" />
					</div>
					<div class="col-lg-2 mb-1">
						<label> GST: </label>
						<input type="text" name="gst" class="form-control @if($errors->has('gst')) {{ 'is-invalid' }} @endif" value="{{old('gst',$setting->gst) }}" />
						@if($errors->has('gst'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('gst') }}
						</small>
						@endif
					</div>
					<div class="col-lg-2 mb-1">
						<label> HST: </label>
						<input type="text" name="hst" class="form-control @if($errors->has('hst')) {{ 'is-invalid' }} @endif" value="{{old('hst',$setting->hst) }}" />
						@if($errors->has('hst'))
						<small class="d-block text-danger mb-3">
							{{ $errors->first('hst') }}
						</small>
						@endif
					</div>


				</div>


				<div class="form-group row">
					<div class="col-lg-12 mb-1">
						<label> Address: </label>
						<textarea name="address" class="form-control" id="editor">{{ old('address',$setting->address) }}</textarea>
					</div>
				</div>


			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-lg-4"></div>
					<div class="col-lg-8">
						<button type="submit" class="btn btn-primary mr-2">Update</button>
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