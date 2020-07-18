<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Pais;

class CreateTelefonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->integer('codigo_area')->unsigned();
            $table->integer('numero')->unsigned();

            $table->foreignId('pais_id')->constrained('paises')->default(Pais::ARGENTINA)
                ->comment('De donde obtendremos el prefijo del país.');

            $table->foreignId('tipo_telefono_id')->constrained('tipos_telefonos')->default(1);

            # INDEX

            // Por ahora no vamos a reestringir la unicidad del telefono, ya que es solo un dato de contacto.
            // $table->unique(['pais_id','codigo_area','numero']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefonos');
    }
}
