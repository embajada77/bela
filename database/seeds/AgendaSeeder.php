<?php

use Illuminate\Database\Seeder;
use App\{Agenda,Paciente,Tratamiento};

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->agendas();
    }

    protected function agendas()
    {
        $agenda = factory(Agenda::class)->create();

		DB::transaction( function() use ($agenda) {

	        $reach_limit = 0;

	        $mensaje_error = '';

	        $pacientes = Paciente::get();
	        $tratamientos = Tratamiento::get();

	        $fecha_inicio = $agenda->fecha_inicio;
	        do {

	        	if ($fecha_inicio->gt($agenda->fecha_fin)) {
	        		$reach_limit = 1;
        			$this->command->info('Chau.' . $fecha_inicio->format('Y-m-d H:i:s') . ' ' . $agenda->fecha_fin->format('Y-m-d H:i:s'));
	        	} else {

	        		$paciente = $pacientes->random();

	        		if ($paciente) {

		        		$pacientes = $pacientes->reject(function ($value, $key) use ($paciente) {
						    return ($value->id == $paciente->id);
						});

						$turno_tratamientos = $tratamientos->random(rand(1,3));

	        			$this->command->info(
	        				'Creando Turno: ' . 
	        				$paciente->full_name . ' ' .
	        				$fecha_inicio->format('Y-m-d H:i:s') . ' [' .
	        				$turno_tratamientos->implode('full_name',', ') . ']' 
	        			);

		        		$turno = $agenda->crearTurno(
		        			$paciente,
		        			$fecha_inicio,
		        			null,
		        			$turno_tratamientos->pluck('id'),
		        			$mensaje_error
		        		);

		        		$fecha_inicio = $turno->fecha_fin;
	        		} else {
	        			$reach_limit = 1;
        				$this->command->info('No me quedaron pacientes.');
	        		}
	        	}
	        } while ( ! $reach_limit);
    	});
    }
}
