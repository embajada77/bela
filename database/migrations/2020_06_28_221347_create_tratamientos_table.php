<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS
            
            $table->string('nombre')->index();
            $table->string('alias')->default('');
            $table->longText('descripcion')->default('');

            $table->boolean('habilitado')->default(1);

            $table->time('duracion')
                ->comment('Duración estimada del tratamiento.');

            $table->float('importe',8,2)->default(0)
                ->comment('Precio base del tratamiento. El mismo podrá tener variaciones por centro.');

            // $table->foreignId('tipo_id')->index()
                // ->constrained('tipos_tratamientos');
            // $table->foreignId('estado_id')->index()
                // ->constrained('estados_tratamientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tratamientos');
    }
}
