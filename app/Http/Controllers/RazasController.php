<?php

namespace App\Http\Controllers;

use App\Razas;
use Illuminate\Http\Request;
use App\Http\Requests\RazaFormRequest;

class RazasController extends Controller{
	const DIR_TEMPLATE = 'razas.';
	public function listWithOutAuth(Request $request){
		return view(self::DIR_TEMPLATE.'list_without_auth', [
			'razas' => [
				(object) [
					'nombre' => 'Dogo Argentido'
				],
				(object) [
					'nombre' => 'Dogo de Burdeos'
				],
				(object) [
					'nombre' => 'Akita Inu'
				],
				(object) [
					'nombre' => 'Mastín Napolitano'
				],
				(object) [
					'nombre' => 'Dóberman'
				],
				(object) [
					'nombre' => 'Bull Terrier'
				],
				(object) [
					'nombre' => 'Rottweiler'
				],
				(object) [
					'nombre' => 'Pitbull Terrier'
				],
				(object) [
					'nombre' => 'Presa Canario'
				],
				(object) [
					'nombre' => 'American Staffordshire Terrier'
				],
				(object) [
					'nombre' => 'Bullmastiff'
				],
				(object) [
					'nombre' => 'Fila Brasileiro'
				],
				(object) [
					'nombre' => 'American Pitbull Terrier'
				],
				(object) [
					'nombre' => 'Staffordshire Terrier'
				],
				(object) [
					'nombre' => 'Tosa Japonés'
				]
			]
		]);
	}
	public function listWithAuth(Request $request){
		$query = $request->input('query');
		$razas = $query != null && $query != '' ? Razas::whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($query).'%']) : new Razas();
		return view(self::DIR_TEMPLATE.'list_with_auth', [
			'query' => $query,
			'url' => route('listar_razas_with_auth'),
			'placeholder' => 'Busca una raza',
			'razas' => $razas->paginate(10)
		]);
	}
	public function new(){
		return view(self::DIR_TEMPLATE.'form', [
			'raza' => new Razas(),
			'title' => 'Agregar una raza',
			'route' => ['crear_raza.post'],
			'method' => 'post'
		]);
	}
	public function edit(Razas $raza){
		return view(self::DIR_TEMPLATE.'form', [
			'raza' => $raza,
			'title' => 'Edita la información de la raza',
			'route' => ['editar_raza.post', $raza->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData(Request $razaRequest){
		$message = '';
		if($razaRequest->raza){
			Razas::updateData($razaRequest);
			$message = 'Raza actualizada con éxito';
		}else{
			Razas::saveData([
				'nombre' => $razaRequest->nombre,
				'especie' => $razaRequest->especie
			]);
			$message = 'Raza guardada con éxito';
		}
		$razaRequest->session()->flash('message.level', 'success');
		$razaRequest->session()->flash('message.content', $message);
		return redirect()->route('listar_razas_with_auth');
	}
	public function delete(Razas $raza){
		return view('elements.delete_form', [
			'object' => $raza,
			'title' => 'Eliminar raza',
			'message' => "¿Desea eliminar la raza {$raza->nombre}?",
			'route' => ['eliminar_raza.delete', $raza->id]
		]);
	}
	public function deleteData(Razas $raza, Request $request){
		$message = '';
		if($raza->mascotas->count() > 0){
			$message = 'No se puede eliminar la raza por que se encuentra asociada';
		}else{
			$raza->delete();
			$message = 'Raza eliminada con éxito';
		}
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', $message);
		return redirect()->route('listar_razas_with_auth');
	}
}