<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos_pagos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->float('importe',8,2)->default(0);
            
            $table->float('aumento',8,2)->default(0)
                ->comment('Al abonar en esta forma de pago se aumenta el porcentaje indicado.');
            
            $table->float('descuento',8,2)->default(0)
                ->comment('Al abonar en esta forma de pago se descuenta el porcentaje indicado.');

            $table->foreignId('tipo_pago_id')->index()
                ->constrained('tipos_pagos');
            $table->foreignId('turno_id')->index()
                ->constrained('turnos');

            # INDEX

            $table->unique(['turno_id','tipo_pago_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos_pagos');
    }
}
