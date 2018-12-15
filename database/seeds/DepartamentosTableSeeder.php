<?php

use App\Departamentos;
use Illuminate\Database\Seeder;

class DepartamentosTableSeeder extends Seeder{
	public function run(){
		Departamentos::create([
			'id' => 1,
			'nombre' => 'ANTIOQUIA'
		]);
		Departamentos::create([
			'id' => 2,
			'nombre' => 'ATLANTICO'
		]);
		Departamentos::create([
			'id' => 3,
			'nombre' => 'BOLIVAR'
		]);
		Departamentos::create([
			'id' => 4,
			'nombre' => 'BOYACA'
		]);
		Departamentos::create([
			'id' => 5,
			'nombre' => 'CALDAS'
		]);
		Departamentos::create([
			'id' => 6,
			'nombre' => 'CAQUETA'
		]);
		Departamentos::create([
			'id' => 7,
			'nombre' => 'CAUCA'
		]);
		Departamentos::create([
			'id' => 8,
			'nombre' => 'CESAR'
		]);
		Departamentos::create([
			'id' => 9,
			'nombre' => 'CORDOBA'
		]);
		Departamentos::create([
			'id' => 10,
			'nombre' => 'CUNDINAMARCA'
		]);
		Departamentos::create([
			'id' => 11,
			'nombre' => 'CHOCO'
		]);
		Departamentos::create([
			'id' => 12,
			'nombre' => 'HUILA'
		]);
		Departamentos::create([
			'id' => 13,
			'nombre' => 'LA GUAJIRA'
		]);
		Departamentos::create([
			'id' => 14,
			'nombre' => 'MAGDALENA'
		]);
		Departamentos::create([
			'id' => 15,
			'nombre' => 'META'
		]);
		Departamentos::create([
			'id' => 16,
			'nombre' => 'NARIÑO'
		]);
		Departamentos::create([
			'id' => 17,
			'nombre' => 'N. DE SANTANDER'
		]);
		Departamentos::create([
			'id' => 18,
			'nombre' => 'QUINDIO'
		]);
		Departamentos::create([
			'id' => 19,
			'nombre' => 'RISARALDA'
		]);
		Departamentos::create([
			'id' => 20,
			'nombre' => 'SANTANDER'
		]);
		Departamentos::create([
			'id' => 21,
			'nombre' => 'SUCRE'
		]);
		Departamentos::create([
			'id' => 22,
			'nombre' => 'TOLIMA'
		]);
		Departamentos::create([
			'id' => 23,
			'nombre' => 'VALLE DEL CAUCA'
		]);
		Departamentos::create([
			'id' => 24,
			'nombre' => 'ARAUCA'
		]);
		Departamentos::create([
			'id' => 25,
			'nombre' => 'CASANARE'
		]);
		Departamentos::create([
			'id' => 26,
			'nombre' => 'PUTUMAYO'
		]);
		Departamentos::create([
			'id' => 27,
			'nombre' => 'SAN ANDRES'
		]);
		Departamentos::create([
			'id' => 28,
			'nombre' => 'AMAZONAS'
		]);
		Departamentos::create([
			'id' => 29,
			'nombre' => 'GUAINIA'
		]);
		Departamentos::create([
			'id' => 30,
			'nombre' => 'GUAVIARE'
		]);
		Departamentos::create([
			'id' => 31,
			'nombre' => 'VAUPES'
		]);
		Departamentos::create([
			'id' => 32,
			'nombre' => 'VICHADA'
		]);
		Departamentos::create([
			'id' => 33,
			'nombre' => 'BOGOTA DC'
		]);
	}
}