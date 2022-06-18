@extends('layouts.master')
@section('content')   
@push('styles')

@endpush                 
    <!-- top nav bar -->
    @include('blade_components.nav-bar')
<section class="restaurant-detailed-banner">
    <div class="text-center">
        <img class="img-fluid cover" src="{{asset('/')}}storage/app/public/images/feature_image/{{$restaurant->feature_image}}">
    </div>
    <div class="restaurant-detailed-header">
        <div class="container">
            <div class="row d-flex align-items-end">
                <div class="col-md-8">
                    <div class="restaurant-detailed-header-left">
                        <img class="{{asset('')}}assets/img-fluid mr-3 float-left" alt="osahan" src="{{asset('/')}}storage/app/public/images/logo/{{$restaurant->logo}}">
                        <h2 class="text-white">{{$restaurant->name}}</h2>
                        <p class="text-white mb-1"><i class="icofont-location-pin"></i>{{$restaurant->address}} @if($restaurant->closed == 1)<span class="badge badge-danger">CLOSE</span>@else <span class="badge badge-success">OPEN</spa>@endif
                        </p>
                        @php
                        $categories1 = DB::select(DB::raw("SELECT categories.name FROM foods JOIN restaurants on foods.restaurant_id = restaurants.id JOIN categories on foods.category_id = categories.id WHERE restaurants.id=$restaurant->id group by categories.name LIMIT 3"));   
                        $categories1 = json_decode(json_encode($categories1), true);
                        $categories1 = array_column($categories1, 'name');       
                        $delivery_time_slot = array(1 => '15-20 min',2=>'20-30 min',3=> '30-40 min', 4=> '40-50 min');                       
                        @endphp
                        <p class="text-white mb-0"><i class="icofont-food-cart"></i> @php echo implode(',',$categories1); @endphp
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="restaurant-detailed-header-right text-right">
                        <button class="btn btn-success" type="button"><i class="icofont-clock-time"></i>@if(array_key_exists($restaurant->delivery_time,$delivery_time_slot)) {{$delivery_time_slot[$restaurant->delivery_time]}} @endif 
                        </button>
                        <h6 class="text-white mb-0 restaurant-detailed-ratings"><span class="generator-bg rounded text-white"><i class="icofont-star"></i> 3.1</span> 23 Ratings <i class="ml-3 icofont-speech-comments"></i> 91 reviews</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section class="offer-dedicated-nav bg-white border-top-0 shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span class="restaurant-detailed-action-btn float-right">
                    <button class="btn btn-light btn-sm border-light-btn" type="button"><i class="icofont-heart text-danger"></i> Mark as Favourite</button>
                    <button class="btn btn-light btn-sm border-light-btn" type="button"><i class="icofont-cauli-flower text-success"></i> Pure Veg</button>
                    <button class="btn btn-outline-danger btn-sm" type="button"><i class="icofont-sale-discount"></i> OFFERS</button>
                </span>
                <ul class="nav" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">Order Online</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill" href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info" aria-selected="false">Restaurant Info</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="pills-book-tab" data-toggle="pill" href="#pills-book" role="tab" aria-controls="pills-book" aria-selected="false">Book A Table</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" id="pills-reviews-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews" aria-selected="false">Ratings & Reviews</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="offer-dedicated-body pt-2 pb-2 mt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="offer-dedicated-body-left">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
                            <div id="#menu" class="bg-white rounded shadow-sm p-4 mb-4 explore-outlets">
                                <!-- <h5 class="mb-4">Recommended</h5>
                                <form class="explore-outlets-search mb-4">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search for dishes..." class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-link">
                                                <i class="icofont-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form> -->
                                <h6 class="mb-3">Most Popular <!--<span class="badge badge-success"><i class="icofont-tags"></i> 15% Off All Items </span>--></h6>
                                <div class="owl-carousel owl-theme owl-carousel-five offers-interested-carousel mb-3">
                                    @forelse($popular as $p)
                                    <div class="item">
                                        <div class="mall-category-item">
                                            <a href="#">
                                                <img class="img-fluid" src="{{asset('')}}assets/img/list/1.png">
                                                <h6>Burgers</h6>
                                                <small>5 ITEMS</small>
                                            </a>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse                         
                                </div>
                            </div>
                            <!-- <div class="row">
                                <h5 class="mb-4 mt-3 col-md-12">Best Sellers</h5>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                        <div class="list-card-image">
                                            <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                            <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="icofont-heart"></i></a></div>
                                            <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                            <a href="#">
                                                <img src="{{asset('')}}assets/img/list/7.png" class="img-fluid item-img">
                                            </a>
                                        </div>
                                        <div class="p-3 position-relative">
                                            <div class="list-card-body">
                                                <h6 class="mb-1"><a href="#" class="text-black">Bite Me Sandwiches</a></h6>
                                                <p class="text-gray mb-2">North Indian • Indian</p>
                                                <p class="text-gray time mb-0"><a class="btn btn-link btn-sm pl-0 text-black pr-0" href="#">$550 </a> <span class="badge badge-success">NEW</span> <span class="float-right">
                                                        <a class="btn btn-outline-secondary btn-sm" href="#">ADD</a>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                            @forelse($categories as $cat)
                            @if($cat->products->count() >0 )
                            <h5 class="mb-4 mt-3 col-md-12">{{$cat->name}} <small class="h6 text-black-50">{{$cat->products->count()}} ITEMS</small></h5>
                            <div class="col-md-12">
                                <div class="bg-white rounded border shadow-sm">
                                    @forelse($cat->products as  $food)
                                    @if($loop->index < 1)
                                    <div class="gold-members p-3 border-bottom">
                                        <!-- <a class="btn btn-outline-secondary btn-sm  float-right" href="javascript:void(0)" onclick="add_to_cart({{$food->id}})">Add to Cart</a> -->
                                        <span class="count-number float-right">
                                            <button class="btn btn-outline-secondary  btn-sm left dec_{{$food->id}}" onclick="qty_decrement({{$food->id}})"> <i class="icofont-minus"></i> </button>
                                            <input class="count-number-input qty_{{$food->id}}" type="text" value="1" readonly="">
                                            <button class="btn btn-outline-secondary btn-sm right inc_{{$food->id}}" onclick="qty_increment({{$food->id}})"> <i class="icofont-plus"></i> </button>
                                        </span>
                                        <div class="media">
                                            <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">{{$food->name}}</h6>
                                                <p class="text-gray mb-0">${{number_format($food->price,2)}} - ({{$food->unit}})</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($loop->index >= 1)
                                    <div class="gold-members p-3 border-bottom">
                                        <!-- <a class="btn btn-outline-secondary btn-sm  float-right" href="javascript:void(0)" onclick="add_to_cart({{$food->id}})">Add to Cart</a> -->
                                        <span class="count-number float-right">
                                            <button class="btn btn-outline-secondary  btn-sm left dec_{{$food->id}}" onclick="qty_decrement({{$food->id}})"> <i class="icofont-minus"></i> </button>
                                            <input class="count-number-input qty_{{$food->id}}" type="text" value="1" readonly="">
                                            <button class="btn btn-outline-secondary btn-sm right inc_{{$food->id}}" onclick="qty_increment({{$food->id}})"> <i class="icofont-plus"></i> </button>
                                        </span>
                                        <div class="media">
                                            @if($loop->index % 2 == 0)
                                            <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">{{$food->name}} <span class="badge badge-success">BESTSELLER</span></h6>
                                                <p class="text-gray mb-0">${{number_format($food->price,2)}} </p>
                                            </div>
                                            @else
                                            <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1">{{$food->name}} <span class="badge badge-danger">BESTSELLER</span></h6>
                                                <p class="text-gray mb-0">${{number_format($food->price,2)}}</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    @empty
                                    @endforelse
                                    <!-- <div class="row">
                                        <h5 class="mb-4 mt-3 col-md-12">Soups <small class="h6 text-black-50">8 ITEMS</small></h5>
                                        <div class="col-md-12">
                                            <div class="bg-white rounded border shadow-sm">
                                                <div class="gold-members p-3 border-bottom">
                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                    <div class="media">
                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                        <div class="media-body">
                                                            <h6 class="mb-1">Tomato Dhania Shorba</h6>
                                                            <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gold-members p-3 border-bottom">
                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                    <div class="media">
                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                        <div class="media-body">
                                                            <h6 class="mb-1">Veg Manchow Soup</h6>
                                                            <p class="text-gray mb-0">$600</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gold-members p-3 border-bottom">
                                                    <span class="count-number float-right">
                                                        <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                                        <input class="count-number-input" type="text" value="1" readonly="">
                                                        <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                                    </span>
                                                    <div class="media">
                                                        <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                                        <div class="media-body">
                                                            <h6 class="mb-1">Lemon Coriander Soup</h6>
                                                            <p class="text-gray mb-0">$600</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gold-members p-3 border-bottom">
                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                    <div class="media">
                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                        <div class="media-body">
                                                            <h6 class="mb-1">Tomato Dhania Shorba</h6>
                                                            <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gold-members p-3 border-bottom">
                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                    <div class="media">
                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                        <div class="media-body">
                                                            <h6 class="mb-1">Veg Manchow Soup</h6>
                                                            <p class="text-gray mb-0">$600</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gold-members p-3">
                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                    <div class="media">
                                                        <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                                        <div class="media-body">
                                                            <h6 class="mb-1">Lemon Coriander Soup</h6>
                                                            <p class="text-gray mb-0">$600</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            @endif    
                            @empty
                            @endforelse 
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                            <div id="gallery" class="bg-white rounded shadow-sm p-4 mb-4">
                                <div class="restaurant-slider-main position-relative homepage-great-deals-carousel">
                                    <div class="owl-carousel owl-theme homepage-ad">
                                        @forelse($restaurant->galleries as $gallery)
                                        <div class="item">
                                            <img class="img-fluid" src="{{asset('/')}}storage/images/gallery/{{$gallery->gallery_img}}">
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <div class="position-absolute restaurant-slider-pics bg-dark text-white">Total {{$restaurant->galleries->count()}} Photos</div>
                                    <!-- <div class="position-absolute restaurant-slider-view-all"><button type="button" class="btn btn-light bg-white">See all Photos</button></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                            <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                                <div class="address-map float-right ml-5">
                                    <div class="mapouter">
                                        <div class="gmap_canvas"><iframe width="300" height="170" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&amp;t=&amp;z=9&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                                    </div>
                                </div>
                                <h5 class="mb-4">Restaurant Info</h5>
                                <p class="mb-3">{{$restaurant->address}}</p>
                                <p class="mb-2 text-black"><i class="icofont-phone-circle text-primary mr-2"></i> @if($restaurant->phone)+{{$restaurant->phone}},@endif +{{$restaurant->mobile}}</p>
                                <p class="mb-2 text-black"><i class="icofont-email text-primary mr-2"></i> <a href="" class="">{{$restaurant->email}}</a></p>
                                <p class="mb-2 text-black"><i class="icofont-clock-time text-primary mr-2"></i> Today 11am – 5pm, 6pm – 11pm
                                    <span class="badge badge-success"> OPEN NOW </span>
                                </p>
                                <hr class="clearfix">
                                <p class="text-black mb-0">You can also check the 3D view by using our menue map clicking here &nbsp;&nbsp;&nbsp; <a class="text-info font-weight-bold" href="#">Venue Map</a></p>
                                <hr class="clearfix">
                                <h5 class="mt-4 mb-4">More Info</h5>
                                <p class="mb-3">Dal Makhani, Panneer Butter Masala, Kadhai Paneer, Raita, Veg Thali, Laccha Paratha, Butter Naan</p>
                                <div class="border-btn-main mb-4">
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                    <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Indoor Seating</a>
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                    <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                    <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-book" role="tabpanel" aria-labelledby="pills-book-tab">
                            <div id="book-a-table" class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                                <h5 class="mb-4">Book A Table</h5>
                                <form>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input class="form-control" type="text" placeholder="Enter Full Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input class="form-control" type="text" placeholder="Enter Email address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Mobile number</label>
                                                <input class="form-control" type="text" placeholder="Enter Mobile number">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Date And Time</label>
                                                <input class="form-control" type="text" placeholder="Enter Date And Time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-primary" type="button"> Submit </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">
                            <div id="ratings-and-reviews" class="bg-white rounded shadow-sm p-4 mb-4 clearfix restaurant-detailed-star-rating">
                                <span class="star-rating float-right">
                                    <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                                    <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                                    <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                                    <a href="#"><i class="icofont-ui-rating icofont-2x active"></i></a>
                                    <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                </span>
                                <h5 class="mb-0 pt-1">Rate this Place</h5>
                            </div>
                            <div class="bg-white rounded shadow-sm p-4 mb-4 clearfix graph-star-rating">
                                <h5 class="mb-0 mb-4">Ratings and Reviews</h5>
                                <div class="graph-star-rating-header">
                                    <div class="star-rating">
                                        <a href="#"><i class="icofont-ui-rating active"></i></a>
                                        <a href="#"><i class="icofont-ui-rating active"></i></a>
                                        <a href="#"><i class="icofont-ui-rating active"></i></a>
                                        <a href="#"><i class="icofont-ui-rating active"></i></a>
                                        <a href="#"><i class="icofont-ui-rating"></i></a> <b class="text-black ml-2">334</b>
                                    </div>
                                    <p class="text-black mb-4 mt-2">Rated 3.5 out of 5</p>
                                </div>
                                <div class="graph-star-rating-body">
                                    <div class="rating-list">
                                        <div class="rating-list-left text-black">
                                            5 Star
                                        </div>
                                        <div class="rating-list-center">
                                            <div class="progress">
                                                <div style="width: 56%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rating-list-right text-black">56%</div>
                                    </div>
                                    <div class="rating-list">
                                        <div class="rating-list-left text-black">
                                            4 Star
                                        </div>
                                        <div class="rating-list-center">
                                            <div class="progress">
                                                <div style="width: 23%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rating-list-right text-black">23%</div>
                                    </div>
                                    <div class="rating-list">
                                        <div class="rating-list-left text-black">
                                            3 Star
                                        </div>
                                        <div class="rating-list-center">
                                            <div class="progress">
                                                <div style="width: 11%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rating-list-right text-black">11%</div>
                                    </div>
                                    <div class="rating-list">
                                        <div class="rating-list-left text-black">
                                            2 Star
                                        </div>
                                        <div class="rating-list-center">
                                            <div class="progress">
                                                <div style="width: 2%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="5" role="progressbar" class="progress-bar bg-primary">
                                                    <span class="sr-only">80% Complete (danger)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rating-list-right text-black">02%</div>
                                    </div>
                                </div>
                                <div class="graph-star-rating-footer text-center mt-3 mb-3">
                                    <button type="button" class="btn btn-outline-primary btn-sm">Rate and Review</button>
                                </div>
                            </div>
                            <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                                <a href="#" class="btn btn-outline-primary btn-sm float-right">Top Rated</a>
                                <h5 class="mb-1">All Ratings and Reviews</h5>
                                <div class="reviews-members pt-4 pb-4">
                                    <div class="media">
                                        <a href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/1.png" class="mr-3 rounded-pill"></a>
                                        <div class="media-body">
                                            <div class="reviews-members-header">
                                                <span class="star-rating float-right">
                                                    <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                    <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                    <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                    <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                    <a href="#"><i class="icofont-ui-rating"></i></a>
                                                </span>
                                                <h6 class="mb-1"><a class="text-black" href="#">Singh Osahan</a></h6>
                                                <p class="text-gray">Tue, 20 Mar 2020</p>
                                            </div>
                                            <div class="reviews-members-body">
                                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections </p>
                                            </div>
                                            <div class="reviews-members-footer">
                                                <a class="total-like" href="#"><i class="icofont-thumbs-up"></i> 856M</a> <a class="total-like" href="#"><i class="icofont-thumbs-down"></i> 158K</a>
                                                <span class="total-like-user-main ml-2" dir="rtl">
                                                    <a data-toggle="tooltip" data-placement="top" title="Gurdeep Osahan" href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/5.png" class="total-like-user rounded-pill"></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Gurdeep Singh" href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/2.png" class="total-like-user rounded-pill"></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Askbootstrap" href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/3.png" class="total-like-user rounded-pill"></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Osahan" href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/4.png" class="total-like-user rounded-pill"></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="reviews-members pt-4 pb-4">
                                    <div class="media">
                                        <a href="#"><img alt="Generic placeholder image" src="img/user/6.png" class="mr-3 rounded-pill"></a>
                                        <div class="media-body">
                                            <div class="reviews-members-header">
                                                <span class="star-rating float-right">
                                                    <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                    <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                    <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                    <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                    <a href="#"><i class="icofont-ui-rating"></i></a>
                                                </span>
                                                <h6 class="mb-1"><a class="text-black" href="#">Gurdeep Singh</a></h6>
                                                <p class="text-gray">Tue, 20 Mar 2020</p>
                                            </div>
                                            <div class="reviews-members-body">
                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                            </div>
                                            <div class="reviews-members-footer">
                                                <a class="total-like" href="#"><i class="icofont-thumbs-up"></i> 88K</a> <a class="total-like" href="#"><i class="icofont-thumbs-down"></i> 1K</a>
                                                <span class="total-like-user-main ml-2" dir="rtl">
                                                    <a data-toggle="tooltip" data-placement="top" title="Gurdeep Osahan" href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/5.png" class="total-like-user rounded-pill"></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Gurdeep Singh" href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/2.png" class="total-like-user rounded-pill"></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Askbootstrap" href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/3.png" class="total-like-user rounded-pill"></a>
                                                    <a data-toggle="tooltip" data-placement="top" title="Osahan" href="#"><img alt="Generic placeholder image" src="{{asset('')}}assets/img/user/4.png" class="total-like-user rounded-pill"></a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <a class="text-center w-100 d-block mt-4 font-weight-bold" href="#">See All Reviews</a>
                            </div>
                            <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                                <h5 class="mb-4">Leave Comment</h5>
                                <p class="mb-2">Rate the Place</p>
                                <div class="mb-4">
                                    <span class="star-rating">
                                        <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                        <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                        <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                        <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                        <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                    </span>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label>Your Comment</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm" type="button"> Submit Comment </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pb-2">
                    <div class="bg-white rounded shadow-sm text-white mb-4 p-4 clearfix restaurant-detailed-earn-pts card-icon-overlap">
                        <img class="img-fluid float-left mr-3" src="{{asset('')}}assets/img/earn-score-icon.png">
                        <h6 class="pt-0 text-primary mb-1 font-weight-bold">OFFER</h6>
                        <p class="mb-0">60% off on orders above $99 | Use coupon <span class="text-danger font-weight-bold">BDHSCANADA50</span></p>
                        <div class="icon-overlap">
                            <i class="icofont-sale-discount"></i>
                        </div>
                    </div>
                </div>
                
                <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                    <h5 class="mb-1 text-white">Your Order</h5>
                    <p class="mb-4 text-white">{{ count((array) session()->get('cart')) }} ITEMS</p>
                    @php
                        $total=0;
                        $t_discount=0;
                        $t_vat=0;
                        //print_r(session()->get('cart'));
                    @endphp
                        @foreach($cart as $c)
                            @php
                                $total+=$c['price'] * $c['quantity'];
                                $t_discount+=$c['quantity'] * $c['discount'];
                            @endphp
                        @endforeach
                     <div class="bg-white rounded shadow-sm mb-2 cart-item">
                        @if(count((array) $products)>0)
                            @foreach($products as $item)
                            <div class="gold-members p-2 border-bottom">
                                <p class="text-gray mb-0 float-right ml-2">{{$cart[$item->id]['dis_price'] * $cart[$item->id]['quantity']}}</p>
                                <span class="count-number float-right">
                                    <button class="btn btn-outline-secondary  btn-sm left dec_{{$item->id}}" onclick="qty_decrement({{$item->id}})"> <i class="icofont-minus"></i> </button>
                                    <input class="count-number-input qty_{{$item->id}}" type="text" value="1" readonly="">
                                    <button class="btn btn-outline-secondary btn-sm right inc_{{$item->id}}" onclick="qty_increment({{$item->id}})"> <i class="icofont-plus"></i> </button>
                                </span>
                                <div class="media">
                                    <div class="mr-2"><i class="icofont-ui-press text-danger food-item"></i></div>
                                    <div class="media-body">
                                        <p class="mt-1 mb-0 text-black">{{$item->name}} {{$cart[$item->id]['dis_price']}} x {{$cart[$item->id]['quantity']}}</p>
                                    </div>
                                    <a href="javascript:void(0)" onclick="remove_cart({{$item->id}})" class="mr-2"><i class="icofont-bin text-danger" style="font-size:14px;"></i></a>
                                </div>
                            </div>
                            @endforeach
                        @endif 
                    </div>
                    <div class="mb-2 bg-white rounded p-2 clearfix">
                        <img class="img-fluid float-left" src="{{asset('')}}assets/img/wallet-icon.png">
                        <h6 class="font-weight-bold text-right mb-2">SubTotal : <span class="text-danger">${{number_format($total,2)}}</span></h6>
                        <h6 class="font-weight-bold text-right mb-2">Discount : <span class="text-danger">${{number_format($t_discount,2)}}</span></h6>
                        <h6 class="font-weight-bold text-right mb-2">Total : <span class="text-danger">${{number_format($total-$t_discount,2)}}</span></h6>
                        <!-- <p class="seven-color mb-1 text-right">Extra charges may apply</p> -->
                        @if($t_discount>0)
                        <p class="text-black mb-0 text-right">You have saved ${{number_format($t_discount,2)}} on the bill</p>
                        @endif
                    </div>
                    {{--@if(count((array) session('cart')) > 0)--}}
                    <a href="{{route('cart')}}" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a>
                    {{--@endif--}}
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
@push('scripts')

