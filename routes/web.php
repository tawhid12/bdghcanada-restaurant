<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\GalleryController;

use App\Http\Controllers\FrontController;
use App\Http\Controllers\RestraurantListingController;
use App\Http\Controllers\RestaurantDetailsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryAddressController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*==================================BackEnd======================================*/
Route::group(['middleware' => 'unknownUser'], function(){
    // Sign In, Login
    Route::get('/login', [AuthenticationController::class,'signInForm'])->name('signInForm');
    Route::post('/login', [AuthenticationController::class,'signIn'])->name('logIn');

    // Sign Up, Registration
    Route::get('/register', [AuthenticationController::class,'signUpForm'])->name('signUpForm');
	Route::post('/registered',[AuthenticationController::class,'signUpStore'])->name('signUp');

    //Signup, Registration| Restaurant
    Route::get('/restaurant-registration', [AuthenticationController::class,'restaurantsignUpForm'])->name('restaurant_registration');
    Route::post('/restaurant-registration',[AuthenticationController::class,'signUpregistrationStore'])->name('signUpregistrationStore');

    //Signup, Registration| Driver
    Route::get('/delivery-boy-registration', [AuthenticationController::class,'delivery_boy_signUpForm'])->name('delivery_boy_registration');
    Route::post('/delivery-boy-registration',[AuthenticationController::class,'delivery_boy_registrationStore'])->name('signUp_delivery_boy_Store');

    // Forgot Password
    Route::get('/forgot-password', [AuthenticationController::class,'forgotForm'])->name('forgotPasswordForm');
    Route::post('/forgot-password', [AuthenticationController::class,'forgotPassword'])->name('forgotPassword');

    // Reset Password
    Route::get('/reset-password', [AuthenticationController::class,'resetPasswordForm'])->name('resetPasswordForm');
    Route::post('/reset-password', [AuthenticationController::class,'resetPassword'])->name('resetPassword');
});
/*=================================LogOut================================== */
Route::get('/logout', [AuthenticationController::class,'signOut'])->name('logOut');

// Super Admin
Route::group(['middleware' => 'isSuperAdmin'], function(){
    Route::prefix('superadmin')->group(function () {
        Route::get('/dashboard', [DashboardController::class,'index'])->name('superadminDashboard');

        /*====Restaurant==*/
        Route::resource('/info',RestaurantController::class,['as' => 'superadmin']);
        Route::get('/getCity/{id}',[RestaurantController::class,'getCity'])->name('superadmin.getCity');

        /*====Restaurant Gallery==*/
        //Route::resource('/gallery',GalleryController::class,['as' => 'superadmin']);
        Route::get('/all/restaurant',[RestaurantController::class,'allRestaurant'])->name('superadmin.allRestaurant');
        Route::get('/restaurant/{restaurant}/activate',[RestaurantController::class,'activateRestaurant'])->name('superadmin.restaurant.activate');
        Route::get('/changeresfeaturedStatus', [RestaurantController::class,'changerestaurantFeatured'])->name('superadmin.changerestaurantFeatured');
        Route::get('/changerespopularStatus', [RestaurantController::class,'changerestaurantPopular'])->name('superadmin.changerestaurantPopular');

        /*====Food===========*/
        Route::get('/all/food', [FoodController::class,'allFood'])->name('superadmin.allFood');
        Route::get('/changefeaturedStatus', [FoodController::class,'changefoodFeatured'])->name('superadmin.changefoodFeatured');
        Route::get('/changepopularStatus', [FoodController::class,'changefoodPopular'])->name('superadmin.changefoodPopular');

        /*===Order===*/
        Route::resource('/orders',OrderController::class,['as' => 'superadmin']);

        /*===Cupon===*/
        Route::resource('/coupon',CouponController::class,['as' => 'superadmin']);

        /*===Settings===*/
        Route::resource('/settings',SettingController::class,['as' => 'superadmin']);
        /*===Slider===*/
        Route::resource('/slider',SliderController::class,['as' => 'superadmin']);
        /*===Advertisement===*/
        Route::resource('/advertisement',AdvertisementController::class,['as' => 'superadmin']);

    });
   

    Route::prefix('user')->group(function () {
        Route::get('/all', [UserController::class,'index'])->name('superadmin.allUser');
        Route::get('/add', [UserController::class,'addForm'])->name('superadmin.addNewUserForm');
        Route::post('/add', [UserController::class,'store'])->name('superadmin.addNewUser');
        Route::get('/edit/{name}/{id}', [UserController::class,'editForm'])->name('superadmin.editUser');
        Route::post('/update', [UserController::class,'update'])->name('superadmin.updateUser');
        Route::get('/delete/{name}/{id}', [UserController::class,'delete'])->name('superadmin.deleteUser');
    });
        Route::get('/profile', [UserController::class,'userProfile'])->name('superadmin.userProfile');
        Route::post('/profile', [UserController::class,'storeProfile'])->name('superadmin.storeProfile');
        Route::post('/changePass', [UserController::class,'changePass'])->name('superadmin.changePass');
        Route::post('/changePer', [UserController::class,'changePer'])->name('superadmin.changePer');
        Route::post('/changeAcc', [UserController::class,'changeAcc'])->name('superadmin.changeAcc');

    Route::prefix('state')->group(function () {
        Route::get('/all', [StateController::class,'index'])->name('superadmin.allState');
        Route::get('/add',  [StateController::class,'addForm'])->name('superadmin.addNewStateForm');
        Route::post('/add',  [StateController::class,'store'])->name('superadmin.addNewState');
        Route::get('/edit/{name}/{id}',  [StateController::class,'editForm'])->name('superadmin.editState');
        Route::post('/update',  [StateController::class,'update'])->name('superadmin.updateState');
        Route::get('/delete/{name}/{id}',  [StateController::class,'delete'])->name('superadmin.deleteState');
    });

    Route::prefix('city')->group(function () {
        Route::get('/all', [CityController::class,'index'])->name('superadmin.allCity');
        Route::get('/add', [CityController::class,'addForm'])->name('superadmin.addNewCityForm');
        Route::post('/add', [CityController::class,'store'])->name('superadmin.addNewCity');
        Route::get('/edit/{name}/{id}', [CityController::class,'editForm'])->name('superadmin.editCity');
        Route::post('/update', [CityController::class,'update'])->name('superadmin.updateCity');
        Route::get('/delete/{name}/{id}', [CityController::class,'delete'])->name('superadmin.deleteCity');
    });

    
});


