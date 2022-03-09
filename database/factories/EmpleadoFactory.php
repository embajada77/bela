<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Empleado;
use App\Persona;
use Faker\Generator as Faker;

$factory->define(Empleado::class, function (Faker $faker) {
    return [
        'persona_id' => factory(Persona::class)->states('persona_fisica')->create()
    ];
});
