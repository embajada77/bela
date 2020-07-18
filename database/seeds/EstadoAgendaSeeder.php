<?php

use Illuminate\Database\Seeder;

class EstadoAgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->estadosAgenda();
    }

    protected function estadosAgenda()
    {
        DB::table('estados_agendas')->insert([
            ["id" => 1, "nombre" => "activa"],
            ["id" => 2, "nombre" => "finalizada"],
            ["id" => 3, "nombre" => "cancelada"],
            ["id" => 4, "nombre" => "suspendida"],
        ]);
    }
}