// owner
Route::group(['middleware' => 'isRestaurant'], function(){
    Route::prefix('restaurant')->group(function () {
        Route::get('/', [DashboardController::class,'owner']);
        Route::get('/dashboard', [DashboardController::class,'owner'])->name('ownerDashboard');

        Route::get('/profile', [UserController::class,'userProfile'])->name('owner.userProfile');
        Route::post('/profile', [UserController::class,'storeProfile'])->name('owner.storeProfile');

        Route::get('/getCity/{id}',[RestaurantController::class,'getCity'])->name('owner.getCity');
        /*====Restaurant==*/
        Route::resource('/info',RestaurantController::class,['as' => 'owner']);

        /*====Restaurant Gallery==*/
        Route::resource('/gallery',GalleryController::class,['as' => 'owner']);

        /*===Order===*/
        Route::resource('/orders',OrderController::class,['as' => 'owner']);

    });
    
   
    Route::prefix('owner')->group(function () {       
        Route::post('/upload-image',  [UserController::class,'upload']);
        Route::post('/changePass',  [UserController::class,'changePass'])->name('owner.changePass');
        Route::post('/changePer',  [UserController::class,'changePer'])->name('owner.changePer');
        Route::post('/changeAcc',  [UserController::class,'changeAcc'])->name('owner.changeAcc');
    });

    Route::prefix('category')->group(function () {
        Route::get('/all', [CategoryController::class,'index'])->name('owner.allCategory');
        Route::get('/add', [CategoryController::class,'addForm'])->name('owner.addNewCategoryForm');
        Route::post('/add', [CategoryController::class,'store'])->name('owner.addNewCategory');
        Route::get('/edit/{id}', [CategoryController::class,'editForm'])->name('owner.editCategory');
        Route::post('/update', [CategoryController::class,'update'])->name('owner.updateCategory');
        Route::get('/delete/{id}', [CategoryController::class,'delete'])->name('owner.deleteCategory');
    });
    
    Route::prefix('food')->group(function () {
        Route::get('/all', [FoodController::class,'index'])->name('owner.allFood');
        Route::get('/add',  [FoodController::class,'addForm'])->name('owner.addNewFoodForm');
        Route::post('/add',  [FoodController::class,'store'])->name('owner.addNewFood');
        Route::get('/edit/{id}',  [FoodController::class,'editForm'])->name('owner.editFood');
        Route::post('/update',  [FoodController::class,'update'])->name('owner.updateFood');
        Route::get('/delete/{id}',  [FoodController::class,'delete'])->name('owner.deleteFood');
        
        /*Route::get('/import_Food',  [FoodController::class,'importFoodList'])->name('owner.importFoodList');
        Route::get('/import',  [FoodController::class,'importFood'])->name('owner.importFood');*/
    });
});


