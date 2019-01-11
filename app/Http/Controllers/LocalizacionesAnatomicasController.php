<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LocalizacionesAnatomicas;
use App\Http\Requests\LocalizacionAnatomicaFormRequest;

class LocalizacionesAnatomicasController extends Controller{
	const DIR_TEMPLATE = 'localizaciones_anatomicas.';
	public function list(Request $request){
		$query = $request->input('query');
		$localizaciones_anatomicas = $query != null && $query != '' ? LocalizacionesAnatomicas::whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($query).'%']) : new LocalizacionesAnatomicas();
		return view(self::DIR_TEMPLATE.'list', [
			'query' => $query,
			'url' => route('listar_localizaciones_anatomicas'),
			'placeholder' => 'Busca un ítem',
			'localizaciones_anatomicas' => $localizaciones_anatomicas->paginate(10)
		]);
	}
	public function new(){
		return view(self::DIR_TEMPLATE.'form', [
			'localizacion_anatomica' => new LocalizacionesAnatomicas(),
			'title' => 'Agregar una localización anatómica',
			'route' => ['crear_localizacion_anatomica.post'],
			'method' => 'post'
		]);
	}
	public function edit(LocalizacionesAnatomicas $localizacion_anatomica){
		return view(self::DIR_TEMPLATE.'form', [
			'localizacion_anatomica' => $localizacion_anatomica,
			'title' => 'Edita la información de la localización anatómica',
			'route' => ['editar_localizacion_anatomica.post', $localizacion_anatomica->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData(LocalizacionAnatomicaFormRequest $localizaciónAnatomicaRequest){
		$message = '';
		if($localizaciónAnatomicaRequest->localizacion_anatomica){
			LocalizacionesAnatomicas::updateData($localizaciónAnatomicaRequest);
			$message = 'Localización anatómica actualizada con éxito';
		}else{
			LocalizacionesAnatomicas::saveData([
				'nombre' => $localizaciónAnatomicaRequest->nombre
			]);
			$message = 'Localización anatómicca guardada con éxito';
		}
		return response()->json([
			'message' => $message
		]);
	}
	public function delete(LocalizacionesAnatomicas $localizacion_anatomica){
		return view('elements.delete_form', [
			'object' => $localizacion_anatomica,
			'title' => 'Eliminar localización anatómica',
			'message' => "¿Desea eliminar {$localizacion_anatomica->nombre}?",
			'route' => ['eliminar_localizacion_anatomica.delete', $localizacion_anatomica->id]
		]);
	}
	public function deleteData(LocalizacionesAnatomicas $localizacion_anatomica, Request $request){
		$message = '';
		if($localizacion_anatomica->ataques->count() > 0){
			$message = 'No se puede eliminar por que se encuentra asociada';
		}else{
			$localizacion_anatomica->delete();
			$message = 'Localización anatómia eliminado con éxito';
		}
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', $message);
		return redirect()->route('listar_localizaciones_anatomicas');
	}
}