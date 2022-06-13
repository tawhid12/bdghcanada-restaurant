@extends('backend.layout.admin_master')
@section('title', 'Superadmin | Dashboard')
@section('content')
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Dashboard</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="{{route(currentUser().'Dashboard')}}">{{ encryptor('decrypt', Session::get('username')) }}</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!--begin::Container-->
<div class="content-body">

			<div class="row match-height">
				
                    <!-- Medal Card -->
                    <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h3>Restaurant</h3>
                                    <p class="card-text font-small-3">All the Restaurant you can easily findout from here..
                                    </p>
                                    <h5 class="mb-75 mt-2 pt-50">
                                        Total-Restaurant : <span class=" font-weight-bold text-secondary ">{{$restaurants[0]->rcount}}</span>
                                    </h5>

                                    <div class=" justify-content-between bottom-button">
                                        <a href="{{--route(currentUser().'.allProduct')--}}" class="btn btn-gradient-primary">View</a>
                                        <a href="{{--route(currentUser().'.addNewProductForm')--}}" class="btn btn-gradient-success">Create</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h3>Food</h3>
                                    <p class="card-text font-small-3">All the Food you can easily findout from here..
                                    </p>
                                    <h5 class="mb-75 mt-2 pt-50">
                                        Total-Food Items: <span class=" font-weight-bold text-secondary ">{{$foods[0]->fcount}}</span>
                                    </h5>

                                    <div class=" justify-content-between bottom-button">
                                        <a href="{{--route(currentUser().'.allProduct')--}}" class="btn btn-gradient-primary">View</a>
                                        <a href="{{--route(currentUser().'.addNewProductForm')--}}" class="btn btn-gradient-success">Create</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--/ Medal Card -->
					 <!-- Medal Card -->
					 <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h3>Customer</h3>
                                    <p class="card-text font-small-3">All the Customer you can easily findout from here..
                                    </p>
                                    <h5 class="mb-75 mt-2 pt-50">
                                        Total-Customer : <span class=" font-weight-bold text-secondary ">{{$customers[0]->ccount}}</span>
                                    </h5>

                                    <div class=" justify-content-between bottom-button">
                                        <a href="{{--route(currentUser().'.allProduct')--}}" class="btn btn-gradient-primary">View</a>
                                        <a href="{{--route(currentUser().'.addNewProductForm')--}}" class="btn btn-gradient-success">Create</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--/ Medal Card -->
										 <!-- Medal Card -->
										 <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h3>Delivery Man</h3>
                                    <p class="card-text font-small-3">All the Delivery Man you can easily findout from here..
                                    </p>
                                    <h5 class="mb-75 mt-2 pt-50">
                                        Total-Delivery Man : <span class=" font-weight-bold text-secondary ">{{$delivery_man[0]->dcount}}</span>
                                    </h5>

                                    <div class=" justify-content-between bottom-button">
                                        <a href="{{--route(currentUser().'.allProduct')--}}" class="btn btn-gradient-primary">View</a>
                                        <a href="{{--route(currentUser().'.addNewProductForm')--}}" class="btn btn-gradient-success">Create</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--/ Medal Card -->
			</div>

</div>
<!--end::Container-->
@endsection

@push('scripts')
<script>
    @if( Session::has('response') )
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{Session::get('response')['message']}}");
    @endif
</script>
@endpush