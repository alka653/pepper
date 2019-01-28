<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MascotaFormRequest extends FormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		return [
			'nombre' => 'required|max:20',
			'fecha_nacimiento' => 'required',
			'sexo' => 'required|max:1',
			'color' => 'required',
			'color_otro' => 'nullable',
			'vacunado' => 'nullable|max:1',
			'fecha_vacunacion' => 'nullable|date',
			'ocupacion' => 'required',
			'ocupacion_otro' => 'nullable',
			'raza_id' => 'required',
			'descripcion' => 'required',
			'foto[]' => 'nullable|image'
		];
	}
	public function messages(){
		return [
			'nombre.required' => 'Debe ingresar el nombre de tu mascota',
			'nombre.max' => 'El nombre de tu mascota no debe superar los 20 caracteres',
			'fecha_nacimiento.required' => 'Debe ingresar la fecha de nacimiento de tu mascota',
			'sexo.required' => 'Debe seleccionar el sexo de tu mascota',
			'sexo.max' => 'Selecciona una opción válida',
			'vacunado.max' => 'Selecciona una opción válida',
			'fecha_vacunacion.date' => 'Ingresa una fecha válida',
			'color.required' => 'Debe ingresa el color de tu mascota',
			'ocupacion.required' => 'Debe seleccionar una ocupación',
			'descripcion.required' => 'Debe ingresar una breve descripción de tu mascota',
			'raza_id.required' => 'Debe seleccionar la raza de tu mascota',
			'foto[].image' => 'Debe ingresar una imagen válida'
		];
	}
}