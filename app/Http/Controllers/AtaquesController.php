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
	public function edit(Ataques $ataque){
		$ataque_animal = $ataque->ataqueAnimal;
		$ataque_animal->mascota_id = $ataque->mascota_id;
		$propietario = Personas::with('municipio_residencia')->where('id', $ataque->mascota->propietario_id)->first();
		return view(self::DIR_TEMPLATE.'form', [
			'ataque' => [
				'ataque' => $ataque,
				'ataque_victima' => $ataque->ataqueVictima,
				'ataque_animal' => $ataque_animal,
				'propietario' => $propietario,
				'victima' => Personas::with('municipio_expedicion', 'municipio_residencia')->where('id', $ataque->victima_id)->first()
			],
			'razaLista' => Razas::lista(),
			'tipoAgresionLista' => TiposAtaques::lista(),
			'departamentoLista' => Departamentos::lista(),
			'localizacionAnatomicaLista' => LocalizacionesAnatomicas::get(),
			'title' => 'Agresiones por animales potencialmente transmisores de rabia. Código INS:300',
			'route' => ['editar_ataque.post', $ataque->id],
			'method' => 'post'
		]);
	}
	public function saveOrUpdateData(Request $request, Ataques $ataque){
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
		}else{
			$victima->nombre = $request->victima['nombre'];
			$victima->apellido = $request->victima['apellido'];
			$victima->numero_celular = $request->victima['numero_celular'];
			$victima->sexo = $request->victima['sexo'];
			$victima->direccion_residencia = $request->victima['direccion_residencia'];
			$victima->municipio_residencia_id = $request->victima['municipio_residencia_id'];
			$victima->save();
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
			$duenio_mascota->nombre = $request->propietario['nombre'];
			$duenio_mascota->apellido = $request->propietario['apellido'];
			$duenio_mascota->numero_celular = $request->propietario['numero_celular'];
			$duenio_mascota->sexo = $request->propietario['sexo'];
			$duenio_mascota->direccion_residencia = $request->propietario['direccion_residencia'];
			$duenio_mascota->municipio_residencia_id = $request->propietario['municipio_residencia_id'];
			$duenio_mascota->save();
		}
		$mascota = $request->ataque_animal['mascota_id'];
		if($mascota == null || strpos($mascota, 'Seleccione') !== false){
			$mascota = Mascotas::saveData([
				'nombre' => $request->ataque_animal['nombre_especie'],
				'propietario_id' => $duenio_mascota->id,
				'vacunado' => $request->ataque_animal['animal_vacunado'] == 'S' ? true : false,
				'fecha_nacimiento' => null,
				'fecha_vacunacion' => $request->ataque_animal['fecha_vacunacion'],
				'raza_id' => $request->ataque_animal['raza_id']
			])->id;
		}
		if(!$request->ataque){
			$ataque = Ataques::saveData([
				'victima_id' => $victima->id,
				'mascota_id' => $mascota,
				'fecha_ataque' => $request->ataque['fecha_ataque'],
				'descripcion' => $request->ataque['descripcion'],
				'tipo_ataque_id' => $request->ataque['tipo_ataque_id'],
				'ataque_mordedura' => $request->ataque['tipo_ataque_id'] == '1' ? 'C' : 'D',
				'municipio_ataque_id' => $request->ataque['municipio_ataque_id'],
				'agresion_provocada' => $request->ataque['agresion_provocada'] == '1' ? true : false,
				'tipo_lesion' => $request->ataque['tipo_lesion'],
				'profundidad' => $request->ataque['profundidad']
			]);
		}else{
			$ataque->fecha_ataque = $request->ataque['fecha_ataque'];
			$ataque->descripcion = $request->ataque['descripcion'];
			$ataque->tipo_ataque_id = $request->ataque['tipo_ataque_id'];
			$ataque->ataque_mordedura = $request->ataque['tipo_ataque_id'] == '1' ? 'C' : 'D';
			$ataque->municipio_ataque_id = $request->ataque['municipio_ataque_id'];
			$ataque->agresion_provocada = $request->ataque['agresion_provocada'] == '1' ? true : false;
			$ataque->tipo_lesion = $request->ataque['tipo_lesion'];
			$ataque->profundidad = $request->ataque['profundidad'];
			$ataque->save();
			AtaquesAnatomicas::where('ataque_id', $ataque->id)->delete();
			AtaquesAnimal::where('ataque_id', $ataque->id)->delete();
			AtaquesVictima::where('ataque_id', $ataque->id)->delete();
		}
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
			'lavado_herida' => $request->ataque_victima['lavado_herida'] == '1' ? true : false,
			'sutura_herida' => $request->ataque_victima['sutura_herida'] == '1' ? true : false,
			'orden_suero' => $request->ataque_victima['orden_suero'] == '1' ? true : false,
			'orden_aplicacion_vacuna' => $request->ataque_victima['orden_aplicacion_vacuna'] == '1' ? true : false,
			'razon_social_unidad' => $request->ataque_victima['razon_social_unidad']
		]);
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', 'Se ha registrado el ataque occn éxito.');
		return redirect()->route('detalle_ataque', ['ataque' => $ataque->id]);
	}
	public function detail(Ataques $ataque){
		return view(self::DIR_TEMPLATE.'detail', [
			'ataque' => $ataque
		]);
	}
	public function jsonLocalizacionAnatomica(Request $request){
		$data = [];
		foreach(LocalizacionesAnatomicas::all() as $localizacion_anatomica){
			$data[$localizacion_anatomica->nombre] = AtaquesAnatomicas::where('localizacion_anatomica_id', $localizacion_anatomica->id)->count();
		}
		return response()->json($data);
	}
	public function jsonTipoAtaque(Request $request){
		$data = [];
		foreach(TiposAtaques::all() as $tipo_ataque){
			$data[$tipo_ataque->nombre] = Ataques::where('tipo_ataque_id', $tipo_ataque->id)->count();
		}
		return response()->json($data);
	}
}