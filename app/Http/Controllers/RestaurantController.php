<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\State;
use App\Models\City;
use App\Models\Gallery;

use App\Http\Requests\Restaurant\NewRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Storage;

class RestaurantController extends Controller
{
    use ResponseTrait, ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        $restaurant = Restaurant::where('user_id','=',currentUserId())->orderBy('id', 'DESC')->paginate(25);
        return view('backend.restaurant.index',compact('restaurant','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('backend.restaurant.add_new',compact('states'));
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewRestaurantRequest $request)
    {
        //dd($request);die;
        try {
            $resturant = new Restaurant();
            $resturant->user_id =  encryptor('decrypt', request()->session()->get('user'));
            $resturant->state_id = $request->state_id;
            $resturant->city_id = $request->city_id;
            $resturant->name = $request->name;
            if($request->has('logo')) $resturant->logo = $this->uploadImage($request->file('logo'), 'logo');
            if($request->has('feature_image')) $resturant->feature_image = $this->uploadImage($request->file('feature_image'), 'feature_image');
            $resturant->description = $request->description;
            $resturant->address = $request->address;
            $resturant->latitude = $request->latitude;
            $resturant->longitude = $request->longitude;
            $resturant->mobile = $request->mobile;
            $resturant->information = $request->information;
            $resturant->admin_commission = $request->admin_commission;
            $resturant->delivery_fee = $request->delivery_fee;
            $resturant->delivery_time = $request->delivery_time;
            $resturant->delivery_range = $request->delivery_range;
            $resturant->closed = $request->closed?$request->closed:0;
            $resturant->active = $request->active?$request->active:0;
            $resturant->isPromoted = $request->isPromoted?$request->isPromoted:0;
            $resturant->isPopular = $request->isPopular?$request->isPopular:0;
            $resturant->opening_time = Carbon::parse($request->opening_time)->format('H:i:s');
            $resturant->closing_time = Carbon::parse($request->closing_time)->format('H:i:s');
            $resturant->available_for_delivery = $request->available_for_delivery?$request->available_for_delivery:0;
            $resturant->save();

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
                        'restaurant_id' => $resturant->id,
                        'user_id' => currentUserId(),
                        "created_at" =>  date('Y-m-d H:i:s'),
                         "updated_at" => date('Y-m-d H:i:s'),
                    ]);
                }
  
            }

            if(currentUser() == 'superadmin')
                return redirect(route(currentUser().'.allRestaurant'))->with($this->responseMessage(true, null, 'Restaurant Updated'));
                else
                return redirect(route(currentUser().'.info.index'))->with($this->responseMessage(true, null, 'Restaurant Updated'));

        } catch (Exception $e) {
            return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = State::all();
        $restaurant = Restaurant::find(encryptor('decrypt', $id));
        return view('backend.restaurant.edit',compact('restaurant','states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRestaurantRequest $request, $id)
    {
        //dd($request);die;
        try {
            $resturant = Restaurant::find($id);
            if(!currentUser() == 'superadmin'){
            $resturant->user_id =  encryptor('decrypt', request()->session()->get('user'));
            }
            $resturant->state_id = $request->state_id;
            $resturant->city_id = $request->city_id;
            $resturant->name = $request->name;
            if($request->has('logo')) $resturant->logo = $this->uploadImage($request->file('logo'), 'logo');
            if($request->has('feature_image')) $resturant->feature_image = $this->uploadImage($request->file('feature_image'), 'feature_image');
            $resturant->description = $request->description;
            $resturant->address = $request->address;
            $resturant->latitude = $request->latitude;
            $resturant->longitude = $request->longitude;
            $resturant->mobile = $request->mobile;
            $resturant->information = $request->information;
            $resturant->admin_commission = $request->admin_commission;
            $resturant->delivery_fee = $request->delivery_fee;
            $resturant->delivery_time = $request->delivery_time;
            $resturant->delivery_range = $request->delivery_range;
            $resturant->closed = $request->closed;
            $resturant->available_for_delivery = $request->available_for_delivery;
            if(currentUser() == 'superadmin'){
            $resturant->active = $request->active;
            $resturant->isPromoted = $request->isPromoted?$request->isPromoted:0;
            $resturant->isPopular = $request->isPopular?$request->isPopular:0;
            }
            $resturant->opening_time = Carbon::parse($request->opening_time)->format('H:i:s');
            $resturant->closing_time = Carbon::parse($request->closing_time)->format('H:i:s');
            if(!!$resturant->save()){
                if(currentUser() == 'superadmin')
                return redirect(route(currentUser().'.allRestaurant'))->with($this->responseMessage(true, null, 'Restaurant Updated'));
                else
                return redirect(route(currentUser().'.info.index'))->with($this->responseMessage(true, null, 'Restaurant Updated'));
            }

        } catch (Exception $e) {
            return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $restaurant = Restaurant::find(encryptor('decrypt', $id));
            if(!!$restaurant->delete()){
                return redirect(route(currentUser().'.info.index'))->with($this->responseMessage(true, null, 'Restaurant deleted'));
            }
        }catch (Exception $e) {
            return redirect(route(currentUser().'.info.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    public function getCity($id){
        $cities = City::where('stateId',$id)->get();
        return response()->json($cities);
    }

    public function allRestaurant(){
        $restaurant = Restaurant::orderBy('id', 'DESC')->paginate(25);
        return view('backend.restaurant.all',compact('restaurant'));
    }

    public function changerestaurantFeatured(Request $request)
    {
        $user = Restaurant::find($request->id);
        $user->isPromoted = $request->isPromoted;
        $user->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }
    public function changerestaurantPopular(Request $request)
    {
        $user = Restaurant::find($request->id);
        $user->isPopular = $request->isPopular;
        $user->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }

}
