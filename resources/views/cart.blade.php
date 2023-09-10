@extends('layouts.master')
@section('content')
<!-- top nav bar -->
@include('blade_components.nav-bar')
<section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
    <h1 class="text-white">Cart Page</h1>
    <h6 class="text-white-50">Explore top deals and offers exclusively for you!</h6>
</section>
<section class="section pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-weight-bold mt-0 mb-3 text-center">Available Cart Item</h4>
                <div class="dropdown-cart-top-header p-4">
                    <img class="img-fluid mr-3" alt="osahan" src="img/cart.jpg">
                    <h6 class="mb-0">Gus's World Famous Chicken</h6>
                    <p class="text-secondary mb-0">310 S Front St, Memphis, USA</p>
                    <small><a class="text-primary font-weight-bold" href="#">View Full Menu</a></small>
                </div>
                <div class="dropdown-cart-top-body border-top p-4">
                    <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka Sub
                        12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                    <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Corn &amp; Peas
                        Salad x 1 <span class="float-right text-secondary">$209</span></p>
                    <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Veg Seekh Sub 6"
                        (15 cm) x 1 <span class="float-right text-secondary">$133</span></p>
                    <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka Sub
                        12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                    <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Corn &amp; Peas Salad
                        x 1 <span class="float-right text-secondary">$209</span></p>
                </div>
                <div class="dropdown-cart-top-footer border-top p-4">
                    <p class="mb-0 font-weight-bold text-secondary">Sub Total <span class="float-right text-dark">$499</span></p>
                    <small class="text-info">Extra charges may apply</small>
                </div>
                <div class="dropdown-cart-top-footer border-top p-2">
                    <a class="btn btn-success btn-block btn-lg" href="checkout.html"> Checkout</a>
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