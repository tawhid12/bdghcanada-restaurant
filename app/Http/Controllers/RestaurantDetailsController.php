<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use App\Models\City;
use App\Models\Food;
use Illuminate\Http\Request;

class RestaurantDetailsController extends Controller
{
    public function index($id){
        $cities = City::all();
        $restaurant = Restaurant::where('id','=',$id)->first();
        $categories = Category::with(['products' =>  function ($query) use ($id) {
            $query->where('restaurant_id', $id);
        }
        ])->get();//where('restaurant_id','=',$id)->
        //dd($categories->toArray());
        $cart = session()->get('cart', []);
        $pids=array_keys((array) session('cart'));
        $products=Food::whereIn('id',$pids);
        $products= $products->get();
        $popular = Food::where(['restaurant_id' => $id, 'popular' => '1'])->get();
        /*$best_seller = Food::where(['restaurant_id' => $id, 'best_seller' => '1'])->get();*/
        return view('restaurant-details',compact('restaurant','categories','cities','products','cart','popular'));
    }
}
