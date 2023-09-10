<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Exception;
class AdvertisementController extends Controller
{
    use ResponseTrait, ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisements = Advertisement::all();
        return view ('backend.advertisement.index',compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('backend.advertisement.add_new');
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
            $advertisement = new Advertisement();
            $advertisement->name = $request->name;
            $advertisement->link = $request->link;
            if($request->has('image')) $advertisement->image = $this->uploadImage($request->file('image'), 'advertisement');
            if(!!$advertisement->save()) return redirect(route(currentUser().'.advertisement.index'))->with($this->responseMessage(true, null, 'Advertisement created'));

        } catch (Exception $e) {
            return redirect(route(currentUser().'.advertisement.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertisement = Advertisement::find(encryptor('decrypt', $id));
        return view('backend.advertisement.edit',compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $advertisement = Advertisement::find($id);
            $advertisement->name = $request->name;
            $advertisement->link = $request->link;
            if($request->has('image')) 
                if($this->deleteImage($advertisement->image, 'slider'))
                    $advertisement->image = $this->uploadImage($request->file('image'), 'advertisement');
                else
                    $advertisement->image = $this->uploadImage($request->file('image'), 'advertisement');
                    if(!!$advertisement->save()) return redirect(route(currentUser().'.advertisement.index'))->with($this->responseMessage(true, null, 'Advertisement updated'));

        } catch (Exception $e) {
            return redirect(route(currentUser().'.advertisement.index'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        //
    }
}
