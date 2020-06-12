<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domicilio;
use App\Calle;
use Faker\Generator as Faker;

$factory->define(Domicilio::class, function (Faker $faker) {

	$calles = Calle::all();
	if ($calles->count() > 0) {
		$calle_id = $calles->random()->id;
	} else {
		$calle_id = factory(Calle::class);
	}

    return [
        'piso' => $faker->numberBetween(0,15),
        'dpto' => $faker->numberBetween(1,6),
        'altura' => $faker->buildingNumber(),
        'extra' => $faker->address,
        'calle_id' => $calle_id
    ];
});
