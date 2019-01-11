<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtaquesSeguimientos extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public static function getTipo($tipo){
		switch($tipo){
			case 'V':
				$tipo = 'Victima';
				break;
			case 'A':
				$tipo = 'Atacante';
				break;
		}
		return $tipo;
	}
	public static function saveData($data){
		$data['fecha'] = date('Y-m-d', strtotime($data['fecha']));
		return AtaquesSeguimientos::create($data);
	}
	public static function updateData($request){
		$ataque_seguimiento = AtaquesSeguimientos::find($request->seguimiento);
		$ataque_seguimiento->descripcion = $request->descripcion;
		$ataque_seguimiento->tipo = $request->tipo;
		$ataque_seguimiento->fecha = date('Y-m-d', strtotime($request->fecha));
		$ataque_seguimiento->save();
		return $ataque_seguimiento;
	}
}