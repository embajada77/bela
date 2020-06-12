<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\WebPage;
use Faker\Generator as Faker;

$factory->define(WebPage::class, function (Faker $faker) {
    return [
        'email' => $faker->url(),
    ];
});
