<?php

namespace App\Http\Controllers;

use App\TiposAtaques;
use Illuminate\Http\Request;
use App\Http\Requests\TipoAtaqueFormRequest;

class TiposAtaquesController extends Controller{
	const DIR_TEMPLATE = 'tipos_ataques.';
	public function list(Request $request){
		$query = $request->input('query');
		$tipos_ataques = $query != null && $query != '' ? TiposAtaques::whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($query).'%']) : new TiposAtaques();
		return view(self::DIR_TEMPLATE.'list', [
			'query' => $query,
			'url' => route('listar_tipos_ataques'),
			'placeholder' => 'Busca un ítem',
			'tipos_ataques' => $tipos_ataques->paginate(10)
		]);
	}
	public function new(){
		return view(self::DIR_TEMPLATE.'form', [
			'tipo_ataque' => new TiposAtaques(),
			'title' => 'Agregar un tipo de ataque',
			'route' => ['crear_tipo_ataque.post'],
			'method' => 'post'
		]);
	}
	public function edit(TiposAtaques $tipoAtaque){
		return view(self::DIR_TEMPLATE.'form', [
			'tipo_ataque' => $tipoAtaque,
			'title' => 'Edita la información del tipo de ataque',
			'route' => ['editar_tipo_ataque.post', $tipoAtaque->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData(TipoAtaqueFormRequest $tipoAtaqueRequest){
		$message = '';
		if($tipoAtaqueRequest->tipo_ataque){
			TiposAtaques::updateData($tipoAtaqueRequest);
			$message = 'Tipo de ataque actualizada con éxito';
		}else{
			TiposAtaques::saveData([
				'nombre' => $tipoAtaqueRequest->nombre
			]);
			$message = 'Tipo de ataque guardada con éxito';
		}
		return response()->json([
			'message' => $message
		]);
		//return redirect()->route('listar_tipos_ataques');
	}
	public function delete(TiposAtaques $tipoAtaque){
		return view('elements.delete_form', [
			'object' => $tipoAtaque,
			'title' => 'Eliminar tipo de ataque',
			'message' => "¿Desea eliminar el tipo de ataque {$tipoAtaque->nombre}?",
			'route' => ['eliminar_tipo_ataque.delete', $tipoAtaque->id]
		]);
	}
	public function deleteData(TiposAtaques $tipoAtaque, Request $request){
		$message = '';
		if($tipoAtaque->ataques->count() > 0){
			$message = 'No se puede eliminar el tipo de ataque por que se encuentra asociada';
		}else{
			$tipoAtaque->delete();
			$message = 'Tipo de ataque eliminado con éxito';
		}
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', $message);
		return redirect()->route('listar_tipos_ataques');
	}
}