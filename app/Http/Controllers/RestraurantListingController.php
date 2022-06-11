<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Restaurant;
class RestraurantListingController extends Controller
{
    public function index($id){
        $cities = City::all();
        $restaurants   = Restaurant::where(['active'=>1,'state_id' => $id])->get();
       /* echo '<pre>';
        print_r($restaurants->toArray());
        echo '</pre>';die;*/
        $states        = State::all();
        return view('restaurant-listing',compact('restaurants','states','id','cities'));
    }
    public function nearestRestaurant(){
        $cities = City::all();
        $states        = State::all();
        $restaurants   = Restaurant::where(['active'=>1])->get();
        $id=null;
        return view('restaurant-listing',compact('restaurants','states','cities','id'));
    }
}
