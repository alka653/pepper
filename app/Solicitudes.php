<?php

namespace App;

use App\Revisiones;
use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function mascota(){
		return $this->belongsTo('App\Mascotas', 'mascota_id');
	}
	public function documentos(){
		return $this->hasMany('App\Documentos', 'solicitud_id');
	}
	public function revisiones(){
		return $this->hasMany('App\Revisiones', 'solicitud_id')->orderBy('fecha', 'DESC')->orderBy('id', 'DESC');
	}
	public function getEstadoAttribute($estado){
		switch($estado){
			case 'P':
				$estado = '<span class="badge badge-info">Pendiente</span>';
				break;
			case 'F':
				$estado = '<span class="badge badge-success">Finalizado</span>';
				break;
			case 'C':
				$estado = '<span class="badge badge-danger">Cancelado</span>';
				break;
		}
		return $estado;
	}
	public static function revisionesInspector($solicitud_id, $inspector_id){
		return Revisiones::where(['solicitud_id' => $solicitud_id, 'inspector_id' => $inspector_id, 'estado' => 'R'])->count();
	}
	public static function saveData($data){
		$data['fecha_solicitud'] = date('Y-m-d');
		$data['estado'] = 'P';
		return Solicitudes::create($data);
	}
}