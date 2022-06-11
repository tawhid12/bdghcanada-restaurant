<?php

namespace App\Http\Controllers;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\City;
use App\Models\Order;
use App\Models\Payment;

use DB;
use Session;
class CheckoutController extends Controller
{
    use ResponseTrait;
    public function index(){
        $cities = City::all();
        $cart = session()->get('cart', []);
        $pids=array_keys((array) session('cart'));
        $products=Food::whereIn('id',$pids)->get();
        $delivery_addresses = DB::table('delivery_addresses')->where('user_id','=',currentUserId())->get();
        return view('checkout',compact('cities','cart','products','delivery_addresses'));
    }
    public function finalCheckout(Request $request){
        //print_r($request->all());die;
        $request->validate(
            [
                'delivery_address_id' => 'required',
            ]
        );
        if(!session()->get('user'))
            return redirect(route('signInForm'))->with($this->responseMessage(false, null, "you have to login or Signup"));


        $cart = session()->get('cart', []);
        $cal_cart=$this->cal_cart();

        if(count((array) session('cart')) <= 0)
            return redirect(route('cart'))->with($this->responseMessage(false, null, "You have no product in cart."));
        else{
            DB::beginTransaction();
            try{
            /*==Insert Data into Cart Table (New Order Received) ====*/
            
            $cart = session()->get('cart', []);
            $pids=array_keys((array) session('cart'));
            $products=Food::whereIn('id',$pids)->get();
            if(count((array) $products)>0){
                foreach($products as $item){
                    $foods['food_id'] = $item->id;
                    $foods['user_id'] = encryptor('decrypt', request()->session()->get('user'));
                    $foods['quantity'] = $cart[$item->id]['quantity'];
                  
                }
            }
            DB::table('carts')->insert($foods);

            /*==Insert Data into payment Table (New Order Received) ====*/
            DB::table('payments')->insert(
                [
                    'price' => str_replace( ',', '', $cal_cart["total"]),
                    'user_id'=> encryptor('decrypt', request()->session()->get('user')),
                    'method'=> $request->pay_method,
                ]
            );
    
                /*==Insert Data into Order Table (New Order Received) ====*/
                $order = new Order();
                $order->user_id = encryptor('decrypt', request()->session()->get('user'));
                $order->order_status_id = 1;
                $order->delivery_fee = 50;
                $order->delivery_address_id = $request->delivery_address_id;
                $order->payment_id = DB::getPdo()->lastInsertId();

                if($order->save()){
                    DB::commit();
                    Session::forget('cart');
                    Session::forget('cal_cart');
                    return redirect(route('thank_you',$order->id))->with($this->responseMessage(true, null, "data saved!"));
                }
               
              
            }catch(\Exception $e){
               DB::rollBack();
               dd($e);
               return redirect()->back()->with($this->responseMessage(false, "error", "Please try again!"));
            }
       
        }
           
            
            
           
        }

        public function cal_cart(){
            $total=0;
            $t_discount=0;

            $cart = session()->get('cart', []);
            foreach($cart as $c){
                $total+=$c['price'] * $c['quantity'];
                $t_discount+=$c['quantity'] * $c['discount'];
            }
            $cal_cart=array(
                "total"=>number_format($total,2),
                "discount"=>number_format($t_discount,2),
                "sub_total"=>number_format((($total - $t_discount)),2),
            );

            session()->put('cal_cart', $cal_cart);
            return $cal_cart;
        }

        public function thank_you($id){
            $cities = City::all();
return view('thank-you',compact('cities'));
        }

       
}