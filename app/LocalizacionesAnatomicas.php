<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalizacionesAnatomicas extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function ataques(){
		return $this->hasMany('App\AtaquesAnatomicas', 'localizacion_anatomica_id');
	}
	public static function lista(){
		return LocalizacionesAnatomicas::get()->mapWithKeys(function($localizacion_anatomica){
			return [$localizacion_anatomica['id'] => $localizacion_anatomica['nombre']];
		})->toArray();
	}
	public static function saveData($data){
		return LocalizacionesAnatomicas::create($data);
	}
	public static function updateData($request){
		$localizacion_anatomica = LocalizacionesAnatomicas::find($request->localizacion_anatomica);
		$localizacion_anatomica->nombre = $request->input('nombre');
		$localizacion_anatomica->save();
		return $localizacion_anatomica;
	}
}