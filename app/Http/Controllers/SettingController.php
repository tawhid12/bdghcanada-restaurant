<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Exception;
class SettingController extends Controller
{
    use ResponseTrait, ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('backend.setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting::find($id);
        return view('backend.setting.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
        $setting = Setting::find($id);
        if($request->has('logo')) 
                if($this->deleteImage($setting->logo, 'setting'))
                    $setting->logo = $this->uploadImage($request->file('logo'), 'setting');
                else
                    $setting->icon = $this->uploadImage($request->file('logo'), 'setting');
        $setting->name = $request->name;
        $setting->phone = $request->phone;
        $setting->mobile = $request->mobile;
        $setting->email = $request->email;
        $setting->youtube = $request->youtube;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->google_plus = $request->google_plus;
        $setting->instagram = $request->instagram;
        $setting->gst = $request->gst;
        $setting->hst = $request->hst;
        $setting->address = $request->address;
        if(!!$setting->save()) return redirect(route(currentUser().'.settins.index'))->with($this->responseMessage(true, null, 'Setting infomarion updated'));

        } catch (Exception $e) {
            return redirect(route(currentUser().'.settings.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
