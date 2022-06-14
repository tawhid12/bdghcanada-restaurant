
    <section class="section pt-5 pb-5 products-section">
        <div class="container">
            <div class="section-header text-center">
                <h2>Popular Restaurant</h2>
                <p>Top restaurants, cafes, pubs, and bars in Canada, based on</p>
                <span class="line"></span>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-carousel-four owl-theme">
                        @forelse($promoted_restaurant as $promo_rs)
                        <div class="item">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    @php
                                    $now = Carbon\Carbon::now();
                                    $start = Carbon\Carbon::parse($promo_rs->opening_time);
                                    $end = Carbon\Carbon::parse($promo_rs->closing_time);
                                    @endphp
                                    <div class="schedule position-absolute">
                                        <span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i>
                                        @if ($now->between($start, $end)) 
                                        Schedule:-{{$promo_rs->opening_time}}
                                        @else
                                            Close
                                        @endif
                                        </span>
                                    </div>
                                    <div class="star position-absolute"><span class="badge badge-success"><i
                                                class="icofont-star"></i> 3.1 (300+)</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a href="{{route('restaurantDetl',$promo_rs->id)}}"><i
                                                class="icofont-heart"></i></a></div>
                                    <div class="member-plan position-absolute"><span
                                            class="badge badge-dark">Promoted</span></div>
                                    <a href="{{route('restaurantDetl',$promo_rs->id)}}">
                                        <img src="{{asset('/')}}storage/app/public/images/feature_image/{{$promo_rs->feature_image}}" class="img-fluid item-img">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="{{route('restaurantDetl',$promo_rs->id)}}" class="text-black">{{$promo_rs->name}}</a></h6>
                                        @php
                                        $categories = DB::select(DB::raw("SELECT categories.name FROM foods JOIN restaurants on foods.restaurant_id = restaurants.id JOIN categories on foods.category_id = categories.id WHERE restaurants.id=$promo_rs->id group by categories.name LIMIT 3"));   
                                        $categories = json_decode(json_encode($categories), true);
                                        $categories = array_column($categories, 'name');       
                                        $delivery_time_slot = array(1 => '15-20 min',2=>'20-30 min',3=> '30-40 min', 4=> '40-50 min');                       
                                        @endphp
                                        <p class="text-gray mb-3">@php echo implode(',',$categories); @endphp</p>
                                        <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i>@if(array_key_exists($promo_rs->delivery_time,$delivery_time_slot)) {{$delivery_time_slot[$promo_rs->delivery_time]}} @endif</span> <span class="float-right text-black-50"> ${{optional($promo_rs->food)->price}} @if(optional($promo_rs->food)->capacity)For {{$promo_rs->food->capacity}} Person @endif</span></p>
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
                        @endforelse
            
                        <!-- <div class="item">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-success"><i
                                                class="icofont-star"></i> 3.1 (300+)</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a href="detail.html"><i
                                                class="icofont-heart"></i></a></div>
                                    <div class="member-plan position-absolute"><span
                                            class="badge badge-danger">Promoted</span></div>
                                    <a href="detail.html">
                                        <img src="{{asset('')}}assets/img/list/6.png" class="img-fluid item-img">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="detail.html" class="text-black">The osahan Restaurant
                                            </a>
                                        </h6>
                                        <p class="text-gray mb-3">North • Hamburgers • Pure veg</p>
                                        <p class="text-gray mb-3 time"><span
                                                class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i
                                                    class="icofont-wall-clock"></i> 15–25 min</span> <span
                                                class="float-right text-black-50"> $500 FOR TWO</span></p>
                                    </div>
                                    <div class="list-card-badge">
                                        <span class="badge badge-danger">OFFER</span> <small>65% off | Use Coupon
                                            OSAHAN50</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    -->
                    
                    </div>
                </div>
            </div>
        </div>
    </section>