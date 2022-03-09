<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TipoDocumento;
use App\Pais;
use App\Persona;
use App\Genero;
use Faker\Generator as Faker;

$factory->define(Persona::class, function (Faker $faker) {
	
    return [
        'documento' => $faker->unique()->numerify('########'),
    ];
});

$factory->state(Persona::class,'persona_fisica', function(Faker $faker) {
	
	$faker->addProvider(new \Faker\Provider\es_AR\Person($faker));

	$genero = Genero::find(rand(Genero::HOMBRE,Genero::MUJER));

	switch ($genero->id) {
		case Genero::HOMBRE:
			$nombre = $faker->firstNameMale;
			break;

		case Genero::MUJER:
			$nombre = $faker->firstNameFemale;
			break;
	}

	$tipos_documentos = $genero->tiposDocumentos(Pais::ARGENTINA);
	
	return [
    	'tipo_documento_id' => $tipos_documentos->random()->id,
    	'nombre' => $nombre,
    	'apellido' => $faker->lastName,
    	'genero_id' => $genero->id,
    	'nacimiento' => $faker->dateTimeBetween('1920-01-01','2014-12-31')
	];
});

$factory->state(Persona::class,'persona_juridica', function(Faker $faker) {

	$genero = Genero::find(Genero::PERSONA_JURIDICA);
	$tipos_documentos = $genero->tiposDocumentos(Pais::ARGENTINA);
	
	return [
    	'tipo_documento_id' => $tipos_documentos->random()->id,
    	'nombre' => $faker->company,
    	'genero_id' => $genero->id,
    	'nacimiento' => $faker->dateTimeBetween('1920-01-01','2014-12-31')
	];
});
