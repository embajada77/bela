<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos_tratamientos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->float('importe',8,2)->default(0);

            $table->float('comision_centro',8,2)->default(0)
                ->comment('Porcentaje sobre la agenda del día para el Centro.');

            $table->foreignId('tratamiento_id')->index()
                ->constrained('tratamientos');
            $table->foreignId('turno_id')->index()
                ->constrained('turnos');

            # INDEX

            $table->unique(['turno_id','tratamiento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos_tratamientos');
    }
}
