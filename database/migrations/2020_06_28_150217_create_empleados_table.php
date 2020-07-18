<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->date('alta')->nullable();
            $table->date('baja')->nullable();

            $table->boolean('habilitado')->default(1);

            // $table->foreignId('tipo_id')->index()
                // ->constrained('tipos_empleados');
            // $table->foreignId('estado_id')->index()
                // ->constrained('estados_empleados');
            $table->foreignId('persona_id')->index()
                ->constrained('personas');
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
        Schema::dropIfExists('empleados');
    }
}
