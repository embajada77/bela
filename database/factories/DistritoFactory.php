<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Distrito;
use App\Provincia;
use Faker\Generator as Faker;

$factory->define(Distrito::class, function (Faker $faker) {

	$provincias = Provincia::all();
	if ($provincias->count() > 0) {
		$provincia_id = $provincias->random()->id;
	} else {
		$provincia_id = factory(Provincia::class);
	}

    return [
        'nombre' => $faker->city(),
        'provincia_id' => $provincia_id
    ];
});
