<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model{
    protected $guarded = [];
	public $timestamps = false;
    protected $table = 'users_log';
    public function usuario(){
		return $this->belongsTo('App\User', 'user_id');
	}
    public static function saveData($descripcion){
		return UserLog::create([
            'fecha' => date('Y-m-d H:i:s'),
            'descripcion' => $descripcion,
            'user_id' => Auth::user()->id
        ]);
    }
}