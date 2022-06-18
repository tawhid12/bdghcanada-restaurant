@extends('backend.layout.admin_master')
@section('title', 'Edit City')
@section('content')
<div class="card card-custom">
	<div class="card-header flex-wrap border-0 pt-6 pb-0">
		<div class="card-title">
			<h3 class="card-label">Edit City
			<span class="d-block text-muted pt-2 font-size-sm"></span></h3>
			<!--begin::Breadcrumb-->
			<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
				<li class="breadcrumb-item">
					<a href="" class="text-muted">Home</a>
				</li>
				<li class="breadcrumb-item">
					<a href="" class="text-muted">City</a>
				</li>
			</ul>
			<!--end::Breadcrumb-->
		</div>
	</div>
	<!--end::Subheader-->
	<div class="content flex-column-fluid" id="kt_content">
			<div class="row">
				<div class="col-lg-12">
					<!--begin::Card-->
					<div class="card card-custom gutter-b example example-compact">
						<div class="card-header">
							<h3 class="card-title">Edit City</h3>
						</div>
						<!--begin::Form-->
						<form class="form" action="{{ route(currentUser().'.updateCity') }}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="hidden" name="id" value="{{ encryptor('encrypt', $city->id) }}">
							<!--begin::Card Body-->
						<div class="card-body">
							<div class="form-group row">
								<div class="col-lg-4">
									<label class="control-label">Select Provience</label>
									<select name="stateId" class="form-control">
										<option value="">--Select--</option>
										@forelse($states as $state)
										<option value="{{$state->id}}" @if($city->stateId == $state->id) selected @endif>{{$state->name}}</option>
										@empty
										@endforelse
									</select>
								</div>
								<div class="col-lg-4">
									<label class="control-label">City Code</label>
									<input type="text" name="code" value="{{ $city->code }}" class="form-control @if($errors->has('code')) {{ 'is-invalid' }} @endif" placeholder="City Code" />
									@if($errors->has('code'))
										<small class="d-block text-danger mb-3">
											{{ $errors->first('code') }}
										</small>
									@endif
								</div>
								<div class="col-lg-4">
									<label class="control-label">City Name</label>
									<input type="text" name="name" value="{{ $city->name }}" class="form-control @if($errors->has('name')) {{ 'is-invalid' }} @endif" placeholder="City Name" />
									@if($errors->has('name'))
										<small class="d-block text-danger mb-3">
											{{ $errors->first('name') }}
										</small>
									@endif
								</div>
                            </div>
						</div>
						<!--end card-body-->
                        <div class="card-footer">
							<div class="row">
								<div class="col-lg-4"></div>
								<div class="col-lg-8">
									<button type="submit" class="btn btn-primary mr-2">Update</button>
									<button type="reset" class="btn btn-secondary">Cancel</button>
								</div>
							</div>
						</div>
                        <!--end card-footer-->
						</form>
						<!--end::Form-->
					</div><!--end card-body-->
					</div><!--end card-->
				</div> <!-- end col -->
			</div> <!-- end row -->
		</div><!-- container -->
@endsection