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
    });
    Route::prefix('user')->group(function () {
        Route::get('/all', [UserController::class,'index'])->name('superadmin.allUser');
        Route::get('/add', [UserController::class,'addForm'])->name('superadmin.addNewUserForm');
        Route::post('/add', [UserController::class,'store'])->name('superadmin.addNewUser');
        Route::get('/edit/{name}/{id}', [UserController::class,'editForm'])->name('superadmin.editUser');
        Route::post('/update', [UserController::class,'update'])->name('superadmin.updateUser');
        Route::get('/delete/{name}/{id}', [UserController::class,'delete'])->name('superadmin.deleteUser');
        
        Route::get('/profile', [UserController::class,'userProfile'])->name('superadmin.userProfile');
        Route::post('/profile', [UserController::class,'storeProfile'])->name('superadmin.storeProfile');
        Route::post('/changePass', [UserController::class,'changePass'])->name('superadmin.changePass');
        Route::post('/changePer', [UserController::class,'changePer'])->name('superadmin.changePer');
        Route::post('/changeAcc', [UserController::class,'changeAcc'])->name('superadmin.changeAcc');

    Route::prefix('state')->group(function () {
        Route::get('/all', [StateController::class,'classindex'])->name('superadmin.allState');
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

    });
    
   
    Route::prefix('user')->group(function () {       
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


// owner
Route::group(['middleware' => 'isCustomer'], function(){
    Route::prefix('customer')->group(function () {
        Route::get('/', [DashboardController::class,'customer'])->name('customerDashboard');
        Route::get('/profile', [UserController::class,'userProfile'])->name('customer.userProfile');
        Route::post('/profile', [UserController::class,'storeProfile'])->name('customer.storeProfile');
    });
    Route::prefix('user')->group(function () {       
        Route::post('/upload-image',  [UserController::class,'upload']);
        Route::post('/changePass',  [UserController::class,'changePass'])->name('customer.changePass');
        Route::post('/changePer',  [UserController::class,'changePer'])->name('customer.changePer');
        Route::post('/changeAcc',  [UserController::class,'changeAcc'])->name('customer.changeAcc');
    });
});
Route::get('/', [FrontController::class,'index'])->name('home');
Route::get('/restaurant-listing/near', [RestraurantListingController::class,'nearestRestaurant'])->name('nearestRestaurant');
Route::get('/restaurant-listing/{id}', [RestraurantListingController::class,'index'])->name('restaurantlisting');
Route::get('/restaurant-details/{id}', [RestaurantDetailsController::class,'index'])->name('restaurantDetl');
/*===============Front End============== */
/*=============== cart ===================*/
    Route::get('/cart', [CartController::class, 'cartView'])->name('front.cart');
    Route::get('/addtocart', [CartController::class, 'addToCart'])->name('front.addcart');
    Route::get('/updatecart', [CartController::class, 'updateCart'])->name('front.updateCart');
    Route::get('/removecart', [CartController::class, 'removeCart'])->name('front.removeCart');
/*=============== cart ===================*/

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
