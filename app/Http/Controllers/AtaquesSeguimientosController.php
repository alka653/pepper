<?php

namespace App\Http\Controllers;

use App\Ataques;
use App\AtaquesSeguimientos;
use Illuminate\Http\Request;
use App\Http\Requests\SeguimientosFormRequest;

class AtaquesSeguimientosController extends Controller{
	const DIR_TEMPLATE = 'ataques_seguimientos.';
	public function list(Ataques $ataque){
		return view(self::DIR_TEMPLATE.'list', [
			'ataque' => $ataque
		]);
	}
	public function new(Ataques $ataque){
		return view(self::DIR_TEMPLATE.'form', [
			'ataque_seguimiento' => new AtaquesSeguimientos(),
			'title' => 'Realiza un seguimiento',
			'route' => ['crear_seguimiento_ataque.post', $ataque->id],
			'method' => 'post'
		]);
	}
	public function edit($ataque, AtaquesSeguimientos $seguimiento){
		return view(self::DIR_TEMPLATE.'form', [
			'ataque_seguimiento' => $seguimiento,
			'title' => 'Edita la información del seguimiento',
			'route' => ['editar_seguimiento_ataque.post', $ataque, $seguimiento->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData($ataque, SeguimientosFormRequest $request){
		$message = '';
		if($request->seguimiento){
			AtaquesSeguimientos::updateData($request);
			$message = 'Seguimiento realizado con éxito';
		}else{
			AtaquesSeguimientos::saveData([
				'fecha' => $request->fecha,
				'descripcion' => $request->descripcion,
				'tipo' => $request->tipo,
				'ataque_id' => $ataque
			]);
			$message = 'Seguimiento actualizado con éxito';
		}
		return response()->json([
			'message' => $message
		]);
	}
	public function delete($ataque, AtaquesSeguimientos $seguimiento){
		return view('elements.delete_form', [
			'object' => $seguimiento,
			'title' => 'Eliminar seguimiento',
			'message' => "¿Desea eliminar el ítem seleccionado?",
			'route' => ['eliminar_seguimiento_ataque.delete', $ataque, $seguimiento->id]
		]);
	}
	public function deleteData($ataque, AtaquesSeguimientos $seguimiento, Request $request){
		$seguimiento->delete();
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', 'Seguimiento eliminado con éxito');
		return redirect()->route('seguimiento_ataque', ['ataque' => $ataque]);
	}
}