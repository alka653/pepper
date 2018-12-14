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
			'email' => 'required|max:190|unique:users,email,'.$user
		];
	}
	public function messages(){
		return [
			'email.required' => 'Debe ingresar el correo electrónico',
			'email.max' => 'El correo electrónico no puede superar los 190 caracteres',
			'email.unique' => 'El correo electrónico ya se encuentra registrado'
		];
	}
}