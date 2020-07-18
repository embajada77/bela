<?php

use Illuminate\Database\Seeder;

class DomicilioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CalleSeeder::class);

        $this->command->info('Cargando Domicilios');
        $this->domicilios();
    }

    protected function domicilios()
    {
        factory(App\Domicilio::class,3)->create();
    }
}
