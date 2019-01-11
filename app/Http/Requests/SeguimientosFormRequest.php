<?php

namespace App\Http\Requests;

use App\Http\Requests\JsonFormRequest;

class SeguimientosFormRequest extends JsonFormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		return [
			'fecha' => 'required|date',
			'descripcion' => 'required',
			'tipo' => 'required'
		];
	}
	public function messages(){
		return [
			'fecha.required' => 'Debe ingresar la fecha',
			'fecha.date' => 'La fecha no es válida',
			'descripcion.required' => 'Debe ingresar la descripción',
			'tipo.required' => 'Debe ingresar el tipo'
		];
	}
}