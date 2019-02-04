<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\PasswordResets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetFormRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller{
    use ResetsPasswords;
    protected $redirectTo = '/ingresar';
    public function __construct(){
        $this->middleware('guest');
    }
    public function reset(PasswordResetFormRequest $request){
        $user_token = User::where(['email' => $request->email, 'remember_token' => $request->token])->first();
        $password_user_token = PasswordResets::where('email', $request->email);
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);
        if($password_user_token->first() && $user_token){
            $user = User::updatePassword($request->password, $user_token->id);
            $user->remember_token = substr($user->createToken('remember_token')->accessToken, -100);
            $user->save();
            $password_user_token->delete();
            $request->session()->flash('message.level', 'success');
		    $request->session()->flash('message.content', 'Contraseña actualizada con éxito');
            return redirect()->route('login');
        }else{
            $validator->getMessageBag()->add('email', 'Token no válido');    
            return redirect()->route('password.reset.token', $request->token)->withErrors($validator);
        }
        dd($validator);
    }
}