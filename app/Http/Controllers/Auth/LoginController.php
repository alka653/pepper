<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller{
	use AuthenticatesUsers;
	protected $redirectTo = '/';
	public function __construct(){
		$this->middleware('guest')->except('logout');
	}
	protected function credentials(Request $request){
		return [
			'username' => $request->email,
			'password' => $request->password,
		];
	}
}