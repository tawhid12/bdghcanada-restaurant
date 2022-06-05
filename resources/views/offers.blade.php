@extends('layouts.master')
@section('content')                    
    <!-- top nav bar -->
    @include('blade_components.nav-bar')
<section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
    <h1 class="text-white">Offers for you</h1>
    <h6 class="text-white-50">Explore top deals and offers exclusively for you!</h6>
</section>
<section class="section pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-weight-bold mt-0 mb-3">Available Coupons</h4>
            </div>
            <div class="col-md-4">
                <div class="card offer-card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><img src="{{asset('')}}assets/img/bank/1.png"> BDHSCANADA50</h5>
                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                        <p class="card-text">Use code BDHSCANADA50 & get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $200</p>
                        <a href="#" class="card-link">COPY CODE</a>
                        <a href="#" class="card-link">KNOW MORE</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card offer-card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><img src="{{asset('')}}assets/img/bank/2.png"> EAT730</h5>
                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                        <p class="card-text">Use code EAT730 & get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                        <a href="#" class="card-link">COPY CODE</a>
                        <a href="#" class="card-link">KNOW MORE</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card offer-card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><img src="{{asset('')}}assets/img/bank/3.png"> SAHAN50</h5>
                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                        <p class="card-text">Use code SAHAN50 & get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $200</p>
                        <a href="#" class="card-link">COPY CODE</a>
                        <a href="#" class="card-link">KNOW MORE</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 pt-2">
            <div class="col-md-4">
                <div class="card offer-card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><img src="{{asset('')}}assets/img/bank/4.png"> GURDEEP50</h5>
                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                        <p class="card-text">Use code GURDEEP50 & get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                        <a href="#" class="card-link">COPY CODE</a>
                        <a href="#" class="card-link">KNOW MORE</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card offer-card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><img src="{{asset('')}}assets/img/bank/5.png"> EA9T50</h5>
                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                        <p class="card-text">Use code EAT50 & get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $100</p>
                        <a href="#" class="card-link">COPY CODE</a>
                        <a href="#" class="card-link">KNOW MORE</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card offer-card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><img src="{{asset('')}}assets/img/bank/6.png"> ETTTAT50</h5>
                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                        <p class="card-text">Use code EAT50 & get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                        <a href="#" class="card-link">COPY CODE</a>
                        <a href="#" class="card-link">KNOW MORE</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-md-12">
                <h4 class="font-weight-bold mt-0 mb-3">Bank Offers</h4>
            </div>
            <div class="col-md-6">
                <div class="card offer-card-horizontal border-0 shadow-sm">
                    <div class="row d-flex align-items-center no-gutters">
                        <div class="col-md-4 col-4 p-4">
                            <img src="{{asset('')}}assets/img/bank/7.png" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="card-body">
                                <h5 class="card-title">Get flat $.30 cashback using Amazon Pay</h5>
                                <p class="card-text">Get flat $.30 cashback on orders above $.99 for 10 orders. No code required.</p>
                                <p class="card-text"><small class="text-info">Other T&Cs may apply
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card offer-card-horizontal border-0 shadow-sm">
                    <div class="row d-flex align-items-center no-gutters">
                        <div class="col-md-4 col-4 p-4">
                            <img src="{{asset('')}}assets/img/bank/8.png" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8 col-8">
                            <div class="card-body">
                                <h5 class="card-title">Get flat $.30 cashback using Osahan Pay</h5>
                                <p class="card-text">Get flat $.30 cashback on orders above $.99 for 10 orders. No code required.</p>
                                <p class="card-text"><small class="text-info">Other T&Cs may apply
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Restaurant login redirect -->
@include('blade_components.restaurant-join')
    <!-- Newsletter redirect -->
    @include('blade_components.newsletter')
@endsection