<?php

namespace App\Http\Requests;

use App\Http\Requests\JsonFormRequest;

class TipoAtaqueFormRequest extends JsonFormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		return [
			'nombre' => 'required|max:200'
		];
	}
	public function messages(){
		return [
			'nombre.required' => 'Debe ingresar el nombre del tipo de ataque',
			'nombre.max' => 'El nombre del tipo de ataque no puede superar los :max caracteres',
		];
	}
}