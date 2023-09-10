<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Exception;

class SliderController extends Controller
{
    use ResponseTrait, ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.add_new');
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
            $slider = new Slider();
            if($request->has('slider')) $slider->slider = $this->uploadImage($request->file('slider'), 'slider');
            if(!!$slider->save()) return redirect(route(currentUser().'.slider.index'))->with($this->responseMessage(true, null, 'Slider created'));

        } catch (Exception $e) {
            return redirect(route(currentUser().'.slider.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find(encryptor('decrypt', $id));
        return view('backend.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $slider = Slider::find($id);
            if($request->has('slider')) 
                if($this->deleteImage($slider->slider, 'slider'))
                    $slider->slider = $this->uploadImage($request->file('slider'), 'slider');
                else
                    $slider->slider = $this->uploadImage($request->file('slider'), 'slider');
                    if(!!$slider->save()) return redirect(route(currentUser().'.slider.index'))->with($this->responseMessage(true, null, 'Slider updated'));

        } catch (Exception $e) {
            return redirect(route(currentUser().'.slider.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $slider = Slider::find($id);
            if(!!$slider->delete()){
                $this->deleteImage($slider->slider, 'slider');
                return redirect(route(currentUser().'.slider.index'))->with($this->responseMessage(true, null, 'Slider Image deleted'));
            }
        }catch (Exception $e) {
            return redirect(route(currentUser().'.slider.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }
}
