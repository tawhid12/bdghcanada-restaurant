<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\State;
use App\Models\City;
use App\Models\Food;
use DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $states = State::all();
        $cities = City::all();
        /*
        Promoted => Trending Now
        Popular => Trending Now
        */
        $promoted_restaurant = Restaurant::with(['food' =>  function ($query)  {
            $query->where(['featured' => 1, 'status' => 1])->orderBy('id','desc');//Featured Food With Promoted Restaurant
        }
        ])->where(['isPromoted' =>1, 'active' => 1])->orderBy('id', 'DESC')->limit(4)->get();
        $popular_food_items = Food::where(['popular'=> 1, 'status' => 1])->get();
        /*$states =  DB::table('states')->select('states.name','states.id')
        ->leftjoin('restaurants','states.id','=','restaurants.state_id')
        ->groupBy('states.name')
        ->get();*/
        return view('welcome',compact('states','cities','promoted_restaurant','popular_food_items'));
    }
    public function search(Request $request){
        $state_id = $request->state_id;
        $city_id = $request->city_id;
        if(!empty($state_id) && !empty($city_id)){
            $restaurants   = Restaurant::where(['active'=>1,'state_id' => $request->state_id,'city_id' => $request->city_id])->get();
        }else if(!empty($state_id)){
            $restaurants   = Restaurant::where(['active'=>1,'state_id' => $request->state_id])->get();
        }else if(!empty($city_id)){
            $restaurants   = Restaurant::where(['active'=>1,'city_id' => $request->city_id])->get();
        }else{
            $restaurants = null;
        }
        $cities = City::all();
        $states        = State::all();
        return view('restaurant-listing',compact('restaurants','states','cities','state_id'));
    }
}
