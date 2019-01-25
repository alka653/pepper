<?php

use Faker\Generator as Faker;


$factory->define(App\Personas::class, function (Faker $faker) {
	$sexo = ['M', 'F'];
	$tipo_documento = ['RC', 'TI', 'CC', 'CE', 'PS', 'MS', 'AS'];
	return [
		'nombre' => $faker->firstName,
		'apellido' => $faker->lastName,
		'numero_documento' => $faker->numberBetween(1000000, 999999),
		'municipio_expedicion_id' => $faker->numberBetween(1, 1120),
		'direccion_residencia' => $faker->streetAddress,
		'municipio_residencia_id' => $faker->numberBetween(1, 1120),
		'sexo' => $sexo[$faker->numberBetween(0, 1)],
		'numero_celular' => $faker->optional()->randomNumber(),
		'numero_telefonico' => $faker->optional()->randomNumber(),
		'tipo_documento' => $tipo_documento[$faker->numberBetween(0, 6)],
		'ocupacion' => $faker->optional()->text(25)
	];
});
