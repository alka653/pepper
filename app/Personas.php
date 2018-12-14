<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model{
	protected $guarded = [];
	public $timestamps = false;
	protected $fillable = ['nombre', 'apellido', 'numero_documento', 'municipio_expedicion_id', 'direccion_residencia', 'municipio_residencia_id', 'sexo', 'numero_celular', 'numero_telefonico', 'tipo_documento'];
	public function mascotas(){
		return $this->belongsTo('App\Mascotas', 'propietario_id');
	}
	public static function saveData($data){
		return Personas::create($data);
	}
}