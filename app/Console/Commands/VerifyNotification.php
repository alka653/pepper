<?php

namespace App\Console\Commands;

use App\User;
use App\Solicitudes;
use App\Mail\RevisionEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class VerifyNotification extends Command{
	protected $signature = 'pepper:revision';
	protected $description = 'Verificar estados de revisiones';
	public function __construct(){
		parent::__construct();
	}
	//public static function getDateEnable($date, $)
	public function handle(){
		foreach(Solicitudes::where('estado', 'P')->get() as $solicitud){
			if($solicitud->revisiones->count() > 0){
				$revision = $solicitud->revisiones[0];
				if($revision->estado == 'N'){
					$fecha_actual = date('Y-m-d');
					$fecha_maxima_revision = date('Y-m-d', strtotime('+8 day', strtotime($revision->fecha)));
					$fecha_minima_revision = date('Y-m-d', strtotime('+3 day', strtotime($revision->fecha)));
					if($fecha_actual >= $fecha_maxima_revision){
						$solicitud->estado = 'C';
						$solicitud->save();
					}else if($fecha_actual >= $fecha_minima_revision){
						$usuario = User::where('persona_id', $solicitud->mascota->propietario->id)->first();
						try{
							$userData = new \stdClass();
							$userData->email = $usuario->email;
							$userData->nombre = $usuario->persona->nombre;
							$userData->apellido = $usuario->persona->apellido;
							$userData->message = 'Tienes pendiente actualizar datos en la solicitud realizada el día '.$solicitud->fecha.'. Recuerda que pasado esa fecha, se abortará automáticamente la solicitud. <br> El motivo de estado pendiente de la solicitud se debe a: '.$revision->observacion;
							$userData->sender = 'Pepper';
							$userData->receiver = $usuario->persona->nombre.' '.$usuario->persona->apellido;
							Mail::to($usuario->email)->send(new RevisionEmail($userData));
						}catch(\Exception $e){}
					}
				}
			}
		}
	}
}