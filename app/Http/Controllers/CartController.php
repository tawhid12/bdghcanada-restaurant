<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use View;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartView(){
        $cart = session()->get('cart', []);
        $pids=array_keys((array) session('cart'));
        $settings=Setting::select('gst','hst')->first();
        $products=Food::whereIn('id',$pids);
        $similarpro=$products->pluck('category_id','category_id');
        $similarpro=Food::whereNotIn('id',$pids)->whereIn('category_id',$similarpro)->limit(12)->get();
        /* get cart product */
        $products= $products->get();
        return view('cart',compact('products','cart','similarpro','settings'));
    }
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $r)
    {
        $id=$r->id;
        
        $product = Food::findOrFail($id);
        $msg="Congratulation! Product added to cart.";
        $type="";
        $cart = session()->get('cart', []);

        $restaurant_id = array_keys(array_combine(array_keys($cart), array_column($cart, 'restaurant_id')),$r->restaurant_id);
        if(!$restaurant_id && !empty($cart)){
            unset($cart);
        }
                        
            if(isset($cart[$id])) {
                if($r->op == 'inc')
                {
                    $type=1;
                    $msg="Congratulation! Product added to cart.";
                    $cart[$id]['quantity']+=$r->quantity;
                }
                else{
                    if($cart[$id]['quantity'] == $r->quantity)
                    {
                        $type=2;
                        $msg="Minimum Quantity 1";
                        $cart[$id]['quantity']=1;
                    }
                    else{
                        $type=2;
                        $msg="Quantity Removed from cart";
                        $cart[$id]['quantity']-=$r->quantity;
                    }
                    
                }
            }else{
                $type=1;
                    if($r->quantity!=0){
                        $price=$product->price;
                        $discount_amount=0;
                        if($product->discount_type==1){
                            $discount_amount= $product->discount_price;
                            $price  =  $product->price - $discount_amount;
                        }else{
                            $discount_amount=($product->price * ($product->discount_price/100));
                            $price=($product->price - ($product->price * ($product->discount_price/100)));
                        }
                        $charge = Restaurant::find($product->restaurant_id);
                    $cart[$id] = [
                        "restaurant_id" => $product->restaurant_id,
                        "name" => $product->name,
                        "quantity" => $r->quantity,
                        "price" => $product->price,
                        "dis_price" => $price,
                        "discount" => $discount_amount,
                        "delivery_charge" => $charge->delivery_fee,
                        "image" => $product->thumbnail
                    ];
                
                    
                    
                }
            }
     
        session()->put('cart', $cart);
        return response()->json(array("total_product" => count((array) session('cart')),"msg"=> $msg,'type'=>$type,'cart' => $cart), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function updateCart(Request $request)
    {
        $type="error";
        if($request->id && $request->qty){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->qty;
            session()->put('cart', $cart);

            $cart = session()->get('cart', []);
            $pids=array_keys((array) session('cart'));
            $products=Product::whereIn('id',$pids)->get();
            $type="success";
            $msg="<b>Congratulation!</b> Cart updated successfully.";
            return View::make("frontend.cart_support",compact('cart','products','type','msg'))->render();
        }else{
            $msg="<b>Sorry</b>! Cart update fail. Please try again.";
            return View::make("frontend.cart_support",compact('cart','products','type','msg'))->render();
        }
    }

    public function removeCart(Request $request)
    {
        $type="error";
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
                $cart = session()->get('cart', []);
                $type="success";
                $msg="Congratulation! Product deleted from cart.";
                return response()->json(array("total_product" => count((array) session('cart')),"msg"=> $msg,'type'=>$type,'cart' => $cart), 200);
            }else{
                $msg="<b>Sorry</b>! This product is not available in your cart.";
                return response()->json(array("msg"=> $msg,'type'=>$type,'cart' => $cart), 200);
            }
        }else{
                $msg="<b>Sorry</b>! Something is wrong? Please try again";
                return response()->json(array("msg"=> $msg,'type'=>$type), 200);
        }

    }
}

