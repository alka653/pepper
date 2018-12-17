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
		return $this->hasMany('App\Mascotas', 'propietario_id');
	}
	public function municipio_expedicion(){
		return $this->belongsTo('App\Municipios', 'municipio_expedicion_id');
	}
	public function municipio_residencia(){
		return $this->belongsTo('App\Municipios', 'municipio_residencia_id');
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
	public static function updateData($request){
		$persona = Personas::find($request->persona);
		$persona->nombre = $request->nombre;
		$persona->apellido = $request->apellido;
		$persona->numero_documento = $request->numero_documento;
		$persona->municipio_expedicion_id = $request->municipio_expedicion_id;
		$persona->direccion_residencia = $request->direccion_residencia;
		$persona->municipio_residencia_id = $request->municipio_residencia_id;
		$persona->sexo = $request->sexo;
		$persona->numero_celular = $request->numero_celular;
		$persona->numero_telefonico = $request->numero_telefonico;
		$persona->tipo_documento = $request->tipo_documento;
		$persona->ocupacion = $request->ocupacion;
		if($request->foto){
			$persona->foto = $request->foto->store('personas');
		}
		$persona->save();
		return $persona;
	}
}