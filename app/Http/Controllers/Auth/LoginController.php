<?php

namespace App\Http\Controllers\Auth;

use App\User;
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
			'estado' => 'A'
		];
	}
	protected function sendLoginResponse(Request $request){
		$user = User::where('username', $request->email)->first();
		$user->intentos_ingreso = '0';
		$user->save();
		$request->session()->regenerate();
    	$this->clearLoginAttempts($request);
    	return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
	}
	protected function sendFailedLoginResponse(Request $request){
		$errors = [$this->username() => trans('auth.failed')];
		$user = User::where('username', $request->email)->first();
		if($user){
			switch($user->estado){
				case 'A':
					$user->intentos_ingreso = intval($user->intentos_ingreso) + 1;
					if($user->intentos_ingreso > 2){
						$user->estado = 'B';
						$errors = [$this->username() => trans('auth.blocked')];
					}
					$user->save();
					break;
				case 'I':
					$errors = [$this->username() => trans('auth.notactivated')];
					break;
				case 'B':
					$errors = [$this->username() => trans('auth.blocked')];
					break;
			}
		}
		return redirect()->back()->withInput($request->only($this->username(), 'remember'))->withErrors($errors);
	}
}