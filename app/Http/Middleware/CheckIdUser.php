<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class CheckIdUser{
	public function handle($request, Closure $next, $resource = ''){
		$user = null;
		switch($resource){
			case 'solicitud':
				$user = User::where('persona_id', $request->solicitud->mascota->propietario_id)->first();
				break;
			default:
				$user = User::where('persona_id', (is_object($request->persona) ? $request->persona->id : $request->persona))->first();
				break;
		}
		if(Auth::user()->perfil == 'U' && $user->id != Auth::user()->id){
			return redirect('403');
		}
		return $next($request);
	}
}