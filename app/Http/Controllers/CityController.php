<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Http\Requests\City\NewCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Traits\ResponseTrait;

use Exception;
use Carbon\Carbon;

class CityController extends Controller
{
    use ResponseTrait;
    public function index(){
        $allCity = City::orderBy('id', 'DESC')->paginate(25);
        return view('backend.city.index', compact('allCity'));
    }
    public function addForm()
    {
        $states = state::all();
        return view('backend.city.add_new',compact('states'));
    }
    public function store(NewCityRequest $request)
    {
        try {
            $state = new City;
            $state->code = $request->stateCode;
            $state->name = $request->stateName;
            $state->created_at = Carbon::now();

            if(!!$state->save()) return redirect(route(currentUser().'.allCity'))->with($this->responseMessage(true, null, 'City created'));

        } catch (Exception $e) {
            dd($e);
            return redirect(route(currentUser().'.allState'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }
    public function editForm($name, $id)
    {
        $states = state::all();
        $city = City::find(encryptor('decrypt', $id));
        return view('backend.city.edit', compact(['city','states']));
    }

    public function update(UpdateCityRequest $request)
    {
        try {
            $city = City::find(encryptor('decrypt', $request->id));
            $city->stateId = $request->stateId;
            $city->code = $request->code;
            $city->name = $request->name;
            $city->updated_at = Carbon::now();

            if(!!$city->save()) return redirect(route(currentUser().'.allCity'))->with($this->responseMessage(true, null, 'City updated'));

        } catch (Exception $e) {
            dd($e);
            return redirect(route(currentUser().'.allCity'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }
    public function delete($name, $id){
        try {
            $city = City::find(encryptor('decrypt', $id));
            if(!!$city->delete())
                return redirect(route(currentUser().'.allCity'))->with($this->responseMessage(true, null, 'City deleted'));
                
        }catch (Exception $e) {
            dd($e);
            return redirect(route(currentUser().'.allCity'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }
}
