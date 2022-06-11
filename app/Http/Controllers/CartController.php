<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use Illuminate\Http\Request;

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
       // $gs=GeneralSetting::first(); here need to pass deliver charge and other information reference sharif bhai
        $products=Food::whereIn('id',$pids);
        /* get cart product */
        $products= $products->get();
        return view('frontend.cart',compact('products','cart','similarpro','gs'));
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
        $msg="<b>Congratulation!</b> Product added to cart.";
        $type="";
        $cart = session()->get('cart', []);

     
      
        $restaurant_id = array_keys(array_combine(array_keys($cart), array_column($cart, 'restaurant_id')),$r->restaurant_id);
        if(!$restaurant_id && !empty($cart)){
            unset($cart);
        }
                        




            if(isset($cart[$id])) {
                $cart[$id]['quantity']+=$r->quantity;
            }else{
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
                        
                    $cart[$id] = [
                        "restaurant_id" => $product->restaurant_id,
                        "name" => $product->name,
                        "quantity" => $r->quantity,
                        "price" => $product->price,
                        "dis_price" => $price,
                        "discount" => $discount_amount,
                        "image" => $product->feature_image
                    ];
                
                    
                    
                }
            }
     
        session()->put('cart', $cart);
        return response()->json(array("total_product" => count((array) session('cart')),"msg"=> $msg,'type'=>$type,'url' => route('restaurantDetl',$product->restaurant_id),'data' => $restaurant_id), 200);
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
                $pids=array_keys((array) session('cart'));
                $products=Product::whereIn('id',$pids)->get();
                $type="success";
                $msg="<b>Congratulation!</b> Product deleted from cart.";
                return View::make("frontend.cart_support",compact('cart','products','type','msg'))->render();
            }else{
                $msg="<b>Sorry</b>! This product is not available in your cart.";
                return View::make("frontend.cart_support",compact('cart','products','type','msg'))->render();
            }
        }else{
                $msg="<b>Sorry</b>! Something is wrong? Please try again";
            return View::make("frontend.cart_support",compact('cart','products','type','msg'))->render();
        }

    }
}

