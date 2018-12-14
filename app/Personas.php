<?php

namespace App;

use App\Municipios;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Personas extends Model{
	protected $guarded = [];
	public $timestamps = false;
	protected $fillable = ['nombre', 'apellido', 'numero_documento', 'municipio_expedicion_id', 'direccion_residencia', 'municipio_residencia_id', 'sexo', 'numero_celular', 'numero_telefonico', 'tipo_documento', 'ocupacion', 'foto'];
	public function mascotas(){
		return $this->belongsTo('App\Mascotas', 'propietario_id');
	}
	public function getFotoAttribute($foto){
		return $foto != null ? Storage::url($foto) : '/img/user.png';
	}
	public static function getTipoDocumento($tipo_documento){
		switch($tipo_documento){
			case 'RC':
				$tipo_documento = 'Registro civil';
				break;
			case 'TI':
				$tipo_documento = 'Tarjeta de identidad';
				break;
			case 'CC':
				$tipo_documento = 'Cédula de ciudadanía';
				break;
			case 'CE':
				$tipo_documento = 'Cédula extranjera';
				break;
			case 'PS':
				$tipo_documento = 'Pasaporte';
				break;
			case 'MS':
				$tipo_documento = 'Menor sin identificación';
				break;
			case 'AS':
				$tipo_documento = 'Adulto sin identificación';
				break;
		}
		return $tipo_documento;
	}
	public static function getSexo($sexo){
		return $sexo == 'M' ? 'Masculino' : 'Femenino';
	}
	public static function lugar($municipio_id){
		$municipio = Municipios::find($municipio_id);
		return "{$municipio->nombre} - {$municipio->departamento->nombre}";
	}
	public static function saveData($data){
		return Personas::create($data);
	}
}