@extends('backend.layout.admin_master')
@section('title', 'Owner | Dashboard')
@push('styles')
    <style>
        .congratulation-medal {
            right: 0 !important;
        }
    </style>
@endpush
@section('content')
<div class="content-body">

            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce" class="home-dashboard">

                <div class="row match-height">




                    <!-- Medal Card -->
                    <div class="col-xl-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h3>Restaurant</h3>
                                    <p class="card-text font-small-3">All the Restaurant you can easily findout from here..
                                    </p>
                                    <h5 class="mb-75 mt-2 pt-50">
                                        Total-Restaurant : <span class=" font-weight-bold text-secondary ">{{--$products[0]->pcount--}}</span>
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

            </section>
            <!-- Dashboard Ecommerce ends -->

        </div> 
@endsection
@push('scripts')
@endpush
