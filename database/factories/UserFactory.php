<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
	return [
		'email' => $faker->unique()->safeEmail,
		'password' => bcrypt('12345'),
		'persona_id' => factory('App\Personas')->create()->id,
		'perfil' => 'U',
		'estado' => 'A',
		'username' => $faker->userName
	];
});