<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Centro;
use App\Persona;
use Faker\Generator as Faker;

$factory->define(Centro::class, function (Faker $faker) {
    return [
        'persona_id' => factory(Persona::class)->states('persona_juridica')->create()
    ];
});
