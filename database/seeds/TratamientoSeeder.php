<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TratamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Cargando tratamientos');
        $this->tratamientos();
    }

    protected function tratamientos($value='')
    {
		$carbon = Carbon::createMidnightDate();

        DB::table('tratamientos')->insert([
			[
				"id" => 1, 
				"nombre" => 'entre ceja', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 150, 
			],
			[
				"id" => 2, 
				"nombre" => 'sobre ceja', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 150, 
			],
			[
				"id" => 3, 
				"nombre" => 'bozo', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 200, 
			],
			[
				"id" => 4, 
				"nombre" => 'menton', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 250, 
			],
			[
				"id" => 5, 
				"nombre" => 'rostro', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,20,0)->format('H:i:s'), 
				"importe" => 600, 
			],
			[
				"id" => 6, 
				"nombre" => 'cuello', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 350, 
			],
			[
				"id" => 7, 
				"nombre" => 'nuca', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 350, 
			],
			[
				"id" => 8, 
				"nombre" => 'axilas', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 400, 
			],
			[
				"id" => 9, 
				"nombre" => 'antebrazo', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,30,0)->format('H:i:s'), 
				"importe" => 500, 
			],
			[
				"id" => 10, 
				"nombre" => 'pecho', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,15,0)->format('H:i:s'), 
				"importe" => 400, 
			],
			[
				"id" => 11, 
				"nombre" => 'linea alba', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 300, 
			],
			[
				"id" => 12, 
				"nombre" => 'abdomen', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,20,0)->format('H:i:s'), 
				"importe" => 500, 
			],
			[
				"id" => 13, 
				"nombre" => 'cavado bikini', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 400, 
			],
			[
				"id" => 14, 
				"nombre" => 'cavado profundo', 
				"descripcion" => 'con tiro de cola',
				"duracion" => $carbon->setTime(0,20,0)->format('H:i:s'), 
				"importe" => 550, 
			],
			[
				"id" => 15, 
				"nombre" => 'espalda', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,30,0)->format('H:i:s'), 
				"importe" => 700, 
			],
			[
				"id" => 16, 
				"nombre" => 'espalda baja', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,15,0)->format('H:i:s'), 
				"importe" => 350, 
			],
			[
				"id" => 17, 
				"nombre" => 'pierna alta', 
				"descripcion" => 'muslo.',
				"duracion" => $carbon->setTime(0,35,0)->format('H:i:s'), 
				"importe" => 750, 
			],
			[
				"id" => 18, 
				"nombre" => 'pierna baja', 
				"descripcion" => 'incluye rodillas y dedos del pie.',
				"duracion" => $carbon->setTime(0,30,0)->format('H:i:s'), 
				"importe" => 650, 
			],
			[
				"id" => 19, 
				"nombre" => 'pierna entera', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,60,0)->format('H:i:s'), 
				"importe" => 1400, 
			],
			[
				"id" => 20, 
				"nombre" => 'gluteos', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,20,0)->format('H:i:s'), 
				"importe" => 450, 
			],
			[
				"id" => 21, 
				"nombre" => 'tensado laser nir', 
				"descripcion" => 'depende la zona.',
				"duracion" => $carbon->setTime(0,40,0)->format('H:i:s'), 
				"importe" => 600, 
			],
			[
				"id" => 22, 
				"nombre" => 'areolas', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 300, 
			],
			[
				"id" => 23, 
				"nombre" => '1 cuadrante', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 150, 
			],
			[
				"id" => 24, 
				"nombre" => 'cavado completo', 
				"descripcion" => 'con tiro de cola',
				"duracion" => $carbon->setTime(0,30,0)->format('H:i:s'), 
				"importe" => 650, 
			],
			[
				"id" => 25, 
				"nombre" => 'varios cuadrantes', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,40,0)->format('H:i:s'), 
				"importe" => 600, 
			],
			[
				"id" => 26, 
				"nombre" => 'espalda alta', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,20,0)->format('H:i:s'), 
				"importe" => 350, 
			],
			[
				"id" => 27, 
				"nombre" => '1/4 gluteo', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 150, 
			],
			[
				"id" => 28, 
				"nombre" => '1/2 gluteo', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 350, 
			],
			[
				"id" => 30, 
				"nombre" => 'cuadrantes muslo', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,30,0)->format('H:i:s'), 
				"importe" => 350, 
			],
			[
				"id" => 31, 
				"nombre" => 'tiro de cola', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 300, 
			],
			[
				"id" => 32, 
				"nombre" => 'labios vulvares', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 300, 
			],
			[
				"id" => 34, 
				"nombre" => 'cavado completo s/tiro cola', 
				"descripcion" => 'sin tiro de cola',
				"duracion" => $carbon->setTime(0,25,0)->format('H:i:s'), 
				"importe" => 600, 
			],
			[
				"id" => 35, 
				"nombre" => '1/2 pierna alta', 
				"descripcion" => 'mitad de adelante o mitad atras',
				"duracion" => $carbon->setTime(0,15,0)->format('H:i:s'), 
				"importe" => 400, 
			],
			[
				"id" => 36, 
				"nombre" => 'cavado profundo s/tiro cola', 
				"descripcion" => 'sin tiro de cola',
				"duracion" => $carbon->setTime(0,20,0)->format('H:i:s'), 
				"importe" => 500, 
			],
			[
				"id" => 37, 
				"nombre" => 'hombros', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,20,0)->format('H:i:s'), 
				"importe" => 300, 
			],
			[
				"id" => 38, 
				"nombre" => 'mejillas', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 250, 
			],
			[
				"id" => 39, 
				"nombre" => 'patillas', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 250, 
			],
			[
				"id" => 41, 
				"nombre" => 'rodillas', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 300, 
			],
			[
				"id" => 42, 
				"nombre" => '2 cuadrantes', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 300, 
			],
			[
				"id" => 43, 
				"nombre" => '1/2 pierna baja', 
				"descripcion" => 'mitad de adelante o mitad de atras',
				"duracion" => $carbon->setTime(0,20,0)->format('H:i:s'), 
				"importe" => 350, 
			],
			[
				"id" => 44, 
				"nombre" => 'orejas', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 200, 
			],
			[
				"id" => 45, 
				"nombre" => '3 cuadrantes', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 450, 
			],
			[
				"id" => 46, 
				"nombre" => 'manos', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,10,0)->format('H:i:s'), 
				"importe" => 200, 
			],
			[
				"id" => 47, 
				"nombre" => 'deditos del pie', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 100, 
			],
			[
				"id" => 48, 
				"nombre" => 'dedos de la mano', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,5,0)->format('H:i:s'), 
				"importe" => 100, 
			],
			[
				"id" => 49, 
				"nombre" => 'brazos', 
				"descripcion" => '',
				"duracion" => $carbon->setTime(0,30,0)->format('H:i:s'), 
				"importe" => 600, 
			]
		]);
    }
}
