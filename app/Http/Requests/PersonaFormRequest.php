<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonaFormRequest extends FormRequest{
	public function authorize(){
		return true;
	}
	public function rules(){
		$persona = '';
		if($this->persona || $this->id){
			$persona = $this->persona ? $this->persona : $this->id;
		}
		return [
			'nombre' => 'required|max:45,nombre,'.$persona,
			'apellido' => 'required|max:45,apellido,'.$persona,
			'tipo_documento' => 'required|max:2,tipo_documento,'.$persona,
			'numero_documento' => 'required|unique:personas|max:15,numero_documento,'.$persona,
			'departamento_expedicion_id' => 'required',
			'municipio_expedicion_id' => 'required|max:5,municipio_expedicion_id,'.$persona,
			'departamento_residencia_id' => 'required',
			'municipio_residencia_id' => 'required|max:5,municipio_residencia_id,'.$persona,
			'direccion_residencia' => 'required|max:150,direccion_residencia,'.$persona,
			'sexo' => 'required|max:2,sexo,'.$persona,
			'numero_celular' => 'required|max:10,numero_celular,'.$persona,
			'numero_telefonico' => 'max:10,numero_telefonico,'.$persona,
			'ocupacion' => 'required|max:200,ocupacion,'.$persona,
			'ocupacion_otro' => 'nullable',
			'foto' => 'nullable|image'
		];
	}
	public function messages(){
		return [
			'nombre.required' => 'Debe ingresar el nombre',
			'nombre.max' => 'El nombre no puede superar los :max caracteres',
			'apellido.required' => 'Debe ingresar el apellido',
			'apellido.max' => 'El apellido no puede superar los :max caracteres',
			'tipo_documento.required' => 'Debe ingresar el tipo de documento',
			'departamento_expedicion_id.required' => 'Debe selecccionar una opción',
			'municipio_expedicion_id.required' => 'Debe selecccionar una opción',
			'departamento_residencia_id.required' => 'Debe selecccionar una opción',
			'municipio_residencia_id.required' => 'Debe selecccionar una opción',
			'numero_documento.required' => 'Debe ingresar el número de documento',
			'numero_documento.unique' => 'El número de documento ya se encuentra registrado',
			'numero_documento.max' => 'El número de documento no debe superar los :max caracteres',
			'direccion_residencia.required' => 'Debe ingresar la dirección de residencia',
			'direccion_residencia.max' => 'La dirección de residencia no debe superar los :max caracteres',
			'sexo.required' => 'Debe ingresar la orientación sexual',
			'numero_celular.required' => 'Debe ingrresar el número de celular',
			'numero_celular.max' => 'El número de celular no puede superar los :max caracteres',
			'numero_telefonico.max' => 'El número de teléfono no puede superar los :max caracteres',
			'ocupacion.max' => 'La ocupación no debe superar los :max caracteres',
			'ocupacion.required' => 'Debe ingresar tu ocupación',
			'foto.image' => 'Archivo inválido'
		];
	}
}