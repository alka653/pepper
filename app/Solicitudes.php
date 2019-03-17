<?php

namespace App;

use App\Revisiones;
use App\Solicitudes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
	public function getEstado($solicitud_id, $withHtml = true){
		$estadoHtml = '';
		$solicitud = Solicitudes::where('id', $solicitud_id)->first();
		if($solicitud->estado == 'F'){
			$estadoHtml = 'success';
			$estado = 'Aprobado';
		}elseif($solicitud->estado == 'C'){
			$estadoHtml = 'danger';
			$estado = 'Vencido';
		}elseif(Revisiones::where('solicitud_id', $solicitud_id)->count() == 0){
			$estadoHtml = 'info';
			$estado = 'Radicado';
		}elseif(Revisiones::where(['solicitud_id' => $solicitud_id, 'estado' => 'N'])->orderBy('modo', 'DESC')->first() != null){
			$estadoHtml = 'warning';
			$estado = 'Rechazado';
		}else{
			$estadoHtml = 'info';
			$estado = 'Proceso';
		}
		return $withHtml ? '<span class="badge badge-'.$estadoHtml.'">'.$estado.'</span>' : $estado;
	}
	public static function revisionesInspector($solicitud_id, $inspector_id = null, $estado = ['R']){
		$response = true;
		$revisiones = Revisiones::where(['solicitud_id' => $solicitud_id])->whereIn('estado', $estado);
		if($inspector_id != null){
			$modo = '';
			switch(Auth::user()->perfil){
				case 'Z':
					$modo = 1;
					break;
				case 'C':
					$modo = 2;
					break;
				case 'J':
					$modo = 3;
					break;
			}
			if($revisiones->where('modo', $modo)->whereIn('estado', ['N', 'P'])->count() == 0){
				$response = false;
			}
		}
		return [
			'data' => $revisiones->orderBy('id', 'DESC'),
			'response' => $response
		];
	}
	public static function saveData($data){
		$data['fecha_solicitud'] = date('Y-m-d');
		$data['estado'] = 'P';
		$solicitud = Solicitudes::create($data);
		Revisiones::saveData([
			'solicitud_id' => $solicitud->id,
			'estado' => 'P',
			'modo' => 1
		]);
		return $solicitud;
	}
}