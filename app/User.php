<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
	use Notifiable, HasRoles;
	protected $fillable = ['email', 'password', 'estado', 'perfil', 'persona_id', 'username'];
	protected $hidden = [
		'password', 'remember_token',
	];
	public function persona(){
		return $this->hasOne('App\Personas', 'id', 'persona_id');
	}
	public static function getPerfil($perfil){
		switch($perfil){
			case 'Z':
				$perfil = 'Zootécnico';
				break;
			case 'C':
				$perfil = 'Coordinador';
				break;
			case 'J':
				$perfil = 'Jefe';
				break;
			case 'U':
				$perfil = 'Propietario';
				break;
		}
		return $perfil;
	}
	public static function getEstado($estado){
		return $estado == 'A' ? 'Activo' : 'Inactivo';
	}
	public static function saveData($data){
		$data['password'] = bcrypt($data['password']);
		$data['estado'] = 'A';
		return User::create($data);
	}
	public static function updatePerfilByPersona($perfil, $persona_id){
		$user = User::where('persona_id', $persona_id)->first();
		$user->perfil = $perfil;
		$user->save();
		return $user;
	}
	public static function updatePassword($password, $user_id){
		$user = User::find($user_id);
		$user->password = bcrypt($password);
		$user->save();
		return $user;
	}
}