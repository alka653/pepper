<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificados extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function mascota(){
		return $this->belongsTo('App\Mascotas', 'mascota_id');
	}
	public static function saveData($data){
		$data['fecha_remitido'] = date('Y-m-d');
		$data['fecha_vencimiento'] = date('Y-m-d', strtotime('+1 years'));
		return Certificados::create($data);
	}
}