<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Revisiones extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function inspector(){
		return $this->belongsTo('App\User', 'inspector_id');
	}
	public function getEstado($estado){
		switch($estado){
			case 'R':
				$estado = 'Remitido';
				break;
			case 'N':
				$estado = 'No aceptado';
				break;
			case 'P':
				$estado = 'Pendiente';
				break;
		}
		return $estado;
	}
	public static function saveData($data){
		$data['fecha'] = date('Y-m-d');
		return Revisiones::create($data);
	}
	public static function updateData($request){
		$revision = Revisiones::find($request->revision);
		$revision->observacion = $request->input('observacion');
		$revision->estado = $request->input('estado');
		$revision->save();
		return $revision;
	}
}