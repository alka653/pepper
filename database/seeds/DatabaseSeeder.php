<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
	public function run(){
		$this->call([
			DepartamentosTableSeeder::class,
			MunicipiosTableSeeder::class,
			UsersTableSeeder::class,
			MainTableSeeder::class
		]);
	}
}