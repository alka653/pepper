<?php

use App\User;
use App\Personas;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder{
	public function run(){
		$zootecnico = Personas::create([
			'nombre' => 'Persona',
			'apellido' => 'Zootecnica',
			'numero_documento' => '123456789',
			'municipio_expedicion_id' => 1,
			'direccion_residencia' => 'Springfield',
			'municipio_residencia_id' => 1,
			'sexo' => 'M',
			'numero_celular' => 0,
			'numero_telefonico' => 0,
			'tipo_documento' => 'CC',
			'ocupacion' => 'Zootecnista'
		]);
		$coordinador = Personas::create([
			'nombre' => 'Persona',
			'apellido' => 'Coordinador',
			'numero_documento' => '12345678',
			'municipio_expedicion_id' => 1,
			'direccion_residencia' => 'Springfield',
			'municipio_residencia_id' => 1,
			'sexo' => 'M',
			'numero_celular' => 0,
			'numero_telefonico' => 0,
			'tipo_documento' => 'CC',
			'ocupacion' => 'Coordinador'
		]);
		$jefe = Personas::create([
			'nombre' => 'Persona',
			'apellido' => 'Jefe',
			'numero_documento' => '123456780',
			'municipio_expedicion_id' => 1,
			'direccion_residencia' => 'Springfield',
			'municipio_residencia_id' => 1,
			'sexo' => 'M',
			'numero_celular' => 0,
			'numero_telefonico' => 0,
			'tipo_documento' => 'CC',
			'ocupacion' => 'Jefe'
		]);

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

		$zootecnico = User::create([
			'email' => 'zootecnico@gmail.com',
			'username' => 'zootecnico',
			'password' => bcrypt('12345'),
			'persona_id' => $zootecnico->id,
			'perfil' => 'Z',
			'estado' => 'A'
		]);
		$coordinador = User::create([
			'email' => 'coordinador@gmail.com',
			'username' => 'coordinador',
			'password' => bcrypt('12345'),
			'persona_id' => $coordinador->id,
			'perfil' => 'C',
			'estado' => 'A'
		]);
		$jefe = User::create([
			'email' => 'jefe@gmail.com',
			'username' => 'jefe',
			'password' => bcrypt('12345'),
			'persona_id' => $jefe->id,
			'perfil' => 'J',
			'estado' => 'A'
		]);
		$zootecnico->assignRole('zoo');
		$coordinador->assignRole('coor');
		$jefe->assignRole('boss');
	}
}