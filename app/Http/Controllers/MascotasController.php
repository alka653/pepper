<?php

namespace App\Http\Controllers;

use App\Razas;
use App\Mascotas;
use App\Personas;
use App\Constants;
use App\Certificados;
use App\MascotasFotos;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
		$ocupacion = $request->input('ocupacion');
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
		if($ocupacion != null){
            if($ocupacion != 'Otro'){
                $mascotas = $mascotas->whereRaw('LOWER(ocupacion) LIKE ?', ['%'.strtolower($ocupacion).'%']);
            }else{
                $mascotas = $mascotas->whereNotIn('ocupacion', Constants::OCUPACIONES_MASCOTA_LISTA);
            }
		}
        return view(self::DIR_TEMPLATE.'list', [
			'query' => $query,
			'extraQuery' => [
				'estado' => $estado,
				'raza_id' => $raza_id,
				'ocupacion' => $ocupacion,
				'sexo' => $sexo
			],
			'url' => route('listar_mascota'),
            'razas' => Razas::lista('Por raza'),
            'ocupaciones' => Constants::OCUPACIONES_MASCOTA_LISTA,
			'placeholder' => 'Buscar una mascota',
			'mascotas' => Auth::user()->perfil == 'U' ? $mascotas->where('propietario_id', Auth::user()->persona->id)->paginate(10) : $mascotas->paginate(10)
		] + (Auth::user()->perfil != 'U' ? ['mascotaCount' => [
			'macho' => Mascotas::where('sexo', 'M')->count(),
			'hembra' => Mascotas::where('sexo', 'F')->count()
		]] : []));
	}
	public function detail(Mascotas $mascota){
		return view(self::DIR_TEMPLATE.'detail', [
			'mascota' => $mascota
		]);
	}
	public function new(){
		return view(self::DIR_TEMPLATE.'form', [
			'mascota' => new Mascotas(),
			'ocupacionesMascota' => Constants::OCUPACIONES_MASCOTA_LISTA,
			'title' => 'Registrar una mascota',
			'razas' => Razas::lista(),
			'propietarios' => ['' => 'Selecciona un propietario'] + Personas::get()->mapWithKeys(function($persona){
				return [$persona['id'] => $persona['nombre'].' '.$persona['apellido']];
			})->toArray(),
			'route' => ['crear_mascota.post'],
			'method' => 'post'
		]);
	}
	public function edit(Mascotas $mascota){
		return view(self::DIR_TEMPLATE.'form', [
			'mascota' => $mascota,
			'ocupacionesMascota' => Constants::OCUPACIONES_MASCOTA_LISTA,
			'title' => 'Edita la información de la mascota',
			'razas' => ['' => 'Seleccione una raza'] + Razas::lista(),
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
		if($mascotaRequest->color == 'Mixto'){
			$mascotaRequest->color = $mascotaRequest->color_otro;
		}
		if($mascotaRequest->ocupacion == 'Otro'){
			$mascotaRequest->ocupacion = $mascotaRequest->ocupacion_otro;
		}
		if($mascotaRequest->mascota){
			$mascota = Mascotas::updateData($mascotaRequest);
			$mascotasFotos = MascotasFotos::where('mascota_id', $mascota->id)->get();
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
				'raza_id' => $mascotaRequest->raza_id,
				'ocupacion' => $mascotaRequest->ocupacion
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
	public function listCertificado(){
		$mascotas = Mascotas::where('propietario_id', Auth::user()->persona->id)->get()->pluck('id');
		return view(self::DIR_TEMPLATE.'list_certificado', [
			'certificados' => Certificados::whereIn('mascota_id', $mascotas)->paginate(10)
		]);
	}
	public function certificadoMascota(Mascotas $mascota, Certificados $certificado){
		$filename = 'certificado-'.$mascota->nombre.'.pdf';
		$pdf = PDF::loadView(self::DIR_TEMPLATE.'pdf.certificado', [
			'title' => $filename,
			'mascota' => $mascota,
			'escudoFondo' => Constants::ESCUDO_FONDO_B64,
			'foto_canino' => 'data:image/png;base64,'.base64_encode(file_get_contents('storage/'.$mascota->fotos[0]->foto)),
			'certificado' => $certificado
		]);
		$pdf->save(storage_path().'/app/public/pdf/'.$filename);
		//return $pdf->download($filename);
		return response()->file('storage/pdf/'.$filename);
	}
	public function json(Request $request){
		$mascotas = new Mascotas();
		if($request->fecha_inicio != '' && $request->fecha_final != ''){
			$mascotas = $mascotas->whereBetween('fecha_ingreso', [date('Y-m-d', strtotime($request->fecha_inicial)), date('Y-m-d', strtotime($request->fecha_final))]);
		}
		return response()->json([
			'machos' => $mascotas->where('sexo', 'M')->count(),
			'hembras' => $mascotas->where('sexo', 'F')->count()
		]);
	}
	public function jsonOcupacion(Request $request){
		$data = [];
		$mascotas = new Mascotas();
		$lista_ocupaciones = Constants::OCUPACIONES_MASCOTA_LISTA;
		unset($lista_ocupaciones[''], $lista_ocupaciones['Otro']);
		if($request->fecha_inicio != '' && $request->fecha_final != ''){
			$mascotas = $mascotas->whereBetween('fecha_ingreso', [date('Y-m-d', strtotime($request->fecha_inicial)), date('Y-m-d', strtotime($request->fecha_final))]);
		}
		foreach($lista_ocupaciones as $key => $ocupacion){
			$data[$ocupacion] = $mascotas->where('ocupacion', $ocupacion)->count();
		}
		$data['Otro'] = $mascotas->whereNotIn('ocupacion', $lista_ocupaciones)->count();
		return response()->json($data);
	}
}
