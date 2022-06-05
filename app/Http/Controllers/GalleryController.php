<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Storage;
use Exception;
use DB;
class GalleryController extends Controller
{
    use ResponseTrait, ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $restaurants = Restaurant::where('user_id','=',currentUserId())->orderBy('id','desc')->get();
        return view('backend.gallery.add_new',compact('restaurants'));
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
        $status = false;
        $image = array();
        if($file = $request->file('gallery_img')){
            foreach($file as $file){
                $image_name = md5(rand(1000,10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $uploade_path = 'images/gallery/';
                //$image_url = $uploade_path.$image_full_name;
                //$file->move($uploade_path,$image_full_name);
                Storage::disk('public')->putFileAs("images/gallery/", $file, $image_full_name);
                $image[] = $image_name;
                Gallery::insert([
                    'gallery_img' => $image_full_name,
                    'restaurant_id' => $request->restaurant_id,
                    'user_id' => currentUserId(),
                    "created_at" =>  date('Y-m-d H:i:s'),
                     "updated_at" => date('Y-m-d H:i:s'),
                ]);
            }
        $status = true;    
        }
        if($status) return redirect(route(currentUser().'.gallery.index'))->with($this->responseMessage(true, null, 'Gallery created'));
        } catch (Exception $e) {
            return redirect(route(currentUser().'.gallery.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallerybyRestaurant = Gallery::where(['user_id' => currentUserId(),'restaurant_id' => encryptor('decrypt',$id)])->paginate(10);
        $restaurant = Restaurant::where(['user_id' => currentUserId(),'id' => encryptor('decrypt',$id)])->first();
        return view('backend.gallery.index',compact('gallerybyRestaurant','restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
}