<script>
    function qty_increment(inc){
        var qty_inc = $('.qty_'+inc).val();
        add_to_cart(inc,'inc')
    }
    function qty_decrement(dec){
        var qty_dec = $('.qty_'+dec).val();
        add_to_cart(dec,'dec');
    }
    function add_to_cart(i,op){
    var data = '';
    var type = '';
    $.ajax({
      dataType: "json",
      url: '{{ route('front.addcart') }}',
      method: "get",
      data: {
        id: i, 
        quantity: $('.qty_'+i).val(),
        restaurant_id:'{{$restaurant->id}}',
        op:op
      },
      success: function (response) {
        type= response.type;
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        if(type == 1)
  		    toastr.success(response.msg);
        else
          toastr.error(response.msg);
        $('.cart-count').text(response.total_product) 
        $.each(response.cart,function(index,item){
        data +=     `<div class="gold-members p-2 border-bottom">
                            <p class="text-gray mb-0 float-right ml-2">${item.dis_price * item.quantity}</p>
                            <span class="count-number float-right">
                                <button class="btn btn-outline-secondary  btn-sm left dec_${index}" onclick="qty_decrement(${index})"> <i class="icofont-minus"></i> </button>
                                <input class="count-number-input qty_${index}" type="text" value="1" readonly="">
                                <button class="btn btn-outline-secondary btn-sm right inc_${index}" onclick="qty_increment(${index})"> <i class="icofont-plus"></i> </button>
                            </span>
                            <div class="media">
                                <div class="mr-2"><i class="icofont-ui-press text-danger food-item"></i></div>
                                <div class="media-body">
                                    <p class="mt-1 mb-0 text-black">${item.name} ${item.dis_price} x ${item.quantity}</p>
                                </div>
                                <a href="javascript:void(0)" onclick="remove_cart(${index})" class="mr-2"><i class="icofont-bin text-danger" style="font-size:14px;"></i></a>
                            </div>
                        </div>`; 
                           
        });
        $('.cart-item').html(data);
      },
		error:function(request,error){
			console.log(arguments);
			console.log("Error:"+error);
		}
    });
  }

  function remove_cart(i){
    var data = '';
    $.ajax({
    dataType: "json",
    url: '{{ route('front.removeCart') }}',
    method: "get",
    data: {
        id: i,
        restaurant_id:'{{$restaurant->id}}'
    },
    success: function (response) {
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.error(response.msg);
        $('.cart-count').text(response.total_product) 
        $.each(response.cart,function(index,item){
        data +=     `<div class="gold-members p-2 border-bottom">
                            <p class="text-gray mb-0 float-right ml-2">${item.dis_price} x ${item.quantity}</p>
                            <span class="count-number float-right">
                                <button class="btn btn-outline-secondary  btn-sm left dec_${index}" onclick="qty_decrement(${index})"> <i class="icofont-minus"></i> </button>
                                <input class="count-number-input qty_${index}" type="text" value="1" readonly="">
                                <button class="btn btn-outline-secondary btn-sm right inc_${index}" onclick="qty_increment(${index})"> <i class="icofont-plus"></i> </button>
                            </span>
                            <div class="media">
                                <div class="mr-2"><i class="icofont-ui-press text-danger food-item"></i></div>
                                <div class="media-body">
                                    <p class="mt-1 mb-0 text-black">${item.name} ${item.dis_price} x ${item.quantity}</p>
                                </div>
                                <a href="javascript:void(0)" onclick="remove_cart(${index})" class="mr-2"><i class="icofont-bin text-danger" style="font-size:14px;"></i></a>
                            </div>
                        </div>`; 
                           
        });
        $('.cart-item').html(data);
    }
    });
}


</script>
@endpush