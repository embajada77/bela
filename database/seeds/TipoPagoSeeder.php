<?php

use Illuminate\Database\Seeder;

class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Cargando metodos de pagos.');
        $this->metodosPagos();
    }

    protected function metodosPagos()
    {
        DB::table('tipos_pagos')->insert([
            ["id" => 1, "nombre" => "efectivo", "alias" => "eft", "aumento" => 0, "descuento" => 0],
            ["id" => 2, "nombre" => "débito", "alias" => "deb", "aumento" => 10, "descuento" => 0],
            ["id" => 3, "nombre" => "crédito", "alias" => "cred", "aumento" => 10, "descuento" => 0],
        ]);
    }
}
