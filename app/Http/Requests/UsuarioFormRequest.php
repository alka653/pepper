<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		$user = '';
		if($this->user || $this->id){
			$user = $this->user ? $this->user : $this->id;
		}
		return [
			'email' => 'required|max:190|unique:users,email,'.$user,
			'username' => 'required|max:20|unique:users,username,'.$user
		];
	}
	public function messages(){
		return [
			'email.required' => 'Debe ingresar el correo electrónico',
			'email.max' => 'El correo electrónico no puede superar los 190 caracteres',
			'email.unique' => 'El correo electrónico ya se encuentra registrado',
			'username.required' => 'Debe ingresar el nombre de usuario',
			'username.max' => 'El nombre de usuario no puede superar los 190 caracteres',
			'username.unique' => 'El nombre de usuario ya se encuentra registrado'
		];
	}
}