<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distritos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();
            
            # COLUMNS 
            
            $table->string('nombre')->index();
            $table->string('categoria')->default('distrito')
                ->comment('Nombre con el que se conoce a la division politica.');

            $table->foreignId('provincia_id')->constrained('provincias')
                ->comment('Provincia a la que pertenece el distrito.');
            
            # INDEX 
                
            $table->unique(['provincia_id','nombre']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distritos');
    }
}
