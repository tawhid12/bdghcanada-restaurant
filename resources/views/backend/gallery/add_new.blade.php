@extends('backend.layout.admin_master')
@section('title', 'Add new Restauran')
@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Add Gallery</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route(currentUser().'Dashboard')}}">{{ currentUser() }}</a></li>
				<li class="breadcrumb-item"><a href="#">Gallery</a></li>
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
		<form class="form" action="{{ route(currentUser().'.gallery.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="hidden" value="{{ Session::get('user') }}" name="userId">
			<div class="card-body">
				<div class="form-group row">
				<div class="col-md-6 mb-1">
					<label>Restaurant Name: <span class="text-danger sup">*</span></label>
					<select name="restaurant_id" class="select2 form-control custom-select @if($errors->has('restaurant_id')) {{ 'is-invalid' }} @endif" style="width: 100%; height:36px;">
					<option hidden>Choose Restaurant</option>
						@if(count($restaurants) > 0)
    						@foreach($restaurants as $res)
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
					<div class="col-lg-6">
						<label>Upload Restaurant Gallery Image</label>
						<input type="file" class="form-control" name="gallery_img[]" accept=".png, .jpg, .jpeg" multiple/>
						<p class="text-muted">You May Upload Multiple Images</p>
						@if($errors->has('gallery_img'))
							<small class="d-block text-danger mb-3">
								{{ $errors->first('gallery_img') }}
							</small>
						@endif
					</div>

                
				
			</div>
			<!--end card-body-->
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
	</div> <!-- end row -->
</div><!-- container -->
@endsection
@push('scripts')
<script>
	var avatar1 = new KTImageInput('kt_image_1');
</script>
@endpush