<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\TipoDocumento;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS 

            $table->string('nombre')->default('')->index();
            $table->string('apellido')->default('')->index();
            $table->date('nacimiento')->nullable();

            $table->string('documento')->index();
            $table->foreignId('tipo_documento_id')->constrained('tipos_documentos')->default(TipoDocumento::DNI);

            $table->foreignId('genero_id')->constrained('generos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}