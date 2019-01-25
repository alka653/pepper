<?php

use Faker\Generator as Faker;


$factory->define(App\Mascotas::class, function (Faker $faker, $params) {
	$sexo = ['M', 'F'];
	return [
		'propietario_id' => $params['propietario_id'],
		'nombre' => $faker->firstName,
		'fecha_nacimiento' => $faker->date('Y-m-d'),
		'sexo' => $sexo[$faker->numberBetween(0, 1)],
		'color' => $faker->colorName,
		'descripcion' => $faker->text,
		'estado' => 'V',
		'vacunado' => 1,
		'fecha_vacunacion' => $faker->date('Y-m-d'),
		'raza_id' => $faker->numberBetween(1, 15)
	];
});