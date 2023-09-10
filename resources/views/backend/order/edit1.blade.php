@extends('backend.layout.admin_master')
@section('title', 'Edit Product')
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
            <h2 class="content-header-title float-start mb-0">Product Edit</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route(currentUser().'Dashboard')}}">{{ currentUser() }}</a></li>
				<li class="breadcrumb-item"><a href="#">Product</a></li>
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
	<form class="form" action="{{ route(currentUser().'.updateFood') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="hidden" value="{{Session::get('user')}}" name="userId">
		<input type="hidden" value="{{encryptor('encrypt', $data->id)}}" name="id">
		<div class="card-body">
            <div class="row form-group">
			<div class="col-lg-8 mb-1">
					<label> Food Item Name:  <span class="text-danger sup">*</span></label>
					<input type="text" name="name" value="{{ old('name', $data->name) }}" class="form-control @if($errors->has('name')) {{ 'is-invalid' }} @endif" placeholder="Food Item name"/>
					@if($errors->has('name'))
					<small class="d-block text-danger mb-3">
						{{ $errors->first('name') }}
					</small>
					@endif
				</div>

				
				

		
                <div class="col-md-4 mb-1">
					<label>Product Type / Category: <span class="text-danger sup">*</span></label>
					<select name="category_id" class="select2 form-control custom-select @if($errors->has('category')) {{ 'is-invalid' }} @endif" style="width: 100%; height:36px;">
						@if(count($allCategory) > 0)
    						@foreach($allCategory as $cat)
    						    <option value="{{ $cat->id }}"  @if($cat->id==$data->categoryId) selected @endif>{{ $cat->name }}</option>
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
					<input type="file" name="thumbnail" class="form-control"/>
				</div>
				<div class="col-lg-4 mb-1">
					<label> Price:  </label>
					<input type="text" name="price" class="form-control @if($errors->has('price')) {{ 'is-invalid' }} @endif" value="{{ old('price', $data->price) }}"/>
					@if($errors->has('price'))
					<small class="d-block text-danger mb-3">
						{{ $errors->first('price') }}
					</small>
					@endif
				</div>
				<div class="col-lg-2 mb-1">
					<label> Discount Price:  </label>
					<input type="text" name="discount_price" class="form-control" value="{{ old('name', $data->discount_price) }}"/>
				</div>
				<div class="col-lg-2 mb-1">
					<label> Unit:  </label>
					<input type="text" name="unit" class="form-control" value="{{ old('name', $data->unit) }}"/>
				</div>
				
			</div>
			<div class="col-lg-2">
                                                <div class="mb-1">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="featured" name="featured" @if($data->featured ==1 ) checked @endif>
                                                        <label class="form-check-label" for="featured">Is Featured</label>
                                                    </div>
                                                </div>
                                            </div>
											<div class="col-lg-2">
                                                <div class="mb-1">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="deliverable" name="deliverable" @if($data->deliverable ==1 ) checked @endif>
                                                        <label class="form-check-label" for="deliverable">Deliverable Product</label>
                                                    </div>
                                                </div>
                                            </div>
			<div class="form-group row">
				<div class="col-lg-12 mb-1">
					<label> Description:  </label>
					<textarea name="description" class="form-control" id="editor">{{ old('description', $data->description) }}</textarea>
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
  var quill = new Quill('#editor', {
    theme: 'snow'
  });

	    // when page is ready
	/*	$(document).ready(function() {
			$('.form-check-input').change(function(){
		
				$(this).val($(this).attr('checked') ? '1' : '0');
});
    })*/
	$( document ).ready(function() {
        // Checkbox instead of on:off 1:0
        $('input:checkbox').on('change', function(){
          this.value = this.checked ? 1 : 0;
        }).change();
      });
</script>
@endpush