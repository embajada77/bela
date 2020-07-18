<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();
            
            # COLUMNS 

            $table->string('nombre')->index();
            
            // $table->foreignId('tipo_id')->constrained('tipos_calles')
            //     ->comment('Tipo de calle');

            $table->foreignId('localidad_id')
                ->constrained('localidades')
                ->comment('Localidad a la que pertenece la calle.');

            # INDEX 
                
            $table->unique(['localidad_id','nombre']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calles');
    }
}
