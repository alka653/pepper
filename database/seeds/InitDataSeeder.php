<?php

use Illuminate\Database\Seeder;

class InitDataSeeder extends Seeder{
	public function run(){
		factory(App\User::class, 30)->create()->each(function($user){
			factory(App\Mascotas::class, rand(1, 3))->create([
				'propietario_id' => $user->persona_id
			])->each(function($mascota){
				factory(App\MascotasFotos::class, 3)->create([
					'mascota_id' => $mascota->id
				]);
			});
		});
	}
}