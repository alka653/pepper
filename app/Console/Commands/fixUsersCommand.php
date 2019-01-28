<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class fixUsersCommand extends Command{
    protected $signature = 'pepper:fix-users';
    protected $description = 'Añade perfil propietario a usuarios propietarios';
    public function __construct(){
        parent::__construct();
    }
    public function handle(){
        $roleGuest = Role::create([
			'name' => 'guest'
		]);
		$roleBoss = Role::create([
			'name' => 'boss'
		]);
		$roleCoor = Role::create([
			'name' => 'coor'
		]);
		$roleZoo = Role::create([
			'name' => 'zoo'
		]);
		
		Permission::create(['name' => 'listar_razas']);
		Permission::create(['name' => 'gestionar_raza']);

		Permission::create(['name' => 'modulo_usuarios']);

		Permission::create(['name' => 'gestionar_mascota']);
		Permission::create(['name' => 'detalle_mascota']);

		Permission::create(['name' => 'gestionar_solicitud']);
		Permission::create(['name' => 'gestionar_revision']);
		Permission::create(['name' => 'seguimiento_ataque']);

		Permission::create(['name' => 'gestionar_ataques']);

		Permission::create(['name' => 'modulo_reportes']);
		Permission::create(['name' => 'modulo_tipos_ataques']);
		Permission::create(['name' => 'modulo_localizaciones_anatomicas']);

		Permission::create(['name' => 'listar_propietarios']);
		
		$roleGuest->givePermissionTo([
			'gestionar_mascota',
			'detalle_mascota',
			'gestionar_solicitud'
		]);
		$roleBoss->givePermissionTo([
			'listar_razas',
			'modulo_usuarios',
			'listar_propietarios',
			'gestionar_revision',
			'modulo_reportes',
			'modulo_tipos_ataques',
			'modulo_localizaciones_anatomicas'
		]);
		$roleCoor->givePermissionTo([
			'listar_razas',
			'gestionar_raza',
			'listar_propietarios',
			'gestionar_mascota',
			'detalle_mascota',
			'gestionar_revision',
			'gestionar_ataques',
			'modulo_reportes'
		]);
		$roleZoo->givePermissionTo([
			'listar_razas',
			'gestionar_raza',
			'listar_propietarios',
			'gestionar_revision',
			'seguimiento_ataque'
		]);
        foreach(User::all() as $user){
            $role = '';
            switch($user->perfil){
                case 'U':
                    $role = 'guest';
                    break;
                case 'Z':
                    $role = 'zoo';
                    break;
                case 'J':
                    $role = 'boss';
                    break;
                case 'C':
                    $role = 'coor';
                    break;
            }
            $user->assignRole($role);
        }
    }
}