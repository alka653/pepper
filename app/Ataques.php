<?php

namespace App;

use App\Razas;
use Illuminate\Database\Eloquent\Model;

class Ataques extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function victima(){
		return $this->belongsTo('App\Personas', 'victima_id');
	}
	public function mascota(){
		return $this->belongsTo('App\Mascotas', 'mascota_id');
	}
	public function municipio_ataque(){
		return $this->belongsTo('App\Municipios', 'municipio_ataque_id');
	}
	public function tipoAgresion(){
		return $this->belongsTo('App\TiposAtaques', 'tipo_ataque_id');
	}
	public function localizacionesAnatomicas(){
		return $this->belongsToMany('App\LocalizacionesAnatomicas', 'ataques_anatomicas', 'ataque_id', 'localizacion_anatomica_id');
	}
	public function ataqueAnimal(){
		return $this->hasOne('App\AtaquesAnimal', 'ataque_id');
	}
	public function ataqueVictima(){
		return $this->hasOne('App\AtaquesVictima', 'ataque_id');
	}
	public function seguimientos(){
		return $this->hasMany('App\AtaquesSeguimientos', 'ataque_id');
	}
	public function modoMordedura($ataque_mordedura){
		switch($ataque_mordedura){
			case 'C':
				$ataque_mordedura = 'En área cubierta del cuerpo';
				break;
			case 'D':
				$ataque_mordedura = 'En área descubierta del cuerpo';
				break;
		}
		return $ataque_mordedura;
	}
	public function agresionProvocada($agresion_provocada){
		return $agresion_provocada == 1 ? 'Si' : 'No';
	}
	public function tipoLesion($tipo_lesion){
		switch($tipo_lesion){
			case 'U':
				$tipo_lesion = 'Única';
				break;
			case 'M':
				$tipo_lesion = 'Múltiple';
				break;
		}
		return $tipo_lesion;
	}
	public function profundidad($profundidad){
		switch($profundidad){
			case 'S':
				$profundidad = 'Superficial';
				break;
			case 'P':
				$profundidad = 'Profunda';
				break;
		}
		return $profundidad;
	}
	public static function agresorRaza($raza_id){
		return Razas::where('id', $raza_id)->first();
	}
	public static function inArrayFk($localizacion_anatomica, $localizacion_anatomica_list){
		foreach($localizacion_anatomica_list as $item){
			if($item['id'] == $localizacion_anatomica['id']){
				return true;
			}
		}
		return false;
	}
	public static function saveData($data){
		$data['fecha_ataque'] = date('Y-m-d', strtotime($data['fecha_ataque']));
		return Ataques::create($data);
	}
}