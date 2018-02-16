<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
class ImpersonateUser extends Controller
{
   public function Impersonate(Request $request)
    {
		$key = str_replace('base64:','', \Config::get('app.key'));
		if($request->key == $key){
		$remoteuser = $request->user;
		Auth::loginUsingId($remoteuser, true);
		}
		return redirect('/');
    }
}
