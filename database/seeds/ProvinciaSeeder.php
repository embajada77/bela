<?php

use Illuminate\Database\Seeder;
use App\Pais;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaisSeeder::class);

        $this->command->info('Cargando Provincias');
        $this->provinciasArgentinas(Pais::ARGENTINA,'Provincia');
        $this->provinciasChilenas(Pais::CHILE,'Región');
    }

    protected function provinciasArgentinas($pais_id, $categoria)
    {
        DB::table('provincias')->insert([
            ["id" => 1, "nombre" => "buenos aires", "alias" => "pba", "iso" => "AR-B", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 2, "nombre" => "catamarca", "alias" => "cat", "iso" => "AR-K", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 3, "nombre" => "chaco", "alias" => "cha", "iso" => "AR-H", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 4, "nombre" => "chubut", "alias" => "chu", "iso" => "AR-U", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 5, "nombre" => "cordoba", "alias" => "cba", "iso" => "AR-X", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 6, "nombre" => "corrientes", "alias" => "cte", "iso" => "AR-W", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 7, "nombre" => "entre rios", "alias" => "eri", "iso" => "AR-E", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 8, "nombre" => "formosa", "alias" => "for", "iso" => "AR-P", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 9, "nombre" => "jujuy", "alias" => "juy", "iso" => "AR-Y", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 10, "nombre" => "la pampa", "alias" => "lpa", "iso" => "AR-L", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 11, "nombre" => "la rioja", "alias" => "lri", "iso" => "AR-F", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 12, "nombre" => "mendoza", "alias" => "mza", "iso" => "AR-M", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 13, "nombre" => "misiones", "alias" => "mis", "iso" => "AR-N", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 14, "nombre" => "neuquen", "alias" => "neu", "iso" => "AR-Q", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 15, "nombre" => "rio negro", "alias" => "rng", "iso" => "AR-R", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 16, "nombre" => "salta", "alias" => "sta", "iso" => "AR-A", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 17, "nombre" => "san juan", "alias" => "sju", "iso" => "AR-J", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 18, "nombre" => "san luis", "alias" => "slu", "iso" => "AR-D", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 19, "nombre" => "santa cruz", "alias" => "scr", "iso" => "AR-Z", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 20, "nombre" => "santa fe", "alias" => "sfe", "iso" => "AR-S", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 21, "nombre" => "santiago del estero", "alias" => "sgo", "iso" => "AR-G", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 22, "nombre" => "tierra del fuego", "alias" => "tdf", "iso" => "AR-V", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 23, "nombre" => "tucuman", "alias" => "tuc", "iso" => "AR-T", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 24, "nombre" => "ciudad autonoma de bs. as.", "alias" => "caba", "iso" => "AR-C", "categoria" => "ciudad autonoma", "pais_id" => $pais_id],
        ]);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function provinciasChilenas($pais_id, $categoria)
    {
		DB::table('provincias')->insert([
           	["id" => 25, "nombre" => "antofagasta", "iso" => "CL-AN", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 26, "nombre" => "arica y parinacota", "iso" => "CL-AP", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 27, "nombre" => "atacama", "iso" => "CL-AT", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 28, "nombre" => "aysen del general carlos ibáñez del campo", "iso" => "CL-AI", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 29, "nombre" => "bío-bío", "iso" => "CL-BI", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 30, "nombre" => "coquimbo", "iso" => "CL-CO", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 31, "nombre" => "la araucanía", "iso" => "CL-AR", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 32, "nombre" => "los lagos", "iso" => "CL-LL", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 33, "nombre" => "los ríos", "iso" => "CL-LR", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 34, "nombre" => "magallanes y de la antártica chilena", "iso" => "CL-MA", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 35, "nombre" => "maule", "iso" => "CL-ML", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 36, "nombre" => "región metropolitana de santiago", "iso" => "CL-RM", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 37, "nombre" => "tarapacá", "iso" => "CL-TA", "categoria" => $categoria, "pais_id" => $pais_id],
            ["id" => 38, "nombre" => "valparaíso", "iso" => "CL-VS", "categoria" => $categoria, "pais_id" => $pais_id]
        ]);
    }
}
