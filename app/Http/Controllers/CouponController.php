<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Carbon\Carbon;
use Exception;
class CouponController extends Controller
{
    use ResponseTrait, ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('backend.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupon.add_new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $coupon = new Coupon();
            $coupon->name = $request->name;
            $coupon->code = $request->code;
            if($request->has('icon')) $coupon->icon = $this->uploadImage($request->file('icon'), 'coupon');
            $coupon->discount_type = $request->discount_type;
            $coupon->discount = $request->discount;
            $coupon->max_discount = $request->max_discount;
            $coupon->expires_at = Carbon::parse($request->expires_at)->format('Y-m-d H:i:s');
            $coupon->enabled = $request->enabled?$request->enabled:0;
            $coupon->description = $request->description;
            if(!!$coupon->save()) return redirect(route(currentUser().'.coupon.index'))->with($this->responseMessage(true, null, 'Coupon created'));

        } 
        catch (Exception $e) {
            return redirect(route(currentUser().'.coupon.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function show(Cupon $cupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('backend.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $coupon = Coupon::find($id);
            $coupon->name = $request->name;
            $coupon->code = $request->code;
            if($request->has('icon')) $coupon->icon = $this->uploadImage($request->file('icon'), 'coupon');
            $coupon->discount_type = $request->discount_type;
            $coupon->discount = $request->discount;
            $coupon->max_discount = $request->max_discount;
            $coupon->expires_at = Carbon::parse($request->expires_at)->format('Y-m-d H:i:s');
            $coupon->enabled = $request->enabled?$request->enabled:0;
            $coupon->description = $request->description;
            if(!!$coupon->save()) return redirect(route(currentUser().'.coupon.index'))->with($this->responseMessage(true, null, 'Coupon created'));

        } 
        catch (Exception $e) {
            return redirect(route(currentUser().'.coupon.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cupon $cupon)
    {
        //
    }
}
