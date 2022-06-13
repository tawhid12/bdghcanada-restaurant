@extends('layouts.master')
@section('content')
<!-- top nav bar -->
@include('blade_components.nav-bar')
<section class="section pt-4 pb-4 osahan-account-page">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="osahan-account-page-left shadow-sm bg-white h-100">
                <div class="border-bottom p-4">
                    <div class="osahan-user text-center">
                        <div class="osahan-user-media">
                            <img class="mb-3 rounded-pill shadow-sm mt-1" src="img/user/4.png" alt="gurdeep singh osahan">
                            <div class="osahan-user-media-body">
                                <h6 class="mb-2">Gurdeep Singh</h6>
                                <p class="mb-1">+91 85680-79956</p>
                                <p><a href="https://askbootstrap.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1c757d71736f7d747d725c7b717d7570327f7371">[email&#160;protected]</a></p>
                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#edit-profile-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true"><i class="icofont-food-cart"></i> Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="offers-tab" data-toggle="tab" href="#offers" role="tab" aria-controls="offers" aria-selected="false"><i class="icofont-sale-discount"></i> Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="favourites-tab" data-toggle="tab" href="#favourites" role="tab" aria-controls="favourites" aria-selected="false"><i class="icofont-heart"></i> Favourites</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false"><i class="icofont-credit-card"></i> Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="addresses" aria-selected="false"><i class="icofont-location-pin"></i> Addresses</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="osahan-account-page-right shadow-sm bg-white p-4 h-100">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Orders Summary</h4>
                        @php
                        $restaurant_id = array_column($cart['cart'], 'restaurant_id');
                        $restaurant = \App\Models\Restaurant::find($restaurant_id[0]);
                        @endphp
                        
                        <div class="bg-white card mb-4 order-list shadow-sm">
                            <div class="gold-members p-4">
                                <a href="#">
                                    <div class="media">
                                        <img class="mr-4" src="{{asset('/')}}storage/app/public/images/logo/{{$restaurant->logo}}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <span class="float-right text-info">Delivered on Mon, Nov 12, 7:18 PM <i class="icofont-check-circled text-success"></i></span>
                                            <h6 class="mb-2">
                                                <a href="{{route('restaurantDetl',$restaurant->id)}}" class="text-black">{{$restaurant->name}}</a>
                                            </h6>
                                            <p class="text-gray mb-1"><i class="icofont-location-arrow"></i>{{$restaurant->address}}
                                            </p>
                                            <p class="text-gray mb-3"><i class="icofont-list"></i> ORDER #{{$order->id}} <i class="icofont-clock-time ml-2"></i> {{date('D, M d, h:i:a', strtotime($order->created_at))}}</p>
                                            <p class="text-dark">
                                            @if(count($cart['cart'])>0)
                                                @foreach($cart['cart'] as $key => $item)
                                                    @php
                                                    $ordered_items = array();
                                                    $ordered_items[] = $item['name']." x ".$item['quantity'].",";
                                                    echo implode(',',$ordered_items);
                                                    @endphp
                                                @endforeach
                                            @endif
                                            </p>
                                            <hr>
                                            <div class="float-right">
                                                <a class="btn btn-sm btn-outline-primary" href="#"><i class="icofont-headphone-alt"></i> HELP</a>
                                                <a class="btn btn-sm btn-primary" href="{{route('restaurantDetl',$restaurant->id)}}"><i class="icofont-refresh"></i> REORDER</a>
                                            </div>
                                            <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Total Paid:</span> ${{$cart['cal_cart']['sub_total']}}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                       
                    </div>
                    <div class="tab-pane fade" id="offers" role="tabpanel" aria-labelledby="offers-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Offers</h4>
                        <div class="row mb-4 pb-2">
                            <div class="col-md-6">
                                <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><img src="img/bank/1.png"> OSAHANEAT50</h5>
                                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                                        <p class="card-text">Use code OSAHANEAT50 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $200</p>
                                        <a href="#" class="card-link">COPY CODE</a>
                                        <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><img src="img/bank/2.png"> EAT730</h5>
                                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                                        <p class="card-text">Use code EAT730 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                                        <a href="#" class="card-link">COPY CODE</a>
                                        <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4 pb-2">
                            <div class="col-md-6">
                                <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><img src="img/bank/3.png"> SAHAN50</h5>
                                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                                        <p class="card-text">Use code SAHAN50 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $200</p>
                                        <a href="#" class="card-link">COPY CODE</a>
                                        <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><img src="img/bank/4.png"> GURDEEP50</h5>
                                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                                        <p class="card-text">Use code GURDEEP50 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                                        <a href="#" class="card-link">COPY CODE</a>
                                        <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><img src="img/bank/1.png"> OSAHANEAT50</h5>
                                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                                        <p class="card-text">Use code OSAHANEAT50 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $200</p>
                                        <a href="#" class="card-link">COPY CODE</a>
                                        <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><img src="img/bank/2.png"> EAT730</h5>
                                        <h6 class="card-subtitle mb-2 text-block">Get 50% OFF on your first Food Line order</h6>
                                        <p class="card-text">Use code EAT730 &amp; get 50% off on your first osahan order on Website and Mobile site. Maximum discount: $600</p>
                                        <a href="#" class="card-link">COPY CODE</a>
                                        <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="favourites" role="tabpanel" aria-labelledby="favourites-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Favourites</h4>
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                        <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                        <a href="detail.html">
                                            <img src="img/list/4.png" class="img-fluid item-img">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="detail.html" class="text-black">Famous Dave's Bar-B-Que
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-3">Vegetarian • Indian • Pure veg</p>
                                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–30 min</span> <span class="float-right text-black-50"> $350 FOR TWO</span></p>
                                        </div>
                                        <div class="list-card-badge">
                                            <span class="badge badge-danger">OFFER</span> <small> Use Coupon OSAHAN50</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                        <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                        <a href="detail.html">
                                            <img src="img/list/5.png" class="img-fluid item-img">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="detail.html" class="text-black">Thai Famous Cuisine</a></h6>
                                            <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 30–35 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                        </div>
                                        <div class="list-card-badge">
                                            <span class="badge badge-success">OFFER</span> <small>65% off</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                        <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                        <a href="detail.html">
                                            <img src="img/list/6.png" class="img-fluid item-img">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="detail.html" class="text-black">The osahan Restaurant
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                                        </div>
                                        <div class="list-card-badge">
                                            <span class="badge badge-danger">OFFER</span> <small>65% OSAHAN50</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                        <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                        <a href="detail.html">
                                            <img src="img/list/7.png" class="img-fluid item-img">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="detail.html" class="text-black">Stan's Restaurant
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                        </div>
                                        <div class="list-card-badge">
                                            <span class="badge badge-danger">OFFER</span> <small>65% Coupon OSAHAN50</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                        <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                        <a href="detail.html">
                                            <img src="img/list/8.png" class="img-fluid item-img">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="detail.html" class="text-black">Polo Lounge
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                        </div>
                                        <div class="list-card-badge">
                                            <span class="badge badge-danger">OFFER</span> <small> Coupon OSAHAN50</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                        <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                        <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                        <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                        <a href="detail.html">
                                            <img src="img/list/9.png" class="img-fluid item-img">
                                        </a>
                                    </div>
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="detail.html" class="text-black">Jack Fry's
                                                </a>
                                            </h6>
                                            <p class="text-gray mb-3">North Indian • Indian • Pure veg</p>
                                            <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 15–25 min</span> <span class="float-right text-black-50"> $250 FOR TWO</span></p>
                                        </div>
                                        <div class="list-card-badge">
                                            <span class="badge badge-danger">OFFER</span> <small>65% </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center load-more">
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Payments</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-white card payments-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <a href="#">
                                            <div class="media">
                                                <img class="mr-3" src="img/bank/1.png" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                    <p>VALID TILL 10/2025</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card payments-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <a href="#">
                                            <div class="media">
                                                <img class="mr-3" src="img/bank/2.png" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                    <p>VALID TILL 10/2025</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2 pb-2">
                            <div class="col-md-6">
                                <div class="bg-white card payments-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <a href="#">
                                            <div class="media">
                                                <img class="mr-3" src="img/bank/3.png" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                    <p>VALID TILL 10/2025</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card payments-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <a href="#">
                                            <div class="media">
                                                <img class="mr-3" src="img/bank/4.png" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                    <p>VALID TILL 10/2025</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-white card payments-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <a href="#">
                                            <div class="media">
                                                <img class="mr-3" src="img/bank/5.png" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                    <p>VALID TILL 10/2025</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card payments-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <a href="#">
                                            <div class="media">
                                                <img class="mr-3" src="img/bank/6.png" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                    <p>VALID TILL 10/2025</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-md-6">
                                <div class="bg-white card payments-item shadow-sm">
                                    <div class="gold-members p-4">
                                        <a href="#">
                                            <div class="media">
                                                <img class="mr-3" src="img/bank/1.png" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                    <p class="text-black">VALID TILL 10/2025</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card payments-item shadow-sm">
                                    <div class="gold-members p-4">
                                        <a href="#">
                                            <div class="media">
                                                <img class="mr-3" src="img/bank/2.png" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h6 class="mb-1">6070-XXXXXXXX-0666</h6>
                                                    <p>VALID TILL 10/2025</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Manage Addresses</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4 border border-primary shadow">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1 text-secondary">Home</h6>
                                                <p class="text-black">Osahan House, Jawaddi Kalan, Ludhiana, Punjab 141002, India
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4 shadow-sm">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Work</h6>
                                                <p>NCC, Model Town Rd, Pritm Nagar, Model Town, Ludhiana, Punjab 141002, India
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2 pb-2">
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4  shadow-sm">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Other</h6>
                                                <p>Delhi Bypass Rd, Jawaddi Taksal, Ludhiana, Punjab 141002, India
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4  shadow-sm">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Other</h6>
                                                <p>MT, Model Town Rd, Pritm Nagar, Model Town, Ludhiana, Punjab 141002, India
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item shadow-sm">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Other</h6>
                                                <p>GNE Rd, Jawaddi Taksal, Ludhiana, Punjab 141002, India
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item shadow-sm">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Other</h6>
                                                <p>GTTT, Model Town Rd, Pritm Nagar, Model Town, Ludhiana, Punjab 141002, India
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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



<!-- Address Delete -->

<div class="modal fade" id="delete-address-modal" tabindex="-1" role="dialog" aria-labelledby="delete-address" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-address">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0 text-black">Are you sure you want to delete this xxxxx?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">DELETE</button>
            </div>
        </div>
    </div>
</div>
<!-- Add Delivery Address -->
<div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-address">Add Delivery Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Delivery Area</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Delivery Area">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-ui-pointer"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Complete Address
                            </label>
                            <input type="text" class="form-control" placeholder="Complete Address e.g. house number, street name, landmark">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Delivery Instructions
                            </label>
                            <input type="text" class="form-control" placeholder="Delivery Instructions e.g. Opposite Gold Souk Mall">
                        </div>
                        <div class="form-group mb-0 col-md-12">
                            <label for="inputPassword4">Nickname
                            </label>
                            <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> Home
                                </label>
                                <label class="btn btn-info">
                                    <input type="radio" name="options" id="option2" autocomplete="off"> Work
                                </label>
                                <label class="btn btn-info">
                                    <input type="radio" name="options" id="option3" autocomplete="off"> Other
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile -->
<div class="modal fade" id="edit-profile-modal" tabindex="-1" role="dialog" aria-labelledby="edit-profile" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-profile">Edit profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Phone number
                            </label>
                            <input type="text" value="+91 85680-79956" class="form-control" placeholder="Enter Phone number">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Email id
                            </label>
                            <input type="text" value="iamosahan@gmail.com" class="form-control" placeholder="Enter Email id
                              ">
                        </div>
                        <div class="form-group col-md-12 mb-0">
                            <label>Password
                            </label>
                            <input type="password" value="**********" class="form-control" placeholder="Enter password
                              ">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">UPDATE</button>
            </div>
        </div>
    </div>
</div>
<!-- Restaurant login redirect -->
@include('blade_components.restaurant-join')
<!-- Newsletter redirect -->
@include('blade_components.newsletter')
@endsection