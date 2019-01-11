<?php

namespace App\Http\Controllers;

use App\Razas;
use App\Mascotas;
use App\Personas;
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
		$mascotas = new Mascotas();
		$query = $request->input('query');
		$estado = $request->input('estado');
		$raza_id = $request->input('raza_id');
		$color = $request->input('color');
		$sexo = $request->input('sexo');

		if($query != null){
			$mascotas = $mascotas->whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($query).'%']);
		}
		if($estado != null){
			$mascotas = $mascotas->where('estado', $estado);
		}
		if($raza_id != null){
			$mascotas = $mascotas->where('raza_id', $raza_id);
		}
		if($sexo != null){
			$mascotas = $mascotas->where('sexo', $sexo);
		}
		if($color != null){
			$mascotas = $mascotas->whereRaw('LOWER(color) LIKE ?', ['%'.strtolower($color).'%']);
		}
		return view(self::DIR_TEMPLATE.'list', [
			'query' => $query,
			'extraQuery' => [
				'estado' => $estado,
				'raza_id' => $raza_id,
				'color' => $color,
				'sexo' => $sexo
			],
			'url' => route('listar_mascota'),
			'razas' => Razas::lista('Por raza'),
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
			'razas' => Razas::lista(),
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
			'propietarios' => ['' => 'Selecciona un propietario'] + Personas::get()->mapWithKeys(function($persona){
				return [$persona['id'] => $persona['nombre'].' '.$persona['apellido']];
			})->toArray(),
			'route' => ['editar_mascota.post', $mascota->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData(MascotaFormRequest $mascotaRequest, Mascotas $mascota){
		$mascota = null;
		$message = '';
		if($mascotaRequest->mascota){
			$mascota = Mascotas::updateData($mascotaRequest);
			$mascotasFotos = MascotasFotos::where('mascota_id', $mascotaRequest->mascota)->get();
			if($mascotaRequest->foto != null){
				foreach($mascotaRequest->foto as $key => $foto){
					$foto = $foto->store('mascotas');
					if(isset($mascotasFotos[$key])){
						$mascotasFotos[$key]->fecha = date('Y-m-d');
						$mascotasFotos[$key]->foto = $foto;
						$mascotasFotos[$key]->save();
					}else{
						MascotasFotos::saveData([
							'foto' => $foto,
							'mascota_id' => $mascota->id
						]);
					}
				}
			}
			$message = 'Los datos de tu mascota se han actualizado con éxito.';
		}else{
			$mascota = Mascotas::saveData([
				'nombre' => $mascotaRequest->nombre,
				'propietario_id' => Auth::user()->persona->id,
				'fecha_nacimiento' => $mascotaRequest->fecha_nacimiento,
				'sexo' => $mascotaRequest->sexo,
				'color' => $mascotaRequest->color,
				'descripcion' => $mascotaRequest->descripcion,
				'estado' => 'V',
				'vacunado' => $mascotaRequest->vacunado,
				'fecha_vacunacion' => $mascotaRequest->fecha_vacunacion,
				'raza_id' => $mascotaRequest->raza_id
			]);
			foreach($mascotaRequest->foto as $foto){
				$pathFoto = $foto->store('mascotas');
				MascotasFotos::saveData([
					'foto' => $pathFoto,
					'mascota_id' => $mascota->id
				]);
			}
			$message = 'Se ha registrado tu mascota con éxito.';
		}
		$mascotaRequest->session()->flash('message.level', 'success');
		$mascotaRequest->session()->flash('message.content', $message);
		return redirect()->route('detalle_mascota', ['mascota' => $mascota->id]);
	}
}