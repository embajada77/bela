<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->timestamp('fecha_inicio',0)->nullable();
            $table->timestamp('fecha_fin',0)->nullable();
            $table->longText('observaciones')->default('');

            $table->foreignId('estado_id')->index()
                ->constrained('estados_turnos');
            $table->foreignId('paciente_id')->index()
                ->constrained('pacientes');
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
        Schema::dropIfExists('turnos');
    }
}
