<?php

use Illuminate\Database\Seeder;
use App\Genero;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Cargando generos.');

        DB::table('generos')->insert([
            [
                "id" => 1, 
                "nombre" => "Hombre", 
                "alias" => "H", 
                "personeria" => Genero::PERSONERIA_FISICA
            ],
            [
                "id" => 2, 
                "nombre" => "Mujer", 
                "alias" => "M", 
                "personeria" => Genero::PERSONERIA_FISICA
            ],
            [
                "id" => 3, 
                "nombre" => "Persona Jurídica",
                "alias" => "PJ", 
                "personeria" => Genero::PERSONERIA_JURIDICA
            ],
        ]);
    }
}
