<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposAtaques extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function ataques(){
		return $this->hasMany('App\Ataques', 'tipo_ataque_id');
	}
	public static function lista(){
		return ['' => 'Seleccione una opción'] + TiposAtaques::get()->mapWithKeys(function($tipo_ataque){
			return [$tipo_ataque['id'] => $tipo_ataque['nombre']];
		})->toArray();
	}
	public static function saveData($data){
		return TiposAtaques::create($data);
	}
	public static function updateData($request){
		$tipo_ataque = TiposAtaques::find($request->tipo_ataque);
		$tipo_ataque->nombre = $request->input('nombre');
		$tipo_ataque->save();
		return $tipo_ataque;
	}
}