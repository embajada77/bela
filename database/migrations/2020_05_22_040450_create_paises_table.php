<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();
    
            # COLUMNS
            
            $table->string('nombre')->index()->unique()
                ->comment('Nombre del país en español');
            $table->string('nombre_en')->default('')->unique()
                ->comment('Name of the country in english');
            $table->string('categoria')->default('país')
                ->comment('Nombre con el que se conoce a la division politica.');

            $table->string('iso_alfa2',4)->default('')->unique()
                ->comment('Alias formal, ISO 3166-1 alfa 2');
            $table->string('iso_alfa3',4)->default('')->unique()
                ->comment('Alias formal, ISO 3166-1 alfa 3');
            $table->mediumInteger('iso_num')->default(0)->unique()
                ->comment('Alias formal, ISO 3166-1 numérico');
            
            $table->string('tel_prefijo',10)->default('')
                ->comment('Prefijo Telefónico Internacional');
            $table->string('lenguaje',10)->default('')
                ->comment('Lengua Oficial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paises');
    }
}