// Customer
Route::group(['middleware' => 'isCustomer'], function(){
    Route::prefix('customer')->group(function () {
        Route::get('/', [DashboardController::class,'customer'])->name('customerDashboard');
        Route::get('/profile', [UserController::class,'userProfile'])->name('customer.userProfile');
        Route::post('/profile', [UserController::class,'storeProfile'])->name('customer.storeProfile');
        
       /*Checkout Page Redirect*/
        Route::get('/cart', [CheckoutController::class,'index'])->name('cart');
        /*Final Checkout*/
        Route::post('/final_checkout', [CheckoutController::class,'finalCheckout'])->name('finalCheckout');
        /*Final Checkout*/
        Route::get('/thank-you/{id}', [CheckoutController::class,'thank_you'])->name('thank_you');
        /*Order By Id*/
        Route::get('/view-order/{id}', [CheckoutController::class,'view_order'])->name('view_order');

        /*Delivery Address */
        Route::post('/delivery-address', [DeliveryAddressController::class,'store'])->name('customer.deliveryAddress.store');
    });
    Route::prefix('user')->group(function () {       
        Route::post('/upload-image',  [UserController::class,'upload']);
        Route::post('/changePass',  [UserController::class,'changePass'])->name('customer.changePass');
        Route::post('/changePer',  [UserController::class,'changePer'])->name('customer.changePer');
        Route::post('/changeAcc',  [UserController::class,'changeAcc'])->name('customer.changeAcc');
    });

    
});
Route::get('/restaurant/{alias}', [FrontController::class,'restaurant'])->name('vendor');
Route::get('/', [FrontController::class,'index'])->name('home');
Route::get('/restaurant-search', [FrontController::class,'search'])->name('restaurant.search');
Route::get('/restaurant-listing/near', [RestraurantListingController::class,'nearestRestaurant'])->name('nearestRestaurant');
Route::get('/restaurant-listing/{id}', [RestraurantListingController::class,'index'])->name('restaurantlisting');
Route::get('/restaurant-details/{id}', [RestaurantDetailsController::class,'index'])->name('restaurantDetl');

// Customer
Route::group(['middleware' => 'isDeliveryBoy'], function(){
    Route::prefix('delivery-boy')->group(function () {
        Route::get('/', [DashboardController::class,'deliveryBoy'])->name('deliveryDashboard');
        Route::get('/profile', [UserController::class,'userProfile'])->name('delivery.userProfile');
        Route::post('/profile', [UserController::class,'storeProfile'])->name('delivery.storeProfile');
    });
    Route::prefix('user')->group(function () {       
        Route::post('/upload-image',  [UserController::class,'upload']);
        Route::post('/changePass',  [UserController::class,'changePass'])->name('delivery.changePass');
        Route::post('/changePer',  [UserController::class,'changePer'])->name('delivery.changePer');
        Route::post('/changeAcc',  [UserController::class,'changeAcc'])->name('delivery.changeAcc');
    });
});
/*===============Front End============== */
/*=============== cart ===================*/
    Route::get('/cart', [CartController::class, 'cartView'])->name('front.cart');
    Route::get('/addtocart', [CartController::class, 'addToCart'])->name('front.addcart');
    Route::get('/updatecart', [CartController::class, 'updateCart'])->name('front.updateCart');
    Route::get('/removecart', [CartController::class, 'removeCart'])->name('front.removeCart');
/*=============== cart ===================*/
/*=============== Promo code ============ */
Route::get('/promocode', [CheckoutController::class,'promoCode'])->name('front.promoCode');
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/offers', function () {
    return view('offers');
});
/*Route::get('/restaurant-listing', function () {
    return view('restaurant-listing');
});
Route::get('/restaurant-details', function () {
    return view('restaurant-details');
});*/

