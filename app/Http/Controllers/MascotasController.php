<?php

namespace App\Http\Controllers;

use App\Razas;
use App\Mascotas;
use App\MascotasFotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MascotaFormRequest;

class MascotasController extends Controller{
	const DIR_TEMPLATE = 'mascotas.';
	public function verifyCountPets(){
		return response()->json([
			'count_pet' => Mascotas::where('propietario_id', Auth::user()->persona->id)->count()
		]);
	}
	public function list(Request $request){
		$query = $request->input('query');
		$mascotas = $query != null && $query != '' ? Mascotas::where('nombre', 'LIKE', "%$query%") : new Mascotas();
		return view(self::DIR_TEMPLATE.'list', [
			'query' => $query,
			'url' => route('listar_mascota'),
			'placeholder' => 'Busca una mascota',
			'mascotas' => Auth::user()->perfil == 'U' ? $mascotas->where('propietario_id', Auth::user()->persona->id)->paginate(10) : $mascotas->paginate(10)
		]);
	}
	public function detail(Mascotas $mascota){
		return view(self::DIR_TEMPLATE.'detail', [
			'mascota' => $mascota
		]);
	}
	public function new(){
		return view(self::DIR_TEMPLATE.'form', [
			'mascota' => new Mascotas(),
			'title' => 'Registra tu mascota',
			'razas' => ['' => 'Seleccione una raza'] + Razas::get()->mapWithKeys(function($raza){
				return [$raza['id'] => $raza['nombre']];
			})->toArray(),
			'route' => ['crear_mascota.post'],
			'method' => 'post'
		]);
	}
	public function edit(Mascotas $mascota){
		return view(self::DIR_TEMPLATE.'form', [
			'mascota' => $mascota,
			'title' => 'Edita la información de tu mascota',
			'razas' => ['' => 'Seleccione una raza'] + Razas::get()->mapWithKeys(function($raza){
				return [$raza['id'] => $raza['nombre']];
			})->toArray(),
			'route' => ['editar_mascota.post', $mascota->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData(MascotaFormRequest $mascotaRequest){
		$mascota = null;
		if($mascotaRequest->mascota){
			$mascota = Mascotas::updateData($mascotaRequest);
			$mascotasFotos = MascotasFotos::where('mascota_id', $mascotaRequest->mascota)->get();
			foreach($mascotaRequest->foto as $key => $foto) {
				$mascotasFotos[$key]->fecha = date('Y-m-d');
				$mascotasFotos[$key]->foto = $foto->store('mascotas');
				$mascotasFotos[$key]->save();
			}
		}else{
			$mascota = Mascotas::saveData([
				'nombre' => $mascotaRequest->nombre,
				'propietario_id' => Auth::user()->persona->id,
				'fecha_nacimiento' => date('Y-m-d', strtotime($mascotaRequest->fecha_nacimiento)),
				'sexo' => $mascotaRequest->sexo,
				'color' => $mascotaRequest->color,
				'descripcion' => $mascotaRequest->descripcion,
				'estado' => 'V',
				'vacunado' => $mascotaRequest->vacunado,
				'fecha_vacunacion' => date('Y-m-d', strtotime($mascotaRequest->fecha_vacunacion)),
				'raza_id' => $mascotaRequest->raza_id
			]);
			foreach($mascotaRequest->foto as $foto){
				$pathFoto = $foto->store('mascotas');
				MascotasFotos::saveData([
					'foto' => $pathFoto,
					'mascota_id' => $mascota->id
				]);
			}
		}
		return redirect()->route('detalle_mascota', ['mascota' => $mascota->id]);
	}
}