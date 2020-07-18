<?php

use Illuminate\Database\Seeder;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Cargando turnos');
        $this->turnos();
    }

    protected function turnos()
    {
        factory(App\Turno::class)->create();
    }
}
