@extends('layouts.master')
@section('content')                    
    <!-- top nav bar -->
    @include('blade_components.nav-bar')
<section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
    <h1 class="text-white">Offers Near You</h1>
    <h6 class="text-white-50">Best deals at your favourite restaurants</h6>
</section>
<section class="section pt-5 pb-5 products-listing">
    <div class="container">
        <div class="row d-none-m">
            <div class="col-md-12">
                <div class="dropdown float-right">
                    <a class="btn btn-outline-info dropdown-toggle btn-sm border-white-btn" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sort by: <span class="text-theme">Distance</span> &nbsp;&nbsp;
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 ">
                        <a class="dropdown-item" href="#">Distance</a>
                        <a class="dropdown-item" href="#">No Of Offers</a>
                        <a class="dropdown-item" href="#">Rating</a>
                    </div>
                </div>
                <h4 class="font-weight-bold mt-0 mb-3">OFFERS <small class="h6 mb-0 ml-2">{{\App\Models\Restaurant::count()}} restaurants
                    </small>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="filters shadow-sm rounded bg-white mb-4">
                    <div class="filters-header border-bottom pl-4 pr-4 pt-3 pb-3">
                        <h5 class="m-0">Filter By</h5>
                    </div>
                    <div class="filters-body">
                        <div id="accordion">
                            <div class="filters-card border-bottom p-4">
                                <div class="filters-card-header" id="headingOne">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Location <i class="icofont-arrow-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        @forelse($states as $st)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cb1"  @if(!empty($id) || !empty($state_id) == $st->id) checked @endif> 
                                                {{--@if($st->restaurants->count()>0)--}}
                                                <label class="custom-control-label" for="cb1">{{$st->name}} <small class="text-black-50">{{$st->restaurants->count()}}</small>
                                                </label>
                                                {{--@endif--}}
                                            </div>
                                        @empty
                                        @endforelse
                                        <div class="mt-2"><a href="#" class="link">See all</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="filters-card border-bottom p-4">
                                <div class="filters-card-header" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                            All cuisines
                                            <i class="icofont-arrow-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapsetwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <form class="filters-search mb-3">
                                            <div class="form-group">
                                                <i class="icofont-search"></i>
                                                <input type="text" class="form-control" placeholder="Start typing to search...">
                                            </div>
                                        </form>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb6">
                                            <label class="custom-control-label" for="cb6">American <small class="text-black-50">156</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb7">
                                            <label class="custom-control-label" for="cb7">Pizza <small class="text-black-50">120</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb8">
                                            <label class="custom-control-label" for="cb8">Healthy <small class="text-black-50">130</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb9">
                                            <label class="custom-control-label" for="cb9">Vegetarian <small class="text-black-50">120</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb10">
                                            <label class="custom-control-label" for="cb10"> Chinese <small class="text-black-50">111</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb11">
                                            <label class="custom-control-label" for="cb11"> Hamburgers <small class="text-black-50">95</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb12">
                                            <label class="custom-control-label" for="cb12"> Dessert <small class="text-black-50">50</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb13">
                                            <label class="custom-control-label" for="cb13"> Chicken <small class="text-black-50">32</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb14">
                                            <label class="custom-control-label" for="cb14"> Indian <small class="text-black-50">156</small></label>
                                        </div>
                                        <div class="mt-2"><a href="#" class="link">See all</a></div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="filters-card border-bottom p-4">
                                <div class="filters-card-header" id="headingCategory">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseFeature" aria-expanded="true" aria-controls="collapseFeature">
                                            Feature <i class="icofont-arrow-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseFeature" class="collapse" aria-labelledby="headingCategory" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb15">
                                            <label class="custom-control-label" for="cb15">Free Delivery <small class="text-black-50">156</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb26">
                                            <label class="custom-control-label" for="cb26">Coupons <small class="text-black-50">120</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb37">
                                            <label class="custom-control-label" for="cb37">Open Now [1:31am] <small class="text-black-50">85</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filters-card border-bottom p-4">
                                <div class="filters-card-header" id="headingOffer">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOffer" aria-expanded="true" aria-controls="collapseOffer">
                                            Delivery time <i class="icofont-arrow-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseOffer" class="collapse" aria-labelledby="headingOffer" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb19">
                                            <label class="custom-control-label" for="cb19">Any Time </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb20">
                                            <label class="custom-control-label" for="cb20">25 min
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb36">
                                            <label class="custom-control-label" for="cb36">30 min
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb47">
                                            <label class="custom-control-label" for="cb47">40 min
                                            </label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb58">
                                            <label class="custom-control-label" for="cb58">50 min
                                            </label>
                                        </div>
                                        <div class="mt-2"><a href="#" class="link">See all</a></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="filters-card p-4">
                                <div class="filters-card-header" id="headingCategory">
                                    <h6 class="mb-0">
                                        <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory">
                                            Category <i class="icofont-arrow-down float-right"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordion">
                                    <div class="filters-card-body card-shop-filters">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb15">
                                            <label class="custom-control-label" for="cb15">Delivery <small class="text-black-50">156</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb26">
                                            <label class="custom-control-label" for="cb26">Dine-out <small class="text-black-50">120</small></label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cb37">
                                            <label class="custom-control-label" for="cb37">Cafés<small class="text-black-50">85</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="filters pt-2">
                    <div class="filters-body rounded shadow-sm bg-white">
                        <div class="filters-card p-4">
                            <div>
                                <div class="filters-card-body card-shop-filters pt-0">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked="">
                                        <label class="custom-control-label" for="customRadio1">Gold Partner</label>
                                    </div>
                                    <div class="custom-control custom-radio mt-1 mb-1">
                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Order Food Online</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" checked="">
                                        <label class="custom-control-label" for="customRadio3">osahan</label>
                                    </div>
                                    <hr>
                                    <small class="text-success">Use code OSAHAN50 to get 50% OFF (up to $30) on first 5 orders. T&Cs apply.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-md-9">
                <!-- <div class="owl-carousel owl-carousel-category owl-theme list-cate-page mb-4">
                    <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="img/list/1.png" alt="">
                                <h6>American</h6>
                                <p>156</p>
                            </a>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    @forelse($restaurants as $res)
                    <div class="col-md-4 col-sm-6 mb-4 pb-2">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i class="icofont-heart"></i></a></div>
                                <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                <a href="{{route('restaurantDetl',$res->id)}}">
                                    <img src="{{asset('/')}}storage/app/public/images/feature_image/{{$res->feature_image}}" class="img-fluid item-img" loading="lazyload">
                                </a>
                            </div>
                            @php
                                $categories = DB::select(DB::raw("SELECT categories.name FROM foods JOIN restaurants on foods.restaurant_id = restaurants.id JOIN categories on foods.category_id = categories.id WHERE restaurants.id=$res->id group by categories.name LIMIT 3"));   
                                $categories = json_decode(json_encode($categories), true);
                                $categories = array_column($categories, 'name');       
                                $delivery_time_slot = array(1 => '15-20 min',2=>'20-30 min',3=> '30-40 min', 4=> '40-50 min');                       
                            @endphp
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1"><a href="{{route('restaurantDetl',$res->id)}}" class="text-black"</a>{{$res->name}}</h6>
                                    <p class="text-gray mb-3">@php echo implode(',',$categories); @endphp</p>
                                    <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i>@if(array_key_exists($res->delivery_time,$delivery_time_slot)) {{$delivery_time_slot[$res->delivery_time]}} @endif</span> <span class="float-right text-black-50"> ${{optional($res->food)->price}} @if(optional($res->food)->capacity)For {{$res->food->capacity}} Person @endif</span></p>
                                </div>
                                @php 
                                    $promo_code = \App\Models\Coupon::where('enabled',1)->orderBy('id','desc')->first();
                                @endphp
                                @if($promo_code)
                                <div class="list-card-badge">
                                    <span class="badge badge-success">OFFER</span> <small>{{$promo_code->discount}}% off | Use Coupon
                                    {{$promo_code->id}}</small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12"><h3 class="text-primary text-center">No Restaurant Found</h3></div>
                    @endforelse
                    <!-- <div class="col-md-12 text-center load-more">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div> -->
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