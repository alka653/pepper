<?php

namespace App\Http\Middleware;

use Closure;
use App\Mascotas;
use Illuminate\Support\Facades\Auth;

class CheckOwnPet{
	public function handle($request, Closure $next, $accessWithAdmin = 'true'){
		if(($request->mascota->propietario_id != Auth::user()->persona_id && Auth::user()->perfil == 'U') || (Auth::user()->perfil != 'U' && $accessWithAdmin != 'true')){
			return redirect('403');
		}
		return $next($request);
	}
}