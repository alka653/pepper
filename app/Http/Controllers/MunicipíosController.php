<?php

namespace App\Http\Controllers;

use App\Municipios;
use Illuminate\Http\Request;

class MunicipíosController extends Controller{
	public function getByDepartament($departamento){
		return response()->json(Municipios::obtener($departamento));
	}
}