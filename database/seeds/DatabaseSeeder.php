<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(DomicilioSeeder::class);
        // $this->call(GeneroSeeder::class);
        // $this->call(TipoDocumentoSeeder::class);
        // $this->call(TipoTelefonoSeeder::class);

        // $this->call(TipoPagoSeeder::class);
        // $this->call(TratamientoSeeder::class);
        // $this->call(EstadoAgendaSeeder::class);
        // $this->call(EstadoTurnoSeeder::class);

        // $this->call(EmpleadoSeeder::class);
        // $this->call(CentroSeeder::class);
        // $this->call(PacienteSeeder::class);
        
        $this->call(AgendaSeeder::class);
    }
}
