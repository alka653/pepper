<?php

namespace App\Http\Controllers;

use App\Revisiones;
use App\Solicitudes;
use App\Certificados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisionesController extends Controller{
	public function save(Solicitudes $solicitud, Request $request){
		$modo = '';
		switch(Auth::user()->perfil){
			case 'Z':
				$modo = 1;
				break;
			case 'C':
				$modo = 2;
				break;
			case 'J':
				$modo = 3;
				break;
		}
		$revision = Revisiones::where(['solicitud_id' => $solicitud->id, 'observacion' => null])->first();
		if(!$revision){
			Revisiones::saveData([
				'fecha' => date('Y-m-d'),
				'solicitud_id' => $solicitud->id,
				'inspector_id' => Auth::user()->id,
				'observacion' => $request->observacion,
				'estado' => $request->remitir == 'S' ? 'R' : ($request->certificado == 'S' ? 'R' : 'N'),
				'modo' => $modo
			]);
		}else{
			$revision->inspector_id = Auth::user()->id;
			$revision->estado = $request->remitir == 'S' ? 'R' : 'N';
			$revision->observacion = $request->observacion;
			$revision->save();
		}
		if($modo < 3 && $request->remitir == 'S'){
			Revisiones::saveData([
				'fecha' => date('Y-m-d'),
				'solicitud_id' => $solicitud->id,
				'estado' => 'P',
				'modo' => $modo + 1
			]);
		}
		if($request->certificado == 'S'){
			$solicitud->fecha_finalizado = date('Y-m-d');
			$solicitud->estado = 'F';
			$solicitud->save();
			Certificados::saveData([
				'mascota_id' => $solicitud->mascota_id
			]);
		}
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', 'Se ha realizado la revisión.');
		return redirect()->route('detalle_solicitud', ['solicitud' => $solicitud->id]);
	}
}