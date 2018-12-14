<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model{
	public static function obtener($departamento){
		return ['' => 'Seleccione un municipio'] + Municipios::where('departamento_id', $departamento)->get()->mapWithKeys(function($municipio){
			return [$municipio['id'] => $municipio['nombre']];
		})->toArray();
	}
}