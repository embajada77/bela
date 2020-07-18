<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Calle;
use App\Localidad;
use Faker\Generator as Faker;

$factory->define(Calle::class, function (Faker $faker) {

	$localidades = Localidad::all();
	if ($localidades->count() > 0) {
		$localidad_id = $localidades->random()->id;
	} else {
		$localidad_id = factory(Localidad::class);
	}

    return [
        'nombre' => $faker->streetName(),
        'localidad_id' => $localidad_id
    ];
});
