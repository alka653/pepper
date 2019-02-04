<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetFormRequest extends FormRequest{
    public function authorize(){
        return true;
    }
    public function rules(){
		return [
            'email' => 'required|email',
			'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
			'password_confirmation' => 'min:6'
		];
	}
	public function messages(){
		return [
            'email.required' => 'Debe ingresar el correo electrónico',
            'email.email' => 'Correo electrónico no válido',
			'password.required_with' => 'Debe digitar la contraseña',
			'password.same' => 'La contraseña no coincide',
			'password.min' => 'Debe tener más de :min digitos',
			'password_confirmation.min' => 'Debe tener más de :min digitos'
		];
	}
}