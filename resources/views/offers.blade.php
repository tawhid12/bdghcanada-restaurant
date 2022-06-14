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
            @php
                $offers = \App\Models\Coupon::all();
            @endphp
            @forelse($offers as $offer)
            <div class="col-md-4 mb-3">
                <div class="card offer-card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><img src="{{asset('')}}assets/img/bank/1.png">{{$offer->code}}</h5>
                        <h6 class="card-subtitle mb-2 text-block">Get {{$offer->discount}}% OFF on your first BDHScanada order</h6>
                        <p class="card-text">Use code {{$offer->code}} & get {{$offer->discount}}% off on your first BDHScanada order on Website and Mobile site. Maximum discount: ${{$offer->max_discount}}</p>
                        <a href="#" class="card-link">COPY CODE</a>
                        <a href="#" class="card-link">KNOW MORE</a>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
<!-- Restaurant login redirect -->
@include('blade_components.restaurant-join')
    <!-- Newsletter redirect -->
    @include('blade_components.newsletter')
@endsection