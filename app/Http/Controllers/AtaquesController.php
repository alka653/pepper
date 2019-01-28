<?php

namespace App\Http\Controllers;

use App\Razas;
use App\Ataques;
use App\Mascotas;
use App\Personas;
use App\TiposAtaques;
use App\AtaquesAnimal;
use App\Departamentos;
use App\AtaquesVictima;
use App\AtaquesAnatomicas;
use Illuminate\Http\Request;
use App\LocalizacionesAnatomicas;
use Illuminate\Support\Facades\Auth;

class AtaquesController extends Controller{
	const DIR_TEMPLATE = 'ataques.';
	public function list(Request $request){
		$ataques = new Ataques();
		if(Auth::user()->perfil == 'U'){
			$mascotasList = Mascotas::where('propietario_id', Auth::user()->persona_id)->get()->pluck('id')->toArray();
			$ataques = $ataques->whereIn('mascota_id', $mascotasList);
		}
		return view(self::DIR_TEMPLATE.'list', [
			'ataques' => $ataques->orderBy('fecha_ataque', 'DESC')->paginate(10),
			'item_ataque' => null
		]);
	}
	public function new(){
		return view(self::DIR_TEMPLATE.'form', [
			'ataque' => new Ataques(),
			'razaLista' => Razas::lista(),
			'tipoAgresionLista' => TiposAtaques::lista(),
			'departamentoLista' => Departamentos::lista(),
			'localizacionAnatomicaLista' => LocalizacionesAnatomicas::get(),
			'title' => 'Agresiones por animales potencialmente transmisores de rabia. Código INS:300',
			'route' => ['registrar_ataque.post'],
			'method' => 'post'
		]);
	}
	public function saveOrUpdateData(Request $request){
		$mascota = null;
		$victima = Personas::where('numero_documento', $request->victima['numero_documento'])->first();
		if(!$victima){
			$victima = Personas::saveData([
				'nombre' => $request->victima['nombre'],
				'apellido' => $request->victima['apellido'],
				'numero_documento' => $request->victima['numero_documento'],
				'direccion_residencia' => $request->victima['direccion_residencia'],
				'municipio_residencia_id' => $request->victima['municipio_residencia_id'],
				'sexo' => $request->victima['sexo'],
				'numero_celular' => $request->victima['numero_celular'],
				'tipo_documento' => $request->victima['tipo_documento']
			]);
		}
		$duenio_mascota = Personas::where('numero_documento', $request->propietario['numero_documento'])->first();
		if(!$duenio_mascota){
			$duenio_mascota = null;
			if($request->propietario['numero_documento'] != ''){
				$duenio_mascota = Personas::saveData([
					'nombre' => $request->propietario['nombre'],
					'apellido' => $request->propietario['apellido'],
					'tipo_documento' => $request->propietario['tipo_documento'],
					'numero_documento' => $request->propietario['numero_documento'],
					'direccion_residencia' => $request->propietario['direccion_residencia'],
					'municipio_residencia_id' => $request->propietario['municipio_residencia_id'],
					'numero_celular' => $request->victima['numero_celular'],
					'sexo' => $request->propietario['sexo'],
				])->id;
			}
		}else{
			$duenio_mascota = $duenio_mascota->id;
		}
		$mascota = $request->ataque_animal['mascota_id'];
		if($mascota == null){
			$mascota = Mascotas::saveData([
				'nombre' => $request->ataque_animal['nombre_especie'],
				'propietario_id' => $duenio_mascota,
				'vacunado' => $request->ataque_animal['animal_vacunado'] == 'S' ? true : false,
				'fecha_nacimiento' => null,
				'fecha_vacunacion' => $request->ataque_animal['fecha_vacunacion'],
				'raza_id' => $request->ataque_animal['raza_id']
			])->id;
		}
		$ataque = Ataques::saveData([
			'victima_id' => $victima->id,
			'mascota_id' => $mascota,
			'fecha_ataque' => $request->ataque['fecha_ataque'],
			'descripcion' => $request->ataque['descripcion'],
			'tipo_ataque_id' => $request->ataque['tipo_agresion_id'],
			'ataque_mordedura' => $request->ataque['tipo_agresion_id'] == '1' ? 'C' : 'D',
			'municipio_ataque_id' => $request->ataque['municipio_ataque_id'],
			'agresion_provocada' => $request->ataque['agresion_provocada'] == 'S' ? true : false,
			'tipo_lesion' => $request->ataque['tipo_lesion'],
			'profundidad' => $request->ataque['profundidad']
		]);
		foreach($request->localizacion_anatomica as $localizacion_anatomica){
			$ataque->localizacionesAnatomicas()->attach($localizacion_anatomica);
		}
		$ataque_animal = AtaquesAnimal::saveData([
			'ataque_id' => $ataque->id,
			'animal_vacunado' => $request->ataque_animal['animal_vacunado'],
			'carnet_vacunacion' => $request->ataque_animal['carnet_vacunacion'] != null && $request->ataque_animal['carnet_vacunacion'] != 'N' ? true : false,
			'estado_animal_ataque' => $request->ataque_animal['estado_animal_ataque'],
			'estado_animal_consulta' => $request->ataque_animal['estado_animal_consulta'],
			'ubicacion_animal_agresion' => $request->ataque_animal['ubicacion_animal_agresion'],
			'tipo_exposicion' => $request->ataque_animal['tipo_exposicion']
		]);
		$ataque_victima = AtaquesVictima::saveData([
			'ataque_id' => $ataque->id,
			'suero_antirrabico' => $request->ataque_victima['suero_antirrabico'] == 'S' ? true : false,
			'fecha_aplicacion_suero' => $request->ataque_victima['fecha_aplicacion_suero'],
			'vacuna_antirrabica' => $request->ataque_victima['vacuna_antirrabica'],
			'numero_dosis' => $request->ataque_victima['numero_dosis'],
			'fecha_ultima_dosis' => $request->ataque_victima['fecha_ultima_dosis'],
			'lavado_herida' => $request->ataque_victima['lavado_herida'] == 'S' ? true : false,
			'sutura_herida' => $request->ataque_victima['sutura_herida'] == 'S' ? true : false,
			'orden_suero' => $request->ataque_victima['orden_suero'] == 'S' ? true : false,
			'orden_aplicacion_vacuna' => $request->ataque_victima['orden_aplicacion_vacuna'] == 'S' ? true : false,
			'razon_social_unidad' => $request->ataque_victima['razon_social_unidad']
		]);
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', 'Se ha registrado el ataque occn éxito.');
		return redirect()->route('seguimiento_ataque', ['ataque' => $ataque->id]);
	}
	public function detail(Ataques $ataque){
		return view(self::DIR_TEMPLATE.'detail', [
			'ataque' => $ataque
		]);
	}
}