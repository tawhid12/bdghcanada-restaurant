<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Restaurant;
class RestaurantDetailsController extends Controller
{
    public function index($id){
        $cities = City::all();
        $restaurant = Restaurant::where('id','=',$id)->first();
        $categories = Category::get();//where('restaurant_id','=',$id)->
        //dd($categories);
        return view('restaurant-details',compact('restaurant','categories','cities'));
    }
}
