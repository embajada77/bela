<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_pagos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS 

            $table->string('nombre');
            $table->string('alias')->default('');
            $table->longText('descripcion')->default('');

            $table->boolean('habilitado')->default(1);
            
            $table->float('aumento',8,2)->default(0)
                ->comment('Si se abona en esta forma de pago, se aumenta lo indicado.');
            
            $table->float('descuento',8,2)->default(0)
                ->comment('Si se abona en esta forma de pago, se descuenta lo indicado.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_pagos');
    }
}
