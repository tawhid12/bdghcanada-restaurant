<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){
        if(currentUser() == 'superadmin'){
            $orders = Order::paginate(10);
        }else if(currentUser() == 'owner'){
            $orders = Order::where('owner_id','=',currentUserId())->paginate(10);
        }
        
        //dd($orders->toArray());
        return view('backend.order.all',compact('orders'));
    }

}
