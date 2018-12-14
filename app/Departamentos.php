<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model{
	public static function lista(){
		return ['' => 'Seleccione un departamento'] + Departamentos::get()->mapWithKeys(function($departamento){
			return [$departamento['id'] => $departamento['nombre']];
		})->toArray();
	}
}