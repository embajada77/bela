<?php

use Illuminate\Database\Seeder;

class CalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LocalidadSeeder::class);

        $this->command->info('Cargando Calles');
        $this->calles();
    }

    protected function calles()
    {
    	
    }
}
