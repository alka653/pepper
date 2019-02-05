<?php

namespace App\Http\Middleware;

use Closure;
use App\UserLog;

class MakeUserLog{
    public function handle($request, Closure $next, $resource){
        $descripcion = '';
        $response = $next($request);
        switch($resource){
            case 'create_pet':
                $descripcion = 'Creación de mascota';
                break;
            case 'edit_pet':
                $descripcion = 'Actualización de datos de mascota';
                break;
            case 'create_request':
                $descripcion = 'Creación de solicitud';
                break;
            case 'update_request':
                $descripcion = 'Actualización de datos de solicitud';
                break;
            case 'create_rev':
                $descripcion = 'Creación de revisión';
                break;
            case 'update_rev':
                $descripcion = 'Actualización de revisión';
                break;
            case 'update_password':
                $descripcion = 'Actualización de contraseña';
                break;
            case 'update_profile':
                $descripcion = 'Actualización de perfil';
                break;
            case 'change_state':
                $descripcion = 'Cambio de estado';
                break;
            case 'create_raz':
                $descripcion = 'Creación de raza';
                break;
            case 'update_raz':
                $descripcion = 'Actualización de raza';
                break;
            case 'delete_raz':
                $descripcion = 'Eliminación de raza';
                break;
            case 'create_type_attack':
                $descripcion = 'Creación del tipo ataque';
                break;
            case 'update_type_attack':
                $descripcion = 'Actualización del tipo de ataque';
                break;
            case 'delete_type_attack':
                $descripcion = 'Eliminación del tipo de ataque';
                break;
            case 'create_anatomy':
                $descripcion = 'Creación de localización anatómica';
                break;
            case 'update_anatomy':
                $descripcion = 'Actualización de localización anatómica';
                break;
            case 'delete_anatomy':
                $descripcion = 'Eliminación de localización anatómica';
                break;
            case 'create_attack':
                $descripcion = 'Creación de ataque';
                break;
            case 'create_follow':
                $descripcion = 'Creación de revisión';
                break;
            case 'update_follow':
                $descripcion = 'Actualización de revisión';
                break;
        }
        UserLog::saveData($descripcion);
        return $response;
    }
}