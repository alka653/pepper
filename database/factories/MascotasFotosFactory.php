<?php

use Faker\Generator as Faker;

$factory->define(App\MascotasFotos::class, function (Faker $faker, $params) {
    return [
    	'fecha' => $faker->date('Y-m-d'),
    	'foto' => 'mascotas/'.$faker->image('public/storage/mascotas',400,300, null, false),
    	'mascota_id' => $params['mascota_id']
    ];
});