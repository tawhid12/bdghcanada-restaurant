@extends('layouts.master')
@section('title', 'Customer | Dashboard')

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
                            @php 
                            $UserData = \App\Models\User::where("id", currentUserId())->first();
					        $photo= $UserData->details->photo 
                            @endphp
                            @if($photo)
                            <img class="mb-3 rounded-pill shadow-sm mt-1" src="{{asset('storage/app/public/images/user/photo/'.$photo)}}" alt="user profile picture">
                            @else
                            <img class="mb-3 rounded-pill shadow-sm mt-1" src="{{asset('/')}}storage/app/public/images/user/photo/{{ Session::get('uphoto') }}" alt="User avatar">
                            @endif
                            <div class="osahan-user-media-body">
                                <h6 class="mb-2">{{encryptor('decrypt', Session::get('name'))}}</h6>
                                <p class="mb-1">{{encryptor('decrypt', Session::get('mobileNumber'))}}</p>
                                <p>{{encryptor('decrypt', Session::get('email'))}}</p>
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
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false"><i class="icofont-credit-card"></i> Payments</a>
                    </li> -->
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
                        $orders = \App\Models\Order::where('user_id','=',currentUserId())->get();
                        @endphp
                        @forelse($orders as $order)
                        @php
                        $cart=json_decode(base64_decode($order->cart),true);
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
                        @empty
                        <p class="text-danger">No Orders</p>
                        @endforelse
                    </div>
                    <div class="tab-pane fade" id="offers" role="tabpanel" aria-labelledby="offers-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Offers</h4>
                        <div class="row mb-4 pb-2">
                            @php
                            $offers = \App\Models\Coupon::all();
                            @endphp
                            @forelse($offers as $offer)
                            <div class="col-md-6 mb-3">
                                <div class="card offer-card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title"><img src="img/bank/1.png"></h5>
                                        <h6 class="card-subtitle mb-2 text-block">Get {{$offer->discount}}% OFF on your first BDHScanada order</h6>
                                        <p class="card-text">Use code {{$offer->code}} &amp; get {{$offer->discount}}% off on your first BDHScanada order on Website and Mobile site. Maximum discount: ${{$offer->max_discount}}</p>
                                        <a href="#" class="card-link">COPY CODE</a>
                                        <a href="#" class="card-link">KNOW MORE</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            @endforelse
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

                            <div class="col-md-12 text-center load-more">
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
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
                    </div> -->
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<!-- Newsletter redirect -->
@include('blade_components.newsletter')


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
            <form method="post">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Phone number
                        </label>
                        <input type="text" value="{{encryptor('decrypt', Session::get('mobileNumber'))}}" class="form-control" placeholder="Enter Phone number">
                    </div>
                    <!-- <div class="form-group col-md-12">
                        <label>Email id
                        </label>
                        <input type="text" value="iamosahan@gmail.com" class="form-control" placeholder="Enter Email id">
                    </div> -->
                    <div class="form-group col-md-12 mb-0">
                        <label>Password
                        </label>
                        <input type="password" value="**********" class="form-control" placeholder="Enter password">
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
@endsection
@push('scripts')

<script>
    @if(Session::has('response'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr. {{Session::get('response')['class']}}("{{Session::get('response')['message']}}");
    @endif
</script>
@endpush