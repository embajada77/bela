<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Localidad;
use App\Distrito;
use Faker\Generator as Faker;

$factory->define(Localidad::class, function (Faker $faker) {

	$distritos = Distrito::all();
	if ($distritos->count() > 0) {
		$distrito_id = $distritos->random()->id;
	} else {
		$distrito_id = factory(Distrito::class);
	}

    return [
        'nombre' => $faker->city(),
        'codigo_postal' => $faker->postcode(),
        'codigo_area' => $faker->numberBetween(2,4),
        'distrito_id' => $distrito_id
    ];
});
