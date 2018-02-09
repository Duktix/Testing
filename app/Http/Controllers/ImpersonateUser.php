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
		if($request->headers->get('referer') == 'http://admin.frezit.com/sites'){
		$remoteuser = $request->user;
		Auth::loginUsingId($remoteuser, true);
		}
		return redirect('/');
    }
}
