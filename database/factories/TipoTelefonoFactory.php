<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TipoTelefono;
use Faker\Generator as Faker;

$factory->define(TipoTelefono::class, function (Faker $faker) {
    return [
        'nombre' => $faker->realText(rand(5,10))
    ];
});
