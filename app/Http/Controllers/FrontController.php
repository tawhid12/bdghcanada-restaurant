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
        $promoted_restaurant = Restaurant::with(['food' =>  function ($query)  {
            $query->where('featured', '=',1)->orderBy('id','desc');
        }
        ])->where('isPromoted', '=',1)->orderBy('id', 'DESC')->limit(4)->get();
        $popular_food_items = Food::where('popular','=',1)->get();
        /*$states =  DB::table('states')->select('states.name','states.id')
        ->leftjoin('restaurants','states.id','=','restaurants.state_id')
        ->groupBy('states.name')
        ->get();*/
        return view('welcome',compact('states','cities','promoted_restaurant','popular_food_items'));
    }
}
