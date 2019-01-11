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
		$roleAdministrator = Role::create([
			'name' => 'administrator'
		]);
		$roleChecker = Role::create([
			'name' => 'checker'
		]);
		
		Permission::create(['name' => 'crear_mascota']);
		Permission::create(['name' => 'crear_mascota.post']);
		Permission::create(['name' => 'detalle_mascota']);
		Permission::create(['name' => 'listar_solicitudes']);
		Permission::create(['name' => 'crear_solicitud']);
		Permission::create(['name' => 'crear_solicitud.post']);
		Permission::create(['name' => 'detalle_solicitud']);
		Permission::create(['name' => 'editar_solicitud']);
		Permission::create(['name' => 'editar_solicitud.post']);
		Permission::create(['name' => 'crear_revision.post']);
		Permission::create(['name' => 'listar_razas']);
		Permission::create(['name' => 'crear_raza']);
		Permission::create(['name' => 'crear_raza.post']);
		Permission::create(['name' => 'editar_raza']);
		Permission::create(['name' => 'editar_raza.post']);
		Permission::create(['name' => 'eliminar_raza']);
		Permission::create(['name' => 'eliminar_raza.delete']);
		Permission::create(['name' => 'listar_tipos_ataques']);
		Permission::create(['name' => 'crear_tipo_ataque']);
		Permission::create(['name' => 'crear_tipo_ataque.post']);
		Permission::create(['name' => 'editar_tipo_ataque']);
		Permission::create(['name' => 'editar_tipo_ataque.post']);
		Permission::create(['name' => 'eliminar_tipo_ataque']);
		Permission::create(['name' => 'eliminar_tipo_ataque.delete']);
		Permission::create(['name' => 'listar_localizaciones_anatomicas']);
		Permission::create(['name' => 'crear_localizacion_anatomica']);
		Permission::create(['name' => 'crear_localizacion_anatomica.post']);
		Permission::create(['name' => 'editar_localizacion_anatomica']);
		Permission::create(['name' => 'editar_localizacion_anatomica.post']);
		Permission::create(['name' => 'eliminar_localizacion_anatomica']);
		Permission::create(['name' => 'eliminar_localizacion_anatomica.delete']);
		Permission::create(['name' => 'modulo_ataques']);
		
		$roleAdministrator->givePermissionTo([
			'crear_revision.post',
			'listar_razas',
			'crear_raza',
			'crear_raza.post',
			'editar_raza',
			'editar_raza.post',
			'eliminar_raza',
			'eliminar_raza.delete',
			'listar_tipos_ataques',
			'crear_tipo_ataque',
			'crear_tipo_ataque.post',
			'editar_tipo_ataque',
			'editar_tipo_ataque.post',
			'eliminar_tipo_ataque',
			'eliminar_tipo_ataque.delete',
			'listar_localizaciones_anatomicas',
			'crear_localizacion_anatomica',
			'crear_localizacion_anatomica.post',
			'editar_localizacion_anatomica',
			'editar_localizacion_anatomica.post',
			'eliminar_localizacion_anatomica',
			'eliminar_localizacion_anatomica.delete',
			'modulo_ataques'
		]);
		$roleGuest->givePermissionTo([
			'crear_mascota',
			'crear_mascota.post',
			'detalle_mascota',
			'listar_solicitudes',
			'crear_solicitud',
			'crear_solicitud.post',
			'detalle_solicitud',
			'editar_solicitud',
			'editar_solicitud.post'
		]);
		$roleChecker->givePermissionTo([
			'crear_revision.post',
			'modulo_ataques'
		]);

		$zootecnico = User::create([
			'email' => 'zootecnico@gmail.com',
			'password' => bcrypt('12345'),
			'persona_id' => $zootecnico->id,
			'perfil' => 'Z',
			'estado' => 'A'
		]);
		$coordinador = User::create([
			'email' => 'coordinador@gmail.com',
			'password' => bcrypt('12345'),
			'persona_id' => $coordinador->id,
			'perfil' => 'C',
			'estado' => 'A'
		]);
		$jefe = User::create([
			'email' => 'jefe@gmail.com',
			'password' => bcrypt('12345'),
			'persona_id' => $jefe->id,
			'perfil' => 'J',
			'estado' => 'A'
		]);
		$zootecnico->assignRole('checker');
		$coordinador->assignRole('checker');
		$jefe->assignRole('administrator');
	}
}