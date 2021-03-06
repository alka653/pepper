<?php

namespace App\Http\Controllers;

use App\Mascotas;
use App\Constants;
use App\Documentos;
use App\Revisiones;
use App\Solicitudes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SolicitudesController extends Controller{
	const DIR_TEMPLATE = 'solicitudes.';
	public function list(Request $request){
		$estado = $request->input('estado');
		$solicitudes = new Solicitudes();
		if(Auth::user()->perfil == 'U'){
			$mascotas = Mascotas::listaMascotasByUser(Auth::user()->persona_id);
			$solicitudes = $solicitudes->whereIn('mascota_id', $mascotas);
		}
		if($estado != null && $estado != ''){
			switch($estado){
				case 'R':
					$solicitudes_inspeccionadas = Revisiones::pluck('solicitud_id')->toArray();
					$solicitudes = $solicitudes::whereNotIn('id', $solicitudes_inspeccionadas);	
					break;
				case 'DE':
					$solicitudes_devueltas = [];
					foreach(DB::select(DB::raw('SELECT *, MAX(modo) max FROM revisiones WHERE estado = "N" GROUP BY solicitud_id')) as $data){
						array_push($solicitudes_devueltas, $data->solicitud_id);
					}
					$solicitudes = $solicitudes::whereIn('id', $solicitudes_devueltas);	
					break;
				case 'PE':
					$solicitudes_pendientes = Revisiones::where(['inspector_id' => Auth::user()->id, 'estado' => 'R'])->groupBy('solicitud_id')->pluck('solicitud_id')->toArray();
					$solicitudes = $solicitudes::whereNotIn('id', $solicitudes_pendientes);
					break;
				case 'RE':
					$solicitudes_revisadas = Revisiones::where(['inspector_id' => Auth::user()->id, 'estado' => 'R'])->groupBy('solicitud_id')->pluck('solicitud_id')->toArray();
					$solicitudes = $solicitudes::whereIn('id', $solicitudes_revisadas);
					break;
				case 'PR':
					$solicitudes_proceso = [];
					foreach(DB::select(DB::raw('SELECT *, MAX(modo) max FROM revisiones WHERE inspector_id IS NULL GROUP BY solicitud_id')) as $data){
						array_push($solicitudes_proceso, $data->solicitud_id);
					}
					$solicitudes = $solicitudes::whereIn('id', $solicitudes_proceso);
					break;
				default:
					$solicitudes = $solicitudes->where('estado', $estado);
					break;
			}
		}
		return view(self::DIR_TEMPLATE.'list', [
			'solicitudes' => $solicitudes->paginate(10)
		] + (Auth::user()->perfil != 'U' ? ['solicitudCount' => [
			'finalizados' => Solicitudes::where('estado', 'F')->count(),
			'pendientes' => Solicitudes::where('estado', 'P')->count(),
			'cancelados' => Solicitudes::where('estado', 'C')->count()
		]] : [] ));
	}
	public function detail(Solicitudes $solicitud){
		return view(self::DIR_TEMPLATE.'detail', [
			'revisionModel' => new Revisiones(),
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
		$mascota_solicitud = Solicitudes::where('estado', 'P')->orWhere('estado', 'F')->get()->map(function($solicitud){
			return $solicitud->only(['mascota_id']);
		})->toArray();
		$mascotas = Mascotas::where('propietario_id', Auth::user()->persona_id)->whereNotIn('id', $mascota_solicitud)->get();
		if(count($mascotas) > 0){
			return view(self::DIR_TEMPLATE.'form', [
				'solicitud' => new Solicitudes(),
				'title' => 'Crear nueva solicitud',
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
			if($request->documento != null){
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
	public function json(Request $request){
		$solicitudes = new Solicitudes();
		if($request->fecha_inicio != '' && $request->fecha_final){
			$solicitudes = $solicitudes->whereBetween('fecha_solicitud', [date('Y-m-d', strtotime($request->fecha_inicial)), date('Y-m-d', strtotime($request->fecha_final))]);
		}
		return response()->json([
			'finalizados' => $solicitudes->where('estado', 'F')->count(),
			'pendientes' => $solicitudes->where('estado', 'P')->count(),
			'cancelados' => $solicitudes->where('estado', 'C')->count()
		]);
	}
}