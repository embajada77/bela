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

        $this->generosPersonaFisica(Genero::PERSONERIA_FISICA);
        $this->generosPersonaJuridica(Genero::PERSONERIA_JURIDICA);
    }

    protected function generosPersonaFisica($personaria_id)
    {
        DB::table('generos')->insert([
            ["id" => 1, "nombre" => "Hombre", "alias" => "H", "personeria" => $personaria_id],
            ["id" => 2, "nombre" => "Mujer", "alias" => "M", "personeria" => $personaria_id],
        ]);
    }

    protected function generosPersonaJuridica($personaria_id)
    {
        DB::table('generos')->insert([
            ["id" => 3, "nombre" => "Persona Jurídica", "alias" => "PJ", "personeria" => $personaria_id],
        ]);
    }
}
