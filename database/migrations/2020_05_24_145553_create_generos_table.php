<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();
            
            # COLUMNS 

            $table->string('nombre')->unique();
            $table->string('alias')->default('');
            $table->longText('descripcion')->default('');
            $table->enum('personeria', ['física','jurídica']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generos');
    }
}
