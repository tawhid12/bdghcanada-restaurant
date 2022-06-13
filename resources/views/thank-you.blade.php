@extends('layouts.master')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/assets/vendors/css/extensions/toastr.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/assets/css/plugins/extensions/ext-component-toastr.min.css">
@endpush
@section('content')
<!-- top nav bar -->
@include('blade_components.nav-bar')
<section class="section pt-5 pb-5 osahan-not-found-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5 pb-5">
                <img class="img-fluid mb-5" src="{{asset('')}}assets/img/thanks.png" alt="404">
                <h1 class="mt-2 mb-2 text-success">Congratulations!</h1>
                <p class="mb-5">You have successfully placed your order</p>
                <a class="btn btn-primary btn-lg" href="{{route('view_order',$order)}}">View Order :)</a>
            </div>
        </div>
    </div>
</section>
<!-- Restaurant login redirect -->
@include('blade_components.restaurant-join')
<!-- Newsletter redirect -->
@include('blade_components.newsletter')
@endsection
@push('scripts')
<script src="{{asset('/')}}backend/assets/vendors/js/extensions/toastr.min.js"></script>
<script>
    @if(Session::has('response'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr. {
        {
            Session::get('response')['class']
        }
    }("{{Session::get('response')['message']}}");
    @endif
</script>
@endpush