<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\newUserRequest;
use App\Http\Requests\User\updateUserRequest;
use App\Http\Requests\User\ResetUserPasswordRequest;
use App\Http\Requests\User\ResetUserPersonalRequest;
use App\Http\Requests\User\ResetUserAccountRequest;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\UserDetail;
use App\Models\User;

use App\Models\State;
use App\Models\City;

use Exception;
use Carbon\Carbon;
use DB;


use App\Mail\TestEmail;
use Mail;

class UserController extends Controller
{
    use ResponseTrait, ImageHandleTraits;

    public function index()
    {
        
        $allUser = User::with('role')->orderBy('id', 'DESC')->paginate(25);
        return view('backend.user.index', compact('allUser'));
    }

    public function addForm()
    {
        $roles = [];
        if (currentUser() == 'superadmin') {
            $roles = Role::whereIn('identity', ['superadmin', 'owner', 'customer','delivery'])->get();
        } 

        $allState = State::orderBy('name', 'ASC')->get();
        $allZone = City::orderBy('name', 'ASC')->get();
        return view('backend.user.add_new', compact(['roles', 'allState', 'allZone']));
    }

    public function store(newUserRequest $request){
        try {
            $user = new User;

            $user->name = $request->fullName;
            $user->email = $request->email;
            $user->mobileNumber = $request->mobileNumber;
            /*$user->state_id = $request->state_id;
            $user->zone_id = explode(',', $request->zone_id)[0];*/
            $user->password = md5($request->password);
            $user->status = $request->status;
            $user->userCreatorId = encryptor('decrypt', $request->userId);
            $user->created_at = Carbon::now();

            if (!!$user->save()) {
                $userd = new UserDetail;
                $userd->userId = $user->id;

                if ($request->has('photo')) $userd->photo = $this->uploadImage($request->file('photo'), 'user/photo');
                $userd->address = $request->address;
                $userd->nid = $request->nid;
                $userd->save();

                return redirect(route(currentUser() . '.allUser'))->with($this->responseMessage(true, null, 'User created'));
            }
        } catch (Exception $e) {
            dd($e);
            return redirect(route(currentUser() . '.allUser'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    public function editForm($name, $id)
    {
        $roles = [];
        if (currentUser() == 'superadmin') {
            $roles = Role::whereIn('identity', ['superadmin', 'owner', 'customer','delivery'])->get();
        } 

        $allState = State::orderBy('name', 'ASC')->get();
        $allZone = City::orderBy('name', 'ASC')->get();
        $user = User::find(encryptor('decrypt', $id));
        return view('backend.user.edit', compact(['user', 'roles', 'allState', 'allZone']));
    }

    public function update(updateUserRequest $request){
        try {
            $user = User::find(encryptor('decrypt', $request->id));
            $user->roleId = $request->role;
            $user->name = $request->fullName;
            if (currentUser() == 'superadmin') {
                $user->email = $request->email;
            }
            $user->mobileNumber = $request->mobileNumber;
            /*$user->state_id = $request->state_id;
            $user->zone_id = $request->zone_id;*/
            $user->password = $request->password == $user->password ? $user->password : md5($request->password);
            $user->status = $request->status;
            $user->userCreatorId = encryptor('decrypt', $request->userId);
            $user->updated_at = Carbon::now();
            if($request->branchId)
                $user->branchId = $request->branchId;

            if (!!$user->save()) {
                if ($user->details) {
                    $userd = UserDetail::find($user->details->id);
                } else {
                    $userd = new UserDetail;
                    $userd->userId = encryptor('decrypt', $request->id);
                }
                if ($request->has('photo'))
                    if ($this->deleteImage($userd->photo, 'user/photo'))
                        $userd->photo = $this->uploadImage($request->file('photo'), 'user/photo');
                    else
                        $userd->photo = $this->uploadImage($request->file('photo'), 'user/photo');

                $userd->address = $request->address;
                $userd->nid = $request->nid;
                $userd->save();

                return redirect(route(currentUser() . '.allUser'))->with($this->responseMessage(true, null, 'User updated'));
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect(route(currentUser() . '.allUser'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    public function delete($name, $id)
    {
        try {
            $user = User::find(encryptor('decrypt', $id));
            if (!!$user->delete()) {
                return redirect(route(currentUser() . '.allUser'))->with($this->responseMessage(true, null, 'User deleted'));
            }
        } catch (Exception $e) {
            dd($e);
            return redirect(route(currentUser() . '.allUser'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    public function modList()
    {
        $allTm = User::select("name", "id")->where("roleId", 6)->orderBy("name", "ASC")->get();
        $allUser = User::select("name", "mobileNumber", "email", "id", DB::raw("(select name from users as u where u.id=users.telemarketerId) as tm"))->where("roleId", 2)->orderBy("id", "DESC")->paginate(25);

        return view('user.owner_list', compact(['allUser', 'allTm']));
    }

    public function modAssign($uid, $tid)
    {
        try {
            $us = User::find(encryptor('decrypt', $uid));

            $us->telemarketerId = encryptor('decrypt', $tid);

            if (!!$us->save()) return redirect(route(currentUser() . '.modList'))->with($this->responseMessage(true, null, 'owner has been assigned'));
        } catch (Exception $e) {
            return redirect(route(currentUser() . '.modList'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    public function userProfile()
    {
        $UserData = User::where("id", currentUserId())->first();
        return view('backend.user.profile', compact(['UserData']));
    }
    public function changePass(ResetUserPasswordRequest $request)
    {
        $pass = User::find(encryptor('decrypt', $request->id));
        try {
            if ($pass['password'] == md5($request->oldpass)) {
                $pass->password = md5($request->pass);
                if (!!$pass->save()) return redirect()->back()->with($this->responseMessage(true, null, 'Password updated'));
            } else {
                return redirect()->back()->with($this->responseMessage(false, 'error', 'Old Password Mismathed!'));
            }
        } catch (Exception $e) {
            return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }
    public function changePer(ResetUserPersonalRequest $request)
    {

        $persoanl = UserDetail::where('userId', '=', encryptor('decrypt', $request->id))->first();

        $account = User::find(encryptor('decrypt', $request->id));
        try {
            if ($request->has('photo'))
                if ($this->deleteImage($persoanl->photo, 'user/photo'))
                    $persoanl->photo = $this->uploadImage($request->file('photo'), 'user/photo');
                else
                    $persoanl->photo = $this->uploadImage($request->file('photo'), 'user/photo');

            $persoanl->nid = $request->nid;
            $persoanl->address = $request->address;


            $account->name = $request->name;
            $account->mobileNumber = $request->mobileNumber;
            $account->save();

            if (!!$persoanl->save()) return redirect()->back()->with($this->responseMessage(true, null, 'Profile Information updated'));
        } catch (Exception $e) {
            return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }
    public function changeAcc(ResetUserAccountRequest $request)
    {
        $account = User::find(encryptor('decrypt', $request->id));
        try {
            $account->name = $request->name;
            $account->mobileNumber = $request->mobileNumber;
            // $account->email = $request->email;
            if (!!$account->save()) return redirect()->back()->with($this->responseMessage(true, null, 'Account Information updated'));
        } catch (Exception $e) {
            return redirect()->back()->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }
    public function upload(Request $request){
        if ($request->has('photo')) $userd->photo = $this->uploadImage($request->file('photo'), 'user/photo');
    }
}
