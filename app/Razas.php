<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Razas extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function mascotas(){
		return $this->hasMany('App\Mascotas', 'raza_id');
	}
	public function getFotoAttribute($foto){
		return $foto != null ? Storage::url($foto) : '/img/dog.png';
	}
	public static function getEspecie($especie){
		switch($especie){
			case 'C':
				$especie = 'Canino';
				break;
			case 'F':
				$especie = 'Felino';
				break;
			default:
				$especie = 'Otro';
				break;
		}
		return $especie;
	}
	public static function lista($title = 'Seleccione una raza'){
		return ['' => $title] + Razas::get()->mapWithKeys(function($raza){
			return [$raza['id'] => $raza['nombre']];
		})->toArray();
	}
	public static function saveData($data){
		return Razas::create($data);
	}
	public static function updateData($request){
		$raza = Razas::find($request->raza);
		$raza->nombre = $request->input('nombre');
		$raza->especie = $request->input('especie');
		$raza->save();
		return $raza;
	}
}