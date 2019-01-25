<?php

namespace App;

use Illuminate\Support\Facades\Auth;
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
		return $sexo == 'M' ? 'Macho' : 'Hembra';
	}
	public function getEstadoAttribute($estado){
		return $estado == 'V' ? 'Vivo' : 'Fallecido';
	}
	public static function getEdad($fecha_nacimiento){
		$edad = intval(date('Y', time() - strtotime($fecha_nacimiento))) - 1970;
		return $edad > 1 ? $edad.' años' : ($edad < 1 ? (explode('/', $fecha_nacimiento)[1] - date('m')).' meses' : $edad.' año');
	}
	public static function listaMascotasByUser($propietario){
		return Mascotas::where('propietario_id', $propietario)->get()->map(function($mascota){
			return $mascota->only(['id']);
		})->toArray();
	}
	public static function saveData($data){
		$data['fecha_nacimiento'] = $data['fecha_nacimiento'] != null ? date('Y-m-d', strtotime($data['fecha_nacimiento'])) : null;
		$data['fecha_vacunacion'] = $data['fecha_vacunacion'] != null ? date('Y-m-d', strtotime($data['fecha_vacunacion'])) : null;
		return Mascotas::create($data);
	}
	public static function updateData($request){
		$mascota = Mascotas::find($request->mascota->id);
		$mascota->nombre = $request->input('nombre');
		$mascota->fecha_nacimiento = $request->input('fecha_nacimiento');
		$mascota->sexo = $request->input('sexo');
		$mascota->color = $request->input('color');
		$mascota->descripcion = $request->input('descripcion');
		$mascota->vacunado = $request->input('vacunado');
		$mascota->fecha_vacunacion = $request->input('fecha_vacunacion');
		$mascota->raza_id = $request->input('raza_id');
		if(Auth::user()->perfil != 'U'){
			$mascota->propietario_id = $request->input('propietario_id');
		}
		$mascota->save();
		return $mascota;
	}
}