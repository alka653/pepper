<?php

namespace App\Http\Controllers;

use App\Mascotas;
use App\Constants;
use App\Documentos;
use App\Revisiones;
use App\Solicitudes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudesController extends Controller{
	const DIR_TEMPLATE = 'solicitudes.';
	public function list(){
		$solicitudes = new Solicitudes();
		if(Auth::user()->perfil == 'U'){
			$mascotas = Mascotas::listaMascotasByUser(Auth::user()->persona_id);
			$solicitudes = $solicitudes->whereIn('mascota_id', $mascotas);
		}
		return view(self::DIR_TEMPLATE.'list', [
			'solicitudes' => $solicitudes->paginate(10)
		]);
	}
	public function detail(Solicitudes $solicitud){
		return view(self::DIR_TEMPLATE.'detail', [
			'solicitud' => $solicitud
		]);
	}
	public function new(Request $request){
		$mascota_id = $request->input('mascota');
		if($mascota_id){
			$solicitud = Solicitudes::where(['mascota_id' => $mascota_id, 'estado' => 'P'])->first();
			if($solicitud){
				$request->session()->flash('message.level', 'warning');
				$request->session()->flash('message.content', 'La mascota ya tiene una solicitud en proceso.');
				return redirect()->route('detalle_solicitud', ['solicitud' => $solicitud->id]);
			}
		}
		$mascota_solicitud = Solicitudes::where('estado', 'P')->get()->map(function($solicitud){
			return $solicitud->only(['mascota_id']);
		})->toArray();
		$mascotas = Mascotas::where('propietario_id', Auth::user()->persona_id)->whereNotIn('id', $mascota_solicitud)->get();
		if(count($mascotas) > 0){
			return view(self::DIR_TEMPLATE.'form', [
				'solicitud' => new Solicitudes(),
				'title' => 'Haz una solicitud para el certificado de tu mascota',
				'mascotas' => $mascotas,
				'route' => ['crear_solicitud.post'],
				'method' => 'post'
			]);
		}else{
			$request->session()->flash('message.level', 'warning');
			$request->session()->flash('message.content', 'No tienes mascotas en lista para realizar la solicitud.');
			return redirect()->route('listar_solicitudes');
		}
	}
	public function edit(Solicitudes $solicitud){
		return view(self::DIR_TEMPLATE.'form', [
			'solicitud' => $solicitud,
			'title' => 'Actualiza los documentos requeridos para la solicitud de certificado',
			'mascotas' => null,
			'route' => ['editar_solicitud.post', $solicitud->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData(Request $request){
		$message = '';
		$solicitud = null;
		if($request->solicitud){
			$solicitud = $request->solicitud;
			$solicitudesDocumentos = Documentos::where('solicitud_id', $request->solicitud)->get();
			foreach($request->documento as $key => $documento){
				$documento = $documento->store('mascotas');
				if(isset($solicitudesDocumentos[$key])){
					$solicitudesDocumentos[$key]->documento = $documento;
					$solicitudesDocumentos[$key]->tipo = Constants::TIPO_DOCUMENTO_LISTA[$key];
					$solicitudesDocumentos[$key]->save();
				}else{
					Documentos::saveData([
						'documento' => $documento,
						'solicitud_id' => $request->solicitud,
						'tipo' => Constants::TIPO_DOCUMENTO_LISTA[$key]
					]);
				}
			}
			$message = 'Solicitud actualizado con éxito.';
		}else{
			$solicitud = Solicitudes::saveData([
				'mascota_id' => $request->mascota_id
			])->id;
			foreach($request->documento as $key => $documento){
				$documento = $documento->store('documento');
				Documentos::saveData([
					'documento' => $documento,
					'solicitud_id' => $solicitud,
					'tipo' => Constants::TIPO_DOCUMENTO_LISTA[$key]
				]);
			}
			$message = 'Solicitud realizada con éxito. En los próximos días se estará en proceso de revisión.';
		}
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', $message);
		return redirect()->route('detalle_solicitud', ['solicitud' => $solicitud]);
	}
}