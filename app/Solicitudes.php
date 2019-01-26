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
	public function getEstado($estado, $withHtml = true){
		$estadoHtml = '';
		switch($estado){
			case 'P':
				$estadoHtml = 'info';
				$estado = 'Radicado';
				break;
			case 'F':
				$estadoHtml = 'success';
				$estado = 'Aprobado';
				break;
			case 'C':
				$estadoHtml = 'danger';
				$estado = 'Rechazado';
				break;
		}
		return $withHtml ? '<span class="badge badge-'.$estadoHtml.'">'.$estado.'</span>' : $estado;
	}
	public static function revisionesInspector($solicitud_id, $inspector_id = null, $estado = 'R'){
		$revisiones = Revisiones::where(['solicitud_id' => $solicitud_id, 'estado' => $estado]);
		return $inspector_id != null ? $revisiones->where(['inspector_id' => $inspector_id])->orderBy('id', 'DESC') : $revisiones->orderBy('id', 'DESC');
	}
	public static function saveData($data){
		$data['fecha_solicitud'] = date('Y-m-d');
		$data['estado'] = 'P';
		return Solicitudes::create($data);
	}
}