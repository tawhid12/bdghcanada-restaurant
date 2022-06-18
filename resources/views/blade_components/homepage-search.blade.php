<section class="pt-5 pb-5 homepage-search-block position-relative">
        <div class="banner-overlay"></div>
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-8">
                    <div class="homepage-search-title">
                        <h1 class="mb-2 font-weight-normal"><span class="font-weight-bold">Find Awesome Deals</span> in
                            Canada</h1>
                        <h5 class="mb-5 text-secondary font-weight-normal">Lists of top restaurants, cafes, pubs, and
                            bars in Torento, based on trends</h5>
                    </div>
                    <div class="homepage-search-form">
                        <form class="form-noborder"  action="{{route('restaurant.search')}}">
                            @csrf
                            <div class="form-row">
                                <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                    <select class="custom-select form-control-lg" name="state_id">
                                        <option value="">Select Provience</option>
                                        @forelse($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                    <select class="custom-select form-control-lg" name="city_id">
                                        <option value="">Select City</option>
                                        @forelse($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <!-- <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                                    <div class="location-dropdown">
                                        <i class="icofont-location-arrow"></i>
                                        <select class="custom-select form-control-lg">
                                            <option> Quick Searches </option>
                                            <option> Breakfast </option>
                                            <option> Lunch </option>
                                            <option> Dinner </option>
                                            <option> Cafés </option>
                                            <option> Delivery </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12 form-group">
                                    <input type="text" placeholder="Enter your delivery location"
                                        class="form-control form-control-lg">
                                    <a class="locate-me" href="#"><i class="icofont-ui-pointer"></i> Locate Me</a>
                                </div> -->
                                <div class="col-lg-2 col-md-2 col-sm-12 form-group">
                                    <button type="submit"
                                        class="btn btn-primary btn-block btn-lg btn-gradient">Search</button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <h6 class="mt-4 text-shadow font-weight-normal">E.g. Beverages, Pizzas, Chinese, Bakery, Indian...
                    </h6>
                    <div class="owl-carousel owl-carousel-category owl-theme">
                        @forelse($popular_food_items as $popular_food_item)
                        <div class="item">
                            <div class="osahan-category-item">
                                <a href="{{route('restaurantDetl',$popular_food_item->id)}}">
                                    <img class="img-fluid" src="{{asset('/')}}storage/app/public/images/food/thumbnail/{{$popular_food_item->thumbnail}}" alt="">
                                    <h6>{{$popular_food_item->name}}</h6>
                                    <p>{{$popular_food_item->price}}</p>
                                </a>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="osahan-slider pl-4 pt-3">
                        <div class="owl-carousel homepage-ad owl-theme">
                            <div class="item">
                                <a href="listing.html"><img class="img-fluid rounded" src="{{asset('')}}assets/img/slider.png"></a>
                            </div>
                            <div class="item">
                                <a href="listing.html"><img class="img-fluid rounded" src="{{asset('')}}assets/img/slider1.png"></a>
                            </div>
                            <div class="item">
                                <a href="listing.html"><img class="img-fluid rounded" src="{{asset('')}}assets/img/slider.png"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>