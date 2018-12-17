<?php

use App\User;
use App\Personas;
use Illuminate\Database\Seeder;

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
		User::create([
			'email' => 'zootecnico@gmail.com',
			'password' => bcrypt('12345'),
			'persona_id' => $zootecnico->id,
			'perfil' => 'Z',
			'estado' => 'A'
		]);
		User::create([
			'email' => 'coordinador@gmail.com',
			'password' => bcrypt('12345'),
			'persona_id' => $coordinador->id,
			'perfil' => 'C',
			'estado' => 'A'
		]);
		User::create([
			'email' => 'jefe@gmail.com',
			'password' => bcrypt('12345'),
			'persona_id' => $jefe->id,
			'perfil' => 'J',
			'estado' => 'A'
		]);
	}
}