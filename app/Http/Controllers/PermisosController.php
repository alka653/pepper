<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermisosController extends Controller{
    const DIR_TEMPLATE = 'permisos.';
    public function list(Request $request){
		return view(self::DIR_TEMPLATE.'list', [
			'roles' => Role::all()
		]);
	}
}