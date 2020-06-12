<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Provincia;
use App\Pais;
use Faker\Generator as Faker;

$factory->define(Provincia::class, function (Faker $faker) {

	$paises = Pais::all();
	if ($paises->count() > 0) {
		$pais_id = $paises->random()->id;
	} else {
		$pais_id = factory(Pais::class);
	}

    return [
        'nombre' => $faker->unique()->state(),
        'iso' => $faker->unique()->lexify('?????'),
        'pais_id' => $pais_id
    ];
});
