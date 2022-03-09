<?php

use Illuminate\Database\Seeder;

class EstadoTurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->estadosTurno();
    }

    protected function estadosTurno()
    {
        DB::table('estados_turnos')->insert([
            ["id" => 1, "nombre" => "activo"],
            ["id" => 2, "nombre" => "finalizado"],
            ["id" => 3, "nombre" => "cancelado"],
            ["id" => 4, "nombre" => "suspendido"],
        ]);
    }
}
