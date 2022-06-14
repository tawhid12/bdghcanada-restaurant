<nav class="navbar navbar-expand-lg navbar-light bg-light osahan-nav shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}"><img alt="logo" src="{{asset('')}}assets/img/logo.jpeg"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/offers')}}"><i class="icofont-sale-discount"></i> Offers <span
                                class="badge badge-danger">New</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Restaurants
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="{{route('nearestRestaurant')}}">Listing</a>
                            <!-- <a class="dropdown-item" href="{{url('/restaurant-details')}}">Detail + Cart</a>
                            <a class="dropdown-item" href="#">Checkout</a> -->
                        </div>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Pages
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="#">Track Order</a>
                            <a class="dropdown-item" href="#">Invoice</a>
                            <a class="dropdown-item" href="#">Login</a>
                            <a class="dropdown-item" href="#">Register</a>
                        </div>
                    </li> -->
                    @if(Session::get('user'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            @php 
					            //$photo= $UserData->details->photo; 
				            @endphp
                            @if(!empty($photo))
                            <img alt="Generic placeholder image" src="{{asset('storage/app/public/images/user/photo/'.$photo)}}"
                                class="nav-osahan-pic rounded-pill">{{encryptor('decrypt', Session::get('username'))}}
                            @else
                            <img alt="Generic placeholder image" src="{{asset('/')}}storage/app/public/images/user/photo/{{ Session::get('uphoto') }}"
                                class="nav-osahan-pic rounded-pill">{{encryptor('decrypt', Session::get('username'))}}
							@endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="{{route(currentUser().'Dashboard')}}"><i class="icofont-dashboard"></i>
                                Dashboard</a>
                            <!-- <a class="dropdown-item" href=""><i class="icofont-food-cart"></i>
                                Orders</a>
                            <a class="dropdown-item" href=""><i class="icofont-sale-discount"></i>
                                Offers</a>
                            <a class="dropdown-item" href=""><i class="icofont-heart"></i>
                                Favourites</a>
                            <a class="dropdown-item" href=""><i class="icofont-credit-card"></i>
                                Payments</a>
                            <a class="dropdown-item" href=""><i class="icofont-location-pin"></i>
                                Addresses</a> -->
                            <a class="dropdown-item" href="{{route('logOut')}}"><i class="icofont-lock"></i>
                                Logout</a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Signup|Register
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <a class="dropdown-item" href="{{route('signInForm')}}">Login</a>
                            <a class="dropdown-item" href="{{route('signUpForm')}}">Register</a>
                            <a class="dropdown-item" href="{{route('restaurant_registration')}}">Restaurant Resgistration</a>
                            <a class="dropdown-item" href="{{route('delivery_boy_registration')}}">Delivery Boy Resgistration</a>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item dropdown dropdown-cart">
                        <a class="nav-link" href="@if(currentUser()) {{route('cart')}} @endif">
                            <i class="fas fa-shopping-basket"></i> Cart
                            <span class="cart-count badge badge-success">{{ count((array) session()->get('cart')) }}</span>
                        </a>
                        <!--<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-basket"></i> Cart
                            <span class="cart-count badge badge-success">{{ count((array) session()->get('cart')) }}</span>
                        </a>
                          <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                            <div class="dropdown-cart-top-header p-4">
                                <img class="img-fluid mr-3" alt="osahan" src="{{asset('')}}assets/img/cart.jpg">
                                <h6 class="mb-0">Gus's World Famous Chicken</h6>
                                <p class="text-secondary mb-0">310 S Front St, Memphis, USA</p>
                                <small><a class="text-primary font-weight-bold" href="#">View Full Menu</a></small>
                            </div>
                            <div class="dropdown-cart-top-body border-top p-4">
                                <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Corn & Peas
                                    Salad x 1 <span class="float-right text-secondary">$209</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> Veg Seekh Sub 6"
                                    (15 cm) x 1 <span class="float-right text-secondary">$133</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Chicken Tikka Sub
                                    12" (30 cm) x 1 <span class="float-right text-secondary">$314</span></p>
                                <p class="mb-2"><i class="icofont-ui-press text-danger food-item"></i> Corn & Peas Salad
                                    x 1 <span class="float-right text-secondary">$209</span></p>
                            </div>
                            <div class="dropdown-cart-top-footer border-top p-4">
                                <p class="mb-0 font-weight-bold text-secondary">Sub Total <span
                                        class="float-right text-dark">$499</span></p>
                                <small class="text-info">Extra charges may apply</small>
                            </div>
                            <div class="dropdown-cart-top-footer border-top p-2">
                                <a class="btn btn-success btn-block btn-lg" href="checkout.html"> Checkout</a>
                            </div>
                        </div>-->
                    </li> 
                </ul>
            </div>
        </div>
    </nav>