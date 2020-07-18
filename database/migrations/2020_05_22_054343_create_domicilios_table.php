<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomiciliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domicilios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();
            
            # COLUMNS
            
            $table->string('altura')->default('');
            $table->string('piso')->default('');
            $table->string('dpto')->default('');
            $table->longText('extra')->default('');
            
            $table->foreignId('calle_id')
                ->constrained('calles')
                ->comment('Calle a la que pertenece el domicilio.');
            
            # INDEX 

            // $table->unique(['calle_id','altura','piso','dpto','extra'],'domi_unique_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domicilios');
    }
}
