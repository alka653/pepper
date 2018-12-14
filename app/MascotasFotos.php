<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MascotasFotos extends Model{
    protected $guarded = [];
	public $timestamps = false;
	public static function saveData($data){
		$data['fecha'] = date('Y-m-d');
		return MascotasFotos::create($data);
	}
}