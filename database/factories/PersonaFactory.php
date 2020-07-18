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

	// $tipos_documentos = TipoDocumento::whereNull('genero_id')
	// 	->orWhere('genero_id','=',$genero_id)
	// 	->orWhere('pais_id','=',Pais::ARGENTINA)
	// 	->get();

	$tipos_documentos = $genero->tiposDocumentos(Pais::ARGENTINA);
	
	return [
    	'tipo_documento_id' => $tipos_documentos->random()->id,
    	'nombre' => $nombre,
    	'apellido' => $faker->lastName,
    	'genero_id' => $genero->id
	];
});

$factory->state(Persona::class,'persona_juridica', function(Faker $faker) {

	$genero = Genero::find(Genero::PERSONA_JURIDICA);

	// $tipos_documentos = TipoDocumento::where('pais_id','=',Pais::ARGENTINA)
	// 	->where(function($q) use ($genero_id) {
	// 		$q->whereNull('genero_id')
	// 			->orWhere('genero_id','=',$genero_id);
	// 	})
	// 	->get();

	$tipos_documentos = $genero->tiposDocumentos(Pais::ARGENTINA);
	
	return [
    	'tipo_documento_id' => $tipos_documentos->random()->id,
    	'nombre' => $faker->company,
    	'genero_id' => $genero->id
	];
});
/*
DELETE FROM empleados;
DELETE FROM centros;
DELETE FROM pacientes;
DELETE FROM personas;

SELECT td.alias, td.nombre, x.nombre, COUNT(p.id)
FROM personas p
	LEFT JOIN tipos_documentos td ON td.id = p.tipo_documento_id
    LEFT JOIN paises x ON x.id = td.pais_id
GROUP BY td.id
*/