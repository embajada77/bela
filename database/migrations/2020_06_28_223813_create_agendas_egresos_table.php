<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasEgresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas_egresos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->string('nombre');
            $table->string('alias')->default('');
            $table->longText('descripcion')->default('');
            
            $table->timestamp('fecha')->nullable();
            $table->float('importe',8,2)->default(0);

            // $table->foreignId('tipo_egreso_id')->index()
                // ->constrained('tipos_egresos');
            $table->foreignId('agenda_id')->index()
                ->constrained('agendas');
            $table->foreignId('created_by')->nullable()->index()
                ->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas_egresos');
    }
}
