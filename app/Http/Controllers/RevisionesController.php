<?php

namespace App\Http\Controllers;

use App\User;
use App\Revisiones;
use App\Solicitudes;
use App\Certificados;
use App\Mail\RevisionEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisionesController extends Controller{
	const DIR_TEMPLATE = 'revisiones.';
	public function edit(Solicitudes $solicitud, Revisiones $revision){
		return view(self::DIR_TEMPLATE.'form_modal', [
			'revision' => $revision,
			'title' => 'Editar la revisión',
			'route' => ['editar_revision.post', $solicitud->id, $revision->id],
			'method' => 'put'
		]);
	}
	public function saveOrUpdateData(Solicitudes $solicitud, Request $request){
		$modo = '';
		$message = '';
		if(!$request->revision){
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
			if($request->remitir == 'N'){
				$message = 'Su solicitud No. '.$revision->id.' de su mascota '.$revision->solicitud->mascota->nombre.' ha sido rechazada. Por favor ingrese a nuestro sitio web con sus credenciales y gestione nuevamente su solicitud de acuerdo a la observación indicada por el funcionario, recuerde que cuenta con 8 días hábiles para corregir lo solicitudo de lo contrario si excede el plazo deberá iniciar nuevamente con el proceso.';
			}
			if($modo < 3 && $request->remitir == 'S'){
				Revisiones::saveData([
					'fecha' => date('Y-m-d'),
					'solicitud_id' => $solicitud->id,
					'estado' => 'P',
					'modo' => $modo + 1
				]);
				$message = 'La solicitud ha sido remitida al siguiente nivel.';
			}
			if($request->certificado == 'S'){
				$solicitud->fecha_finalizado = date('Y-m-d');
				$solicitud->estado = 'F';
				$solicitud->save();
				Certificados::saveData([
					'mascota_id' => $solicitud->mascota_id
				]);
				$message = 'Su solicitud No. '.$revision->id.' de su mascota '.$revision->solicitud->mascota->nombre.' ha sido aprobada. Ya puede descargar el certificado.';
			}
			try{
				$usuario = User::where('persona_id', $solicitud->mascota->propietario_id)->first();
				$userData = new \stdClass();
				$userData->email = $usuario->email;
				$userData->nombre = $usuario->persona->nombre;
				$userData->apellido = $usuario->persona->apellido;
				$userData->message = $message;
				$userData->sender = 'Pepper';
				$userData->receiver = $usuario->persona->nombre.' '.$usuario->persona->apellido;
				Mail::to($usuario->email)->send(new RevisionEmail($userData));
			}catch(\Exception $e){
				$request->session()->flash('message.level', 'danger');
				$request->session()->flash('message.content', 'El correo del usuario de la solicitud no es válido.');
			}
		}else{
			Revisiones::updateData($request);
		}
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', 'Se ha realizado la revisión.');
		return redirect()->route('detalle_solicitud', ['solicitud' => $solicitud->id]);
	}
}