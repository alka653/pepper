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
	public function save(Solicitudes $solicitud, Request $request){
		$modo = '';
		$message = '';
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
			$message = 'La solicitud ha sido rechazada por: '.$request->observacion.' <br> Recuerda que tienes máximo 8 días hábiles para corregir lo solicitado.';
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
			$message = 'La solicitud ha sido aprobada, ahora puede ingresar y generar el certificado para la mascota.';
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
		
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', 'Se ha realizado la revisión.');
		return redirect()->route('detalle_solicitud', ['solicitud' => $solicitud->id]);
	}
}