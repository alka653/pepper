<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller{
    const DIR_TEMPLATE = 'permisos.';
    public function list(Request $request){
		return view(self::DIR_TEMPLATE.'list', [
			'roles' => Role::all()
		]);
    }
    public function new(){
        return view(self::DIR_TEMPLATE.'form', [
            'title' => 'Agregar permiso',
            'roles' => ['' => 'Seleccione un rol'] + Role::all()->mapWithKeys(function($role){
                switch($role['name']){
                    case 'guest':
                        $role['name'] = 'Propietario';
                        break;
                    case 'boss':
                        $role['name'] = 'Jefe';
                        break;
                    case 'coor':
                        $role['name'] = 'Coordinador';
                        break;
                    case 'zoo':
                        $role['name'] = 'Zootécnico';
                        break;
                }
                return [$role['id'] => $role['name']];
            })->toArray(),
            'permissions' => ['' => 'Seleccione un permiso'] + Permission::all()->mapWithKeys(function($permission){
                return [$permission['id'] => $permission['name']];
            })->toArray(),
			'method' => 'post'
		]);
    }
    public function save(Request $request){
        $type = 'danger';
        $message = 'El perfil ya tiene el permiso';
        $role = Role::find($request->role);
        $permision = Permission::find($request->permission);
        if(!$role->hasPermissionTo($permision->name)){
            $type = 'success';
            $message = 'Permiso agregado al perfil';
            $role->givePermissionTo([$permision['name']]);
        }
        $request->session()->flash('message.level', $type);
		$request->session()->flash('message.content', $message);
		return redirect()->route('listar_permisos');
    }
    public function delete($perfil, $permiso){
		return view('elements.delete_form', [
			'object' => [],
			'title' => 'Eliminar permiso',
			'message' => "¿Desea eliminar el permiso?",
			'route' => ['eliminar_permiso.delete', $perfil, $permiso]
		]);
	}
	public function deleteData($perfil, $permiso, Request $request){
		$role = Role::find($perfil);
        $permission = Permission::find($permiso);
        $role->revokePermissionTo($permission['name']);
		$request->session()->flash('message.level', 'success');
		$request->session()->flash('message.content', 'Permiso eliminado correctamente');
		return redirect()->route('listar_permisos');
	}
}