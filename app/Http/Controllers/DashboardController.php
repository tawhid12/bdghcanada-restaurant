<?php

namespace App\Http\Controllers;



use App\Models\User;
use App\Models\Bill;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Branch;
use Session;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index(){
      $restaurants=DB::select(DB::raw("SELECT count(id) as rcount FROM `restaurants`"));
      $customers=DB::select(DB::raw("SELECT count(id) as ccount FROM `users` where users.roleId=3")); 
      $foods=DB::select(DB::raw("SELECT count(id) as fcount FROM `foods`")); 
      $delivery_man=DB::select(DB::raw("SELECT count(id) as dcount FROM `users` where users.roleId=4")); 


		  return view('backend.dashboard.superadmin_dashboard',compact('restaurants','customers','foods','delivery_man'));
    }
    public function owner(){
        return view('backend.dashboard.owner_dashboard');
    }
    public function customer(){
      return view('backend.dashboard.customer_dashboard');
    }
    public function deliveryBoy(){
      return view('backend.dashboard.deliveryBoy_dashboard');
    }
}