<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtaquesAnimal extends Model{
	protected $guarded = [];
	public $timestamps = false;
	protected $table = 'ataques_animal';
	public function animalVacunado($animal_vacunado){
		switch($animal_vacunado){
			case 'S':
				$animal_vacunado = 'Si';
				break;
			case 'N':
				$animal_vacunado = 'No';
				break;
			case 'D':
				$animal_vacunado = 'Desconocido';
				break;
		}
		return $animal_vacunado;
	}
	public function carnetVacunacion($carnet_vacunacion){
		return $carnet_vacunacion == '1' ? 'Si' : 'No';
	}
	public function estadoAnimalAtaque($estado_animal_ataque){
		switch($estado_animal_ataque){
			case 'CS':
				$estado_animal_ataque = 'Con signos de rabia';
				break;
			case 'SS':
				$estado_animal_ataque = 'Sin signos de rabia';
				break;
			case 'D':
				$estado_animal_ataque = 'Desconocido';
				break;
		}
		return $estado_animal_ataque;
	}
	public function estadoAnimalConsulta($estado_animal_consulta){
		switch($estado_animal_consulta){
			case 'V':
				$estado_animal_consulta = 'Vivo';
				break;
			case 'M':
				$estado_animal_consulta = 'Muerto';
				break;
			case 'D':
				$estado_animal_consulta = 'Desconocido';
				break;
		}
		return $estado_animal_consulta;
	}
	public function ubicacionAnimalAgresion($ubicacion_animal_agresion){
		switch($ubicacion_animal_agresion){
			case 'O':
				$ubicacion_animal_agresion = 'Observable';
				break;
			case 'P':
				$ubicacion_animal_agresion = 'Perdido';
				break;
		}
		return $ubicacion_animal_agresion;
	}
	public function tipoExposicion($tipo_exposicion){
		switch($tipo_exposicion){
			case 'N':
				$tipo_exposicion = 'No exposición';
				break;
			case 'EL':
				$tipo_exposicion = 'Exposición leve';
				break;
			case 'EG':
				$tipo_exposicion = 'Exposición grave';
				break;
		}
		return $tipo_exposicion;
	}
	public static function saveData($data){
		return AtaquesAnimal::create($data);
	}
}