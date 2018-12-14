<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model{
	protected $guarded = [];
	public $timestamps = false;
	public function getTipoAttribute($tipo){
		switch($tipo){
			case 'C':
				$tipo = 'Carnet de vacunación';
				break;
			case 'P':
				$tipo = 'Póliza';
				break;
			case 'D':
				$tipo = 'Declaración';
				break;
		}
		return $tipo;
	}
	public static function saveData($data){
		return Documentos::create($data);
	}
}