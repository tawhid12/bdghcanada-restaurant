<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DeliveryAddressController extends Controller
{
    public function store(Request $request){
        DB::table('delivery_addresses')->insert(
            array(
                'description' => $request->description,
                'address' => $request->address,
                'address_type' => $request->address_type,
                'latitude' => $request->latitude,
                'latitude' => $request->longitude,
                'user_id' => currentUserId(),
            )
        );
        /*check to redirect if address add from front or backend */
        return redirect()->route('cart');
    }
}
