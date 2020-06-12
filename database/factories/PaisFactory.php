<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pais;
use Faker\Generator as Faker;
// use Illuminate\Support\Str;

$factory->define(Pais::class, function (Faker $faker) {

	$nombre = $faker->unique()->country();
    return [
        'nombre' => $nombre,
        'nombre_en' => $nombre,
        'iso_alfa2' => $faker->unique()->lexify('??'),
        'iso_alfa3' => $faker->unique()->lexify('???'),
        'iso_num' => $faker->unique()->numerify('###')
    ];
});
