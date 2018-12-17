<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalizacionAnatomicaFormRequest extends FormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		return [
			'nombre' => 'required|max:45'
		];
	}
	public function messages(){
		return [
			'nombre.required' => 'Debe ingresar el nombre de la lozalicación anatómica',
			'nombre.max' => 'El nombre de la localización anatómica no puede superar los :max caracteres'
		];
	}
}