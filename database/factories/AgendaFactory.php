<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\{Agenda,Centro,EstadoAgenda};
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Agenda::class, function (Faker $faker) {
	
	// $carbon = Carbon::createFromFormat('Y-m-d','2020-07-06');
	$fecha_inicio = Carbon::now()->addDays(rand(1,10))->setTime(8,0,0);
	$fecha_fin = $fecha_inicio->copy();
	$fecha_fin->addHours(rand(8,12));

    return [
        'fecha_inicio' => $fecha_inicio,
        'fecha_fin' => $fecha_fin,
		'estado_id' => EstadoAgenda::ACTIVA,
		'centro_id' => Centro::all()->random()->id,
    ];
});
