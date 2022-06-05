<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\State;
use App\Models\City;
use DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $states = State::all();
        $cities = City::all();
        /*$states =  DB::table('states')->select('states.name','states.id')
        ->leftjoin('restaurants','states.id','=','restaurants.state_id')
        ->groupBy('states.name')
        ->get();*/
        return view('welcome',compact('states','cities'));
    }
}
