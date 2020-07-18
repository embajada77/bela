<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosResponsablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos_responsables', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->float('comision',8,2)->default(0)
                ->comment('Porcentaje por tratamiento realizado.');

            $table->foreignId('empleado_id')->index()
                ->constrained('empleados');
            $table->foreignId('turno_tratamiento_id')->index()
                ->constrained('turnos_tratamientos');

            # INDEX

            $table->unique(['empleado_id','turno_tratamiento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos_responsables');
    }
}
