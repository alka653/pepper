<?php

namespace App\Http\Requests;

use App\Http\Requests\JsonFormRequest;

class LocalizacionAnatomicaFormRequest extends JsonFormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		return [
			'nombre' => 'required|string|max:45'
		];
	}
	public function messages(){
		return [
			'nombre.required' => 'Debe ingresar el nombre de la lozalicación anatómica',
			'nombre.string' => 'Solo se permiten carácteres',
			'nombre.max' => 'El nombre de la localización anatómica no puede superar los :max caracteres'
		];
	}
}