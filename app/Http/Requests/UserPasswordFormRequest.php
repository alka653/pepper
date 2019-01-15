<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordFormRequest extends FormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		return [
			'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
			'password_confirmation' => 'min:6'
		];
	}
	public function messages(){
		return [
			'password.required_with' => 'Debes digitar la contraseña',
			'password.same' => 'La contraseña no coincide',
			'password.min' => 'Debe tener más de :min digitos',
			'password_confirmation.min' => 'Debe tener más de :min digitos'
		];
	}
}