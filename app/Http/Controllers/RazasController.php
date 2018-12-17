<?php

namespace App\Http\Controllers;

use App\Razas;
use Illuminate\Http\Request;
use App\Http\Requests\RazaFormRequest;

class RazasController extends Controller{
	const DIR_TEMPLATE = 'razas.';
	public function list(Request $request){
		$query = $request->input('query');
		$razas = $query != null && $query != '' ? Razas::where('nombre', 'LIKE', "%$query%") : new Razas();
		return view(self::DIR_TEMPLATE.'list', [
			'query' => $query,
			'url' => route('listar_razas'),
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
	public function saveOrUpdateData(RazaFormRequest $razaRequest){
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
		return response()->json([
			'message' => $message
		]);
		return redirect()->route('listar_razas');
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
		return redirect()->route('listar_razas');
	}
}