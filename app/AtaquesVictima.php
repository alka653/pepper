<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtaquesVictima extends Model{
	protected $guarded = [];
	public $timestamps = false;
	protected $table = 'ataques_victima';
	public function sueroAntirrabico($suero_antirrabico){
		return $suero_antirrabico == 1 ? 'Si' : 'No';
	}
	public function vacunaAntirrabica($vacuna_antirrabica){
		switch($vacuna_antirrabica){
			case 'S':
				$vacuna_antirrabica = 'Si';
				break;
			case 'N':
				$vacuna_antirrabica = 'No';
				break;
			case 'D':
				$vacuna_antirrabica = 'No sabe';
				break;
		}
		return $vacuna_antirrabica;
	}
	public function lavadoHerida($lavado_herida){
		return $lavado_herida == 1 ? 'Si' : 'No';
	}
	public function suturaHerida($sutura_herida){
		return $sutura_herida == 1 ? 'Si' : 'No';
	}
	public function ordenSuero($orden_suero){
		return $orden_suero == 1 ? 'Si' : 'No';
	}
	public function ordenAplicacionVacuna($orden_aplicacion_vacuna){
		return $orden_aplicacion_vacuna == 1 ? 'Si' : 'No';
	}
	public static function saveData($data){
		$data['fecha_aplicacion_suero'] = date('Y-m-d', strtotime($data['fecha_aplicacion_suero']));
		$data['fecha_ultima_dosis'] = date('Y-m-d', strtotime($data['fecha_aplicacion_suero']));
		return AtaquesVictima::create($data);
	}
}