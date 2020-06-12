<?php

use Illuminate\Database\Seeder;

class TipoTelefonoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Cargando tipos de documentos.');

        $this->tiposTelefonos();
    }

    protected function tiposTelefonos()
    {
        DB::table('tipos_telefonos')->insert([
            ["id" => 1, "nombre" => "Celular"],
            ["id" => 2, "nombre" => "Fijo"],
            ["id" => 3, "nombre" => "Skype"],
            ["id" => 4, "nombre" => "Trabajo"],
            ["id" => 5, "nombre" => "Fax"],
            ["id" => 6, "nombre" => "Otro"]
        ]);
    }
}
