<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->float('sueldo_mensual',8,2)->default(0)
                ->comment('Monto fijo por mes.');
            
            $table->float('plus_diario',8,2)->default(0)
                ->comment('Monto fijo por día trabajado.');

            $table->float('comision_diaria',8,2)->default(0)
                ->comment('Porcentaje sobre la agenda del día.');
            
            $table->float('comision_tratamiento',8,2)->default(0)
                ->comment('Porcentaje por tratamiento realizado.');

            $table->unsignedBigInteger('salaryable_id')->unsigned()->index();
            $table->string('salaryable_type')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salarios');
    }
}
