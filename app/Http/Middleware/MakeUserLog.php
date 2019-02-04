<?php

namespace App\Http\Middleware;

use Closure;
use App\UserLog;

class MakeUserLog{
    public function handle($request, Closure $next, $resource){
        $descripcion = '';
        $response = $next($request);
        switch($resource){
            case 'login':
                $descripcion = 'Ingreso al sistema';
                break;
        }
        UserLog::saveData($descripcion);
        return $response;
    }
}