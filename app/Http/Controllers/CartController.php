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
        /* get similar product */
        //$similarpro=$products->pluck('category_id','category_id');
        //$similarpro=Product::whereNotIn('id',$pids)->whereIn('category_id',$similarpro)->limit(12)->get();
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
        
        /*if(isset($cart[$id])) {
            if($product->max_qty >= ($cart[$id]['quantity'] + $r->quantity)){
                $cart[$id]['quantity']+=$r->quantity;
            }else{
                $msg="<b>Sorry</b> You cannot buy more than ".$product->max_qty." in single order";
                $type="danger";
            }
        } else {*/
            if($r->quantity!=0){
                $price=$product->price;
                $discount_amount=0;

                if($product->discount_price){
                    $discount_amount=($product->price * ($product->discount_price/100));
                    $price=($product->price - ($product->price * ($product->discount_price/100)));
                }
                
                $vat_amount=0;

                /*if((float) $product->vat_status > 0){
                    $vat_amount=($price * ((float) $product->vat_status/100));
                } */

                $cart[$id] = [
                    "name" => $product->name,
                    "quantity" => $r->quantity,
                    "price" => $product->price,
                    "dis_price" => $price,
                    "discount" => $product->discount_price,
                    "discount_amount" => $discount_amount,
                    /*"vat" => $product->vat_status,
                    "vat_amount" => $vat_amount,
                    "image" => $product->feature_image*/
                ];
            }else{
                $msg="<b>Sorry</b> You cannot buy more than ".$product->max_qty." in single order";
                $type="danger";
            }
        //}
          
        session()->put('cart', $cart);

        return response()->json(array("total_product" => count((array) session('cart')),"msg"=> $msg,'type'=>$type), 200);
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

