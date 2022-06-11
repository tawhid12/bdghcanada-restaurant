<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Http\Traits\ResponseTrait;
use Session;

class isDeliveryBoy
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Session::has('user') || Session::get('user') == null || !Session::has('roleId')){
            return redirect()->route('logOut');
        }else{
            $user = User::find(encryptor('decrypt', Session::get('user')));
            $role = Role::find(encryptor('decrypt', Session::get('roleId')));
            if(!$user || !$role){
                return redirect()->route('logOut');
            }else if ($role->identity != 'delivery') {
                return redirect(route($role->identity.'Dashboard'))->with($this->responseMessage(false, null, 'Access Deined'));
            }else{
                return $next($request);
            }
        }
        return redirect()->route('logOut');
    }
}
