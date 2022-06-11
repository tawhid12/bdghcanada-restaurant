<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\Company;
use App\Models\User;

use Exception;
use Carbon\Carbon;
// Request
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\newUserRequest;

class AuthenticationController extends Controller
{
    
    use ResponseTrait, ImageHandleTraits;
    
    public function signInForm(){
        return view('authentication.login');
    }
    public function signIn(LoginRequest $request){
        if(!!$this->validUser($request)){
			return redirect(route($this->validUser($request)->roleIdentity.'Dashboard'))->with($this->responseMessage(true, null, 'Log In successed'));
        }
        else
            return redirect(route('signInForm'))->with($this->responseMessage(false, "error", 'Invalid emial or password.'));
    }

    public function restaurantsignUpForm(){
        return view('authentication.restaurant_register');
    }

    public function delivery_boy_signUpForm(){
        return view('authentication.delivery_boy_register');
    }

    public function signUpForm(){
        return view('authentication.register');
    }
	
    public function signUpregistrationStore(newUserRequest $request){
        try {
            $lastCreatedUser = User::take(1)->orderBy('id', 'desc')->first();
            $user = new User;
            $user->roleId = 2;
            $user->name = $request->fullName;
            $user->email = $request->email;
            $user->mobileNumber = $request->mobileNumber;
            $user->password = md5($request->password);
            $user->status = 1;
            $user->userCreatorId = 1;
            $user->created_at = Carbon::now();

            if(!!$user->save()){
				$userd = new UserDetail;
				$userd->userId = $user->id;
				
				if($request->has('photo')) $userd->photo = $this->uploadImage($request->file('photo'), 'user/photo');
				
				$userd->address = $request->address;
				$userd->save();
				
				return redirect(route('signInForm'))->with($this->responseMessage(true, null, 'Successfully Registered'));
			}
        } catch (Exception $e) {
            return redirect(route('signUpForm'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    public function signUp_delivery_boy_Store(newUserRequest $request){
        try {
            $lastCreatedUser = User::take(1)->orderBy('id', 'desc')->first();
            $user = new User;
            $user->roleId = 4;
            $user->name = $request->fullName;
            $user->email = $request->email;
            $user->mobileNumber = $request->mobileNumber;
            $user->password = md5($request->password);
            $user->status = 1;
            $user->userCreatorId = 1;
            $user->created_at = Carbon::now();

            if(!!$user->save()){
				$userd = new UserDetail;
				$userd->userId = $user->id;
				
				if($request->has('photo')) $userd->photo = $this->uploadImage($request->file('photo'), 'user/photo');
				
				$userd->address = $request->address;
				$userd->save();
				
				return redirect(route('signInForm'))->with($this->responseMessage(true, null, 'Successfully Registered'));
			}
        } catch (Exception $e) {
            return redirect(route('signUpForm'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

	public function signUpStore(newUserRequest $request){
        try {
            $lastCreatedUser = User::take(1)->orderBy('id', 'desc')->first();
            $user = new User;
            $user->roleId = 3;
            $user->name = $request->fullName;
            $user->email = $request->email;
            $user->mobileNumber = $request->mobileNumber;
            $user->password = md5($request->password);
            $user->status = 1;
            $user->userCreatorId = 1;
            $user->created_at = Carbon::now();

            if(!!$user->save()){
				$userd = new UserDetail;
				$userd->userId = $user->id;
				
				if($request->has('photo')) $userd->photo = $this->uploadImage($request->file('photo'), 'user/photo');
				
				$userd->address = $request->address;
				$userd->save();
				
				return redirect(route('signInForm'))->with($this->responseMessage(true, null, 'Successfully Registered'));
			}
        } catch (Exception $e) {
            return redirect(route('signUpForm'))->with($this->responseMessage(false, 'error', 'Please try again!'));
            return false;
        }
    }

    public function forgotForm(){
        return view('authentication.forgot');
    }

    public function forgotPassword(ForgotPasswordRequest $request){
        $user = User::where(['email' => $request->email, 'status' => 1])->first();
        !!$user && request()->session()->put(['user' => encryptor('encrypt', $user->id)]);

        if(!!$user) return redirect(route('resetPasswordForm'));
        else return redirect(route('forgotPasswordForm'))->with($this->responseMessage(false, "error", "This email: $request->email not found"));
    }

    public function resetPasswordForm(){
        return view('authentication.reset-password');
    }

    public function resetPassword(ResetPasswordRequest $request){
        $user = User::find(encryptor('decrypt', $request->session()->get('user')))->first();
        $user->password = md5($request->password);
        if($user->save()) return redirect(route('signInForm'))->with($this->responseMessage(true, null, "Password reset successfully. Now you can login"));
    }
    
    public function signOut(){
        //$url = $request->input('url');
        //request()->session()->flush();
        request()->session()->forget(['user','email','name','username','mobileNumber','roleId','uphoto']);
        return redirect(route('signInForm'))->with($this->responseMessage(true, "error", 'Successfully logout.'));
    }

    protected function validUser($request){
        return $this->varifyUser($request);
    }

    protected function varifyUser($request){
        $user = User::join('roles', 'roleId', '=', 'roles.id')
        ->leftJoin('user_details', 'users.id', '=', 'user_details.userId')
        ->select("users.name","users.username","users.id as userId","users.email","users.mobileNumber", "roles.type as roleType", "roles.id as roleId", "user_details.photo", "roles.identity as roleIdentity")
        ->where(['users.mobileNumber' => $request->username, 'users.password' => md5($request->password), 'users.status' => 1])
        ->orWhere(function($query) use($request){
            $query->where(['users.email' => $request->username, 'users.password' => md5($request->password), 'users.status' => 1]);
        })->first();
        !!$user && $this->setSession($user);
        return $user;
    }

    protected function setSession($user){
		if($user->photo)
			$photo=$user->photo;
		else
			$photo="avatar.png";
		
        return request()->session()->put(
        [
            'user' => encryptor('encrypt', $user->userId),
            'email' => encryptor('encrypt', $user->email),
            'name' => encryptor('encrypt', $user->name),
            'username' => encryptor('encrypt', $user->username),
            'mobileNumber' => encryptor('encrypt', $user->mobileNumber),
            'timezone' => encryptor('encrypt', $user->timezone),
            'roleId' => encryptor('encrypt', $user->roleId),
            'roleIdentity' => encryptor('encrypt', $user->roleIdentity),
            'state_id' => $user->state_id,
            'zone_id' => $user->zone_id,
            'uphoto' => $photo,
        ]);
    }
    
}
