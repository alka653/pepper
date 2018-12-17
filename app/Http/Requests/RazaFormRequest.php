<?php

namespace App\Http\Requests;

use App\Http\Requests\JsonFormRequest;

class RazaFormRequest extends JsonFormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		return [
			'nombre' => 'required|max:45',
			'especie' => 'required'
		];
	}
	public function messages(){
		return [
			'nombre.required' => 'Debe ingresar el nombre de la raza',
			'nombre.max' => 'El nombre de la raza no puede superar los :max caracteres',
			'especie.required' => 'Debe seleccionar una opción'
		];
	}
}