@extends('layouts.master')
@section('content')                    
    <!-- top nav bar -->
    @include('blade_components.nav-bar')
    <!-- top Homepage Search -->
    @include('blade_components.homepage-search')
    <!-- Popular Brand -->
    {{--@include('blade_components.states')--}}
    <!-- top Homepage Search -->
    @include('blade_components.homepage-add-section')
    <!-- Popular Brand -->
    @include('blade_components.popular')
    <!-- customer login redirect -->
    @include('blade_components.customer-login')
    <!-- Restaurant login redirect -->
    @include('blade_components.restaurant-join')
    <!-- Newsletter redirect -->
    @include('blade_components.newsletter')
@endsection