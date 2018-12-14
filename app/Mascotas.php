<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function fotos(){
		return $this->hasMany('App\MascotasFotos', 'mascota_id');
	}
	public function certificados(){
		return $this->hasMany('App\Certificados', 'mascota_id');
	}
	public function propietario(){
		return $this->belongsTo('App\Personas', 'propietario_id');
	}
	public function raza(){
		return $this->belongsTo('App\Razas', 'raza_id');
	}
	public static function getSexo($sexo){
		return $sexo == 'M' ? 'Masculino' : 'Femenino';
	}
	public function getEstadoAttribute($estado){
		return $estado == 'V' ? 'Vivo' : 'Fallecido';
	}
	public static function listaMascotasByUser($propietario){
		return Mascotas::where('propietario_id', $propietario)->get()->map(function($mascota){
			return $mascota->only(['id']);
		})->toArray();
	}
	public static function saveData($data){
		return Mascotas::create($data);
	}
	public static function updateData($request){
		$mascota = Mascotas::find($request->mascota);
		$mascota->nombre = $request->input('nombre');
		$mascota->fecha_nacimiento = $request->input('fecha_nacimiento');
		$mascota->sexo = $request->input('sexo');
		$mascota->color = $request->input('color');
		$mascota->descripcion = $request->input('descripcion');
		$mascota->vacunado = $request->input('vacunado');
		$mascota->fecha_vacunacion = $request->input('fecha_vacunacion');
		$mascota->raza_id = $request->input('raza_id');
		$mascota->save();
		return $mascota;
	}
}