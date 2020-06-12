<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_documentos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();
            
            # COLUMNS 

            $table->string('nombre');
            $table->string('alias')->default('');
            $table->longText('descripcion')->default('');
            $table->enum('personeria', ['física','jurídica'])->nullable();
            
            $table->foreignId('genero_id')->nullable()->constrained('generos')
                ->comment('Genero asociado al tipo de documento. Podría ser ninguno.');

            $table->foreignId('pais_id')->constrained('paises')
                ->comment('Pais al que pertenece la tipo de documento.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_documentos');
    }
}
