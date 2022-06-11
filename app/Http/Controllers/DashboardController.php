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
		  return view('backend.dashboard.superadmin_dashboard');
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