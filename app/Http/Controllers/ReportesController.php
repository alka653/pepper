<?php

namespace App\Http\Controllers;

use App\User;
use App\Razas;
use App\Ataques;
use App\Mascotas;
use App\Personas;
use App\Constants;
use App\Solicitudes;
use App\TiposAtaques;
use App\AtaquesAnatomicas;
use Illuminate\Http\Request;
use App\LocalizacionesAnatomicas;
use Barryvdh\DomPDF\Facade as PDF;

class ReportesController extends Controller{
	const DIR_TEMPLATE = 'reportes.';
	public function request(){
		return view('elements.form_reporte', [
			'title' => 'Informe de solicitudes',
			'forms' => [
				[
					'name' => 'Fecha inicial',
					'field' => 'fecha_inicial',
					'type' => 'text',
					'required' => false,
					'extra_class' => 'date'
				],
				[
					'name' => 'Fecha final',
					'field' => 'fecha_final',
					'type' => 'text',
					'required' => false,
					'extra_class' => 'date'
				],
				[
					'name' => 'Estado de solicitud',
					'field' => 'estado_solicitud',
					'type' => 'select',
					'required' => false,
					'extra_class' => '',
					'options' => [
						'' => 'Todos',
						'P' => 'Radicado',
						'F' => 'Aprobado',
						'C' => 'Rechazado'
					]
				],
				[
					'name' => 'Nombre o númerdo de identificación del propietario',
					'field' => 'propietario',
					'type' => 'text',
					'required' => false,
					'extra_class' => ''
				],
			],
			'route' => route('reporte_solicitud_pdf')
		]);
	}
	public function users(){
		return view('elements.form_reporte', [
			'title' => 'Informe de usuarios',
			'forms' => [
				[
					'name' => 'Nombre o número de identificación del usuario',
					'field' => 'usuario',
					'type' => 'text',
					'required' => false,
					'extra_class' => ''
				],
				[
					'name' => 'Tipo de usuario',
					'field' => 'tipo_usuario',
					'type' => 'select',
					'required' => false,
					'extra_class' => '',
					'options' => [
						'' => 'Todos',
						'P' => 'Propietario',
						'J' => 'Jefe',
						'C' => 'Coordinador',
						'Z' => 'Zootecnico'
					]
				]
			],
			'route' => route('reporte_usuario_pdf')
		]);
	}
	public function pets(){
		return view('elements.form_reporte', [
			'title' => 'Informe de mascotas',
			'forms' => [
				[
					'name' => 'Nombre del propietario',
					'field' => 'propietario',
					'type' => 'text',
					'required' => false,
					'extra_class' => ''
				],
				[
					'name' => 'Ocupación',
					'field' => 'ocupacion',
					'type' => 'select',
					'required' => false,
					'extra_class' => '',
					'options' => Constants::OCUPACIONES_MASCOTA_LISTA
				],
				[
					'name' => 'Fecha de registro',
					'field' => 'fecha_registro',
					'type' => 'text',
					'required' => false,
					'extra_class' => 'date'
				],
				[
					'name' => 'Estado',
					'field' => 'estado',
					'type' => 'select',
					'required' => false,
					'extra_class' => '',
					'options' => [
						'' => 'Todos',
						'V' => 'Vivo',
						'M' => 'Fallecido'
					]
				],
				[
					'name' => 'Raza',
					'field' => 'raza_id',
					'type' => 'select',
					'required' => false,
					'extra_class' => '',
					'options' => Razas::lista()
				]
			],
			'route' => route('reporte_mascota_pdf')
		]);
	}
	public function atacks(){
		return view('elements.form_reporte', [
			'title' => 'Informe de ataques',
			'forms' => [
				[
					'name' => 'Fecha de ataque',
					'field' => 'fecha_registro',
					'type' => 'text',
					'required' => false,
					'extra_class' => ''
				],
				[
					'name' => 'Localización anatómica',
					'field' => 'localizacion_anatomica_id',
					'type' => 'select',
					'required' => false,
					'extra_class' => '',
					'options' => ['' => 'Seleccione una opción'] + LocalizacionesAnatomicas::lista()
				],
				[
					'name' => 'Tipo de agresión',
					'field' => 'tipo_agresion_id',
					'type' => 'select',
					'required' => false,
					'extra_class' => '',
					'options' => TiposAtaques::lista()
				]
			],
			'route' => route('reporte_ataque_pdf')
		]);
	}
	public function requestPDF(Request $request){
		if($request->reporte != null){
			$filename = 'solicitudes-'.date('Y-m-d').'.pdf';
			$solicitudes = Solicitudes::with('mascota');
			if($request->fecha_inicial != '' && $request->fecha_final != ''){
				$solicitudes = $solicitudes->whereBetween('fecha_solicitud', [date('Y-m-d', strtotime($request->fecha_inicial)), date('Y-m-d', strtotime($request->fecha_final))]);
			}
			if($request->estado_solicitud != ''){
				$solicitudes = $solicitudes->where('estado', $request->estado_solicitud);
			}
			if($request->propietario != ''){
				$propietario = $request->propietario;
				$solicitudes = $solicitudes->whereHas('mascota', function($mascota) use ($propietario){
					$propietarios = new Personas();
					if(is_numeric($propietario)){
						$propietarios = $propietarios->whereRaw('numero_documento LIKE ?', ['%'.$propietario.'%']);
					}else{
						$propietarios = $propietarios->whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($propietario).'%'])->orWhereRaw('LOWER(apellido) LIKE ?', ['%'.strtolower(strtolower($propietario)).'%']);
					}
					$mascota->whereIn('propietario_id', $propietarios->get()->pluck('id')->toArray());
				});
			}
			$pdf = PDF::loadView(self::DIR_TEMPLATE.'pdf.solicitud', [
				'logo' => Constants::ESCUCUDO_B64,
				'escudo' => Constants::ESCUDO_GIRARDOT_B64,
				'title' => $filename,
				'solicitudes' => $solicitudes->get()
			])->setPaper('Letter', 'landscape');
			$pdf->save(storage_path().'/app/public/pdf/'.$filename);
			return response()->file('storage/pdf/'.$filename);
		}
		return redirect()->route('reporte_solicitud');
	}
	public function usersPDF(Request $request){
		if($request->reporte != null){
			$filename = 'usuarios-'.date('Y-m-d').'.pdf';
			$usuarios = User::with('persona');
			if($request->tipo_usuario != ''){
				$usuarios = $usuarios->where('perfil', $request->tipo_usuario);
			}
			if($request->usuario != ''){
				$dato_usuario = $request->usuario;
				$usuarios = $usuarios->whereHas('persona', function($usuario) use ($dato_usuario){
					$personas = new Personas();
					if(is_numeric($dato_usuario)){
						$personas = $personas->whereRaw('numero_documento LIKE ?', ['%'.$dato_usuario.'%']);
					}else{
						$personas = $personas->whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($dato_usuario).'%'])->orWhereRaw('LOWER(apellido) LIKE ?', ['%'.strtolower(strtolower($dato_usuario)).'%']);
					}
					$usuario->whereIn('persona_id', $personas->get()->pluck('id')->toArray());
				});
			}
			$pdf = PDF::loadView(self::DIR_TEMPLATE.'pdf.usuario', [
				'logo' => Constants::ESCUCUDO_B64,
				'escudo' => Constants::ESCUDO_GIRARDOT_B64,
				'title' => $filename,
				'usuarios' => $usuarios->get()
			])->setPaper('Letter', 'landscape');
			$pdf->save(storage_path().'/app/public/pdf/'.$filename);
			return response()->file('storage/pdf/'.$filename);
		}
		return redirect()->route('reporte_usuario');
	}
	public function petsPDF(Request $request){
		if($request->reporte != null){
			$filename = 'mascotas-'.date('Y-m-d').'.pdf';
			$mascotas = Mascotas::with('propietario', 'raza');
			if($request->ocupacion != ''){
				$mascotas = $mascotas->whereRaw('LOWER(ocupacion) LIKE ?', ['%'.strtolower($request->tipo_usuario).'%']);
			}
			if($request->fecha_registro != null){
				$mascotas = $mascotas->where('fecha_ingreso', $request->fecha_registro);
			}
			if($request->estado != null){
				$mascotas = $mascotas->where('estado', $request->estado);
			}
			if($request->raza_id != null){
				$mascotas = $mascotas->where('raza_id', $request->raza_id);
			}
			if($request->propietario != null){
				$dato_propietario = $request->propietario;
				$mascotas = $mascotas->whereHas('propietario', function($propietario) use ($dato_propietario){
					$personas = new Personas();
					if(is_numeric($dato_propietario)){
						$personas = $personas->whereRaw('numero_documento LIKE ?', ['%'.$dato_propietario.'%']);
					}else{
						$personas = $personas->whereRaw('LOWER(nombre) LIKE ?', ['%'.strtolower($dato_propietario).'%'])->orWhereRaw('LOWER(apellido) LIKE ?', ['%'.strtolower(strtolower($dato_propietario)).'%']);
					}
					$propietario->whereIn('propietario_id', $personas->get()->pluck('id')->toArray());
				});
			}
			$pdf = PDF::loadView(self::DIR_TEMPLATE.'pdf.mascota', [
				'logo' => Constants::ESCUCUDO_B64,
				'escudo' => Constants::ESCUDO_GIRARDOT_B64,
				'title' => $filename,
				'mascotas' => $mascotas->get()
			])->setPaper('Letter', 'landscape');
			$pdf->save(storage_path().'/app/public/pdf/'.$filename);
			return response()->file('storage/pdf/'.$filename);
		}
		return redirect()->route('reporte_mascota');
	}
	public function atacksPDF(Request $request){
		if($request->reporte != null){
			$filename = 'ataques-'.date('Y-m-d').'.pdf';
			$ataques = Ataques::with('victima', 'mascota', 'tipoAgresion');
			if($request->fecha_registro != ''){
				$ataques = $ataques->where('fecha_ataque', $request->fecha_registro);
			}
			if($request->tipo_ataque_id != ''){
				$ataques = $ataques->where('tipo_ataque_id', $request->tipo_ataque_id);
			}
			if($request->localizacion_anatomica_id != ''){
				$ataquesLocalizacionesAnatomicas = AtaquesAnatomicas::where('localizacion_anatomica_id', $request->localizacion_anatomica_id)->get()->pluck('ataque_id')->toArray();
				$ataques->whereId('id', $ataquesLocalizacionesAnatomicas);
			}
			$pdf = PDF::loadView(self::DIR_TEMPLATE.'pdf.ataque', [
				'logo' => Constants::ESCUCUDO_B64,
				'escudo' => Constants::ESCUDO_GIRARDOT_B64,
				'title' => $filename,
				'ataques' => $ataques->get()
			])->setPaper('Letter', 'landscape');
			$pdf->save(storage_path().'/app/public/pdf/'.$filename);
			return response()->file('storage/pdf/'.$filename);
		}
		return redirect()->route('reporte_ataque');
	}
}