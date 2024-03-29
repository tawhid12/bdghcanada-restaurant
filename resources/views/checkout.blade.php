@extends('layouts.master')
@push('styles')

@endpush
@section('content')
<!-- top nav bar -->
@include('blade_components.nav-bar')
@php
    $total=0;
    $t_discount=0;
    $t_vat=0;
    $pro_dis = 0;
    //print_r(session()->get('cart'));
    $pro_dis += session()->get('promo_code');
    @endphp
    @if(count((array) session('cart')))
    @foreach($cart as $c)
    @php
    $total+=$c['price'] * $c['quantity'];
    $t_discount+=$c['quantity'] * $c['discount'];
    @endphp
    @endforeach
    
@endif
<section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="offer-dedicated-body-left">
                    <!-- <div class="bg-white rounded shadow-sm p-4 mb-4">
                        <h6 class="mb-3">You may also like</h6>
                        <div class="owl-carousel owl-theme owl-carousel-five offers-interested-carousel">
                            <div class="item">
                                <div class="mall-category-item position-relative">
                                    <a class="btn btn-primary btn-sm position-absolute" href="#">ADD</a>
                                    <img class="img-fluid" src="img/list/1.png">
                                    <h6>Burgers</h6>
                                    <small>$500</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mall-category-item position-relative">
                                    <a class="btn btn-primary btn-sm position-absolute" href="#">ADD</a>
                                    <img class="img-fluid" src="img/list/2.png">
                                    <h6>Sandwiches</h6>
                                    <small>$260</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mall-category-item position-relative">
                                    <a class="btn btn-primary btn-sm position-absolute" href="#">ADD</a>
                                    <img class="img-fluid" src="img/list/3.png">
                                    <h6>Soups</h6>
                                    <small>$860</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mall-category-item position-relative">
                                    <a class="btn btn-primary btn-sm position-absolute" href="#">ADD</a>
                                    <img class="img-fluid" src="img/list/4.png">
                                    <h6>Pizzas</h6>
                                    <small>$602</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mall-category-item position-relative">
                                    <a class="btn btn-primary btn-sm position-absolute" href="#">ADD</a>
                                    <img class="img-fluid" src="img/list/5.png">
                                    <h6>Pastas</h6>
                                    <small>$360</small>
                                </div>
                            </div>
                            <div class="item">
                                <div class="mall-category-item position-relative">
                                    <a class="btn btn-primary btn-sm position-absolute" href="#">ADD</a>
                                    <img class="img-fluid" src="img/list/6.png">
                                    <h6>Chinese</h6>
                                    <small>$760</small>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="pt-2"></div>
                    <form method="post" action="{{route('finalCheckout')}}">
                    @csrf
                    <div class="bg-white rounded shadow-sm p-4 mb-4">
                        <h4 class="mb-1">Choose a delivery address</h4>
                        <h6 class="mb-3 text-black-50">Multiple addresses in this location</h6>
                        <div class="row">
                        @forelse($delivery_addresses as $del_address)
                            @php
                            if($del_address->address_type==1){
                                $icon = "icofont-ui-home";
                            }elseif($del_address->address_type==2){
                                $icon = "icofont-briefcase";
                            }else{
                                $icon = "icofont-location-pin";
                            }
                            /*selected delivery address btn-success other btn secondary */
                            @endphp
                            <div class="col-md-6">
                                <div class="bg-white card addresses-item mb-4 border border-success">
                                    <div class="gold-members p-4">
                                        <div class="media">
                                            <div class="mr-3"><i class="{{$icon}} icofont-3x"></i></div>
                                            <div class="media-body">
                                                <h6 class="mb-1 text-black">@if($del_address->address_type==1) Home @elseif($del_address->address_type==2) Work @else Other @endif  </h6>                    
                                                <p class="text-black">{{$del_address->address}}
                                                </p>
                                                <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-success mr-2" href="#"> DELIVER HERE</a>
                                                    <span>30MIN</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="delivery_address_id" id="delivery_address_id" value="{{$del_address->id}}">
                                            <label class="form-check-label" for="delivery_address_id"></label>
                                        </div>
                                        @if($errors->has('delivery_address_id'))
                                        <small class="d-block text-danger mb-3">
                                            {{ $errors->first('delivery_address_id') }}
                                        </small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                        <div class="col-md-12">
                        <input type="hidden" name="delivery_address_id" id="delivery_address_id">
                        <small class="d-block text-danger mb-3">Add Delivery Address First</small>
                        </div>
                        @endforelse
                            <div class="col-md-6">
                                <p class="mb-0 text-black font-weight-bold"><a data-toggle="modal" data-target="#add-address-modal" class="btn btn-sm btn-primary mr-2" href="#"> ADD NEW ADDRESS</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2"></div>
                    <div class="bg-white rounded shadow-sm p-4 osahan-payment">
                        <h4 class="mb-1">Choose payment method</h4>
                        <h6 class="mb-3 text-black-50">Credit/Debit Cards</h6>
                        <div class="row">
                            <div class="col-sm-4 pr-0">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <!--<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="icofont-credit-card"></i> Credit/Debit Cards</a>
                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="icofont-id-card"></i> Food Cards</a> 
                                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="icofont-card"></i> Credit</a>
                                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="icofont-bank-alt"></i> Netbanking</a>-->
                                    <a class="nav-link" id="v-pills-cash-tab" data-toggle="pill" href="#v-pills-cash" role="tab" aria-controls="v-pills-cash" aria-selected="false"><i class="icofont-money"></i> Pay on Delivery</a>
                                </div>
                            </div>
                            <div class="col-sm-8 pl-0">
                                <div class="tab-content h-100" id="v-pills-tabContent">
                                    <!--<div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                        <h6 class="mb-3 mt-0 mb-3">Add new card</h6>
                                        <p>WE ACCEPT <span class="osahan-card">
                                                <i class="icofont-visa-alt"></i> <i class="icofont-mastercard-alt"></i> <i class="icofont-american-express-alt"></i> <i class="icofont-payoneer-alt"></i> <i class="icofont-apple-pay-alt"></i> <i class="icofont-bank-transfer-alt"></i> <i class="icofont-discover-alt"></i> <i class="icofont-jcb-alt"></i>
                                            </span>
                                        </p>
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4">Card number</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Card number">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-card"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label>Valid through(MM/YY)
                                                    </label>
                                                    <input type="number" class="form-control" placeholder="Enter Valid through(MM/YY)">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>CVV
                                                    </label>
                                                    <input type="number" class="form-control" placeholder="Enter CVV Number">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Name on card
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Enter Card number">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Securely save this card for a faster checkout next time.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 mb-0">
                                                    <a href="thanks.html" class="btn btn-success btn-block btn-lg">PAY $1329
                                                        <i class="icofont-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                     <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                        <h6 class="mb-3 mt-0 mb-3">Add new food card</h6>
                                        <p>WE ACCEPT <span class="osahan-card">
                                                <i class="icofont-sage-alt"></i> <i class="icofont-stripe-alt"></i> <i class="icofont-google-wallet-alt-1"></i>
                                            </span>
                                        </p>
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4">Card number</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Card number">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-card"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label>Valid through(MM/YY)
                                                    </label>
                                                    <input type="number" class="form-control" placeholder="Enter Valid through(MM/YY)">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>CVV
                                                    </label>
                                                    <input type="number" class="form-control" placeholder="Enter CVV Number">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Name on card
                                                    </label>
                                                    <input type="text" class="form-control" placeholder="Enter Card number">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Securely save this card for a faster checkout next time.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 mb-0">
                                                    <a href="thanks.html" class="btn btn-success btn-block btn-lg">PAY $1329
                                                        <i class="icofont-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div> 
                                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                        <div class="border shadow-sm-sm p-4 d-flex align-items-center bg-white mb-3">
                                            <i class="icofont-apple-pay-alt mr-3 icofont-3x"></i>
                                            <div class="d-flex flex-column">
                                                <h5 class="card-title">Apple Pay</h5>
                                                <p class="card-text">Apple Pay lets you order now & pay later at no extra cost.</p>
                                                <a href="#" class="card-link font-weight-bold">LINK ACCOUNT <i class="icofont-link-alt"></i></a>
                                            </div>
                                        </div>
                                        <div class="border shadow-sm-sm p-4 d-flex bg-white align-items-center mb-3">
                                            <i class="icofont-paypal-alt mr-3 icofont-3x"></i>
                                            <div class="d-flex flex-column">
                                                <h5 class="card-title">Paypal</h5>
                                                <p class="card-text">Paypal lets you order now & pay later at no extra cost.</p>
                                                <a href="#" class="card-link font-weight-bold">LINK ACCOUNT <i class="icofont-link-alt"></i></a>
                                            </div>
                                        </div>
                                        <div class="border shadow-sm-sm p-4 d-flex bg-white align-items-center">
                                            <i class="icofont-diners-club mr-3 icofont-3x"></i>
                                            <div class="d-flex flex-column">
                                                <h5 class="card-title">Diners Club</h5>
                                                <p class="card-text">Diners Club lets you order now & pay later at no extra cost.</p>
                                                <a href="#" class="card-link font-weight-bold">LINK ACCOUNT <i class="icofont-link-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                        <h6 class="mb-3 mt-0 mb-3">Netbanking</h6>
                                        <form>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-outline-primary active">
                                                    <input type="radio" name="options" id="option1" autocomplete="off" checked> HDFC <i class="icofont-check-circled"></i>
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="options" id="option2" autocomplete="off"> ICICI <i class="icofont-check-circled"></i>
                                                </label>
                                                <label class="btn btn-outline-primary">
                                                    <input type="radio" name="options" id="option3" autocomplete="off"> AXIS <i class="icofont-check-circled"></i>
                                                </label>
                                            </div>
                                            <hr>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Select Bank
                                                    </label>
                                                    <br>
                                                    <select class="custom-select form-control">
                                                        <option selected>Bank</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12 mb-0">
                                                    <a href="thanks.html" class="btn btn-success btn-block btn-lg">PAY $1329
                                                        <i class="icofont-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>-->
                                    <div class="tab-pane fade show active" id="v-pills-cash" role="tabpanel" aria-labelledby="v-pills-cash-tab">
                                        <h6 class="mb-3 mt-0 mb-3">Cash</h6>
                                        <p>Please keep exact change handy to help us serve you better</p>
                                        <hr>
                                            <button type="submit" class="btn btn-success btn-block btn-lg"><i class="icofont-long-arrow-right"></i>PAY ${{number_format($total-$t_discount+$charge->delivery_fee-$pro_dis,2)}}</button>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                        $cart = session()->get('cart');
                        $restaurant_id = array_column($cart, 'restaurant_id');
                        $restaurant = \App\Models\Restaurant::find($restaurant_id[0]);
                        @endphp
                        <input type="hidden" name="owner_id" value="{{$restaurant->user_id}}">
                        </form>
                    </div>
                </div>
            </div>

           
            <div class="col-md-4">
                <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                    <div class="d-flex mb-4 osahan-cart-item-profile">
                        <img class="img-fluid mr-3 rounded-pill" alt="osahan" src="{{asset('/')}}storage/app/public/images/logo/{{$restaurant->logo}}">
                        <div class="d-flex flex-column">
                            <h6 class="mb-1 text-white">{{$restaurant->name}}
                            </h6>
                            <p class="mb-0 text-white"><i class="icofont-location-pin"></i> {{$restaurant->address}}</p>
                        </div>
                    </div>
                    <form method="post" action="{{route('finalCheckout')}}">
                    <div class="bg-white rounded shadow-sm mb-2">
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
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    @php
                    //print_r(session()->get('promo_code'));
                    @endphp
                    @if(!session()->get('promo_code'))
                    <div class="mb-2 bg-white rounded p-2 clearfix">
                        <div class="input-group input-group-sm mb-2">
                            <input type="text" class="promo-code form-control" placeholder="Enter promo code">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="button-addon2"><i class="icofont-sale-discount"></i> APPLY</button>
                            </div>
                        </div>
                        <!-- <div class="input-group mb-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icofont-comment"></i></span>
                            </div>
                            <textarea class="form-control" placeholder="Any suggestions? We will pass it on..." aria-label="With textarea"></textarea>
                        </div> -->
                    </div>
                    @endif
                    <div class="mb-2 bg-white rounded p-2 clearfix">
                        <p class="mb-1">Item Total <span class="float-right text-dark">${{number_format($total,2)}}</span></p>
                        <!-- <p class="mb-1">Restaurant Charges <span class="float-right text-dark">$62.8</span></p> -->
                        <p class="mb-1">Delivery Fee <span class="text-info" data-toggle="tooltip" data-placement="top" title="Total discount breakup">
                                <i class="icofont-info-circle"></i>
                            </span> <span class="float-right text-dark">${{$charge->delivery_fee}}</span>
                        </p>
                        <p class="mb-1 text-success">Total Discount
                            <span class="float-right text-success">${{number_format($t_discount+$pro_dis,2)}}</span>
                        </p>
                        <hr />
                        <h6 class="font-weight-bold mb-0">TO PAY <span class="float-right">${{number_format($total-$t_discount+$charge->delivery_fee-$pro_dis,2)}}</span></h6>
                    </div>
                    <!-- <a href="thanks.html" class="btn btn-success btn-block btn-lg">PAY ${{number_format($total-$t_discount,2)}}
                        <i class="icofont-long-arrow-right"></i></a> -->
                    </form>    
                </div>
                <div class="pt-2"></div>
                <div class="alert alert-success" role="alert">
                    You have saved <strong>${{number_format($t_discount+$pro_dis,2)}}</strong> on the bill
                </div>
                <!-- <div class="pt-2"></div>
                <div class="text-center pt-2">
                    <img class="img-fluid" src="https://dummyimage.com/352x504/ccc/ffffff.png&amp;text=Google+ads">
                </div> -->
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-address">Add Delivery Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  action="{{ route(currentUser().'.deliveryAddress.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Delivery Area</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Delivery Area">
                                <input type="hidden" class="form-control" placeholder="Delivery Area" name="latitude">
                                <input type="hidden" class="form-control" placeholder="Delivery Area" name="longitude">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-ui-pointer"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Complete Address
                            </label>
                            <input type="text" class="form-control" name="address" placeholder="Complete Address e.g. house number, street name, landmark">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Delivery Instructions
                            </label>
                            <input type="text" class="form-control" name="description" placeholder="Delivery Instructions e.g. Opposite Gold Souk Mall">
                        </div>
                        <div class="form-group mb-0 col-md-12">
                            <label for="inputPassword4">Nickname
                            </label>
                            <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons">
                                <label class="btn btn-info active">
                                    <input type="radio" name="address_type" id="option1" autocomplete="off" value="1" checked> Home
                                </label>
                                <label class="btn btn-info">
                                    <input type="radio" name="address_type" id="option2" autocomplete="off" value="2"> Work
                                </label>
                                <label class="btn btn-info">
                                    <input type="radio" name="address_type" id="option3" autocomplete="off" value="3"> Other
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                    </button><button type="submit" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Restaurant login redirect -->
@include('blade_components.restaurant-join')
<!-- Newsletter redirect -->
@include('blade_components.newsletter')
@endsection
@push('scripts')

<script>
@if( Session::has('response') )
    toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.{{Session::get('response')['class']}}("{{Session::get('response')['message']}}");
    @endif

	$(document).ready(function(){
        var type = '';
        $('#button-addon2').on('click',function(){
            var code = $('.promo-code').val();
            $.ajax({
                dataType: "json",
                url: '{{ route('front.promoCode') }}',
                method: "get",
                data: {
                    code: code, 
                },
                success: function (response) {
                console.log(response);
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
                location.reload();
                }
        });
    });
});
</script>
@endpush