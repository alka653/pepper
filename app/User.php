<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{
	use Notifiable;
	protected $fillable = ['email', 'password', 'estado', 'perfil', 'persona_id'];
	protected $hidden = [
		'password', 'remember_token',
	];
	public function persona(){
		return $this->hasOne('App\Personas', 'id', 'persona_id');
	}
	public static function saveData($data){
		$data['password'] = bcrypt(12345);
		$data['estado'] = 'A';
		return User::create($data);
	}
	public static function updatePassword($password, $user_id){
		$user = User::find($user_id);
		$user->password = bcrypt($password);
		$user->save();
		return $user;
	}
}