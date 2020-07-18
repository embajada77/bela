<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->boolean('habilitado')->default(1);
            $table->timestamp('fecha_inicio',0)->nullable();
            $table->timestamp('fecha_fin',0)->nullable();
            
            $table->float('plus_diario',8,2)->default(0)
                ->comment('Monto fijo por día trabajado para el Centro.');

            $table->float('comision_diaria',8,2)->default(0)
                ->comment('Porcentaje sobre la agenda del día para el Centro.');
            
            $table->float('plus_armado_agenda',8,2)->default(0)
                ->comment('Monto fijo por día trabajado para el encargado de armar la agenda.');
            
            $table->float('comision_armado_agenda',8,2)->default(0)
                ->comment('Porcentaje sobre la agenda del día para el encargado de armar la agenda.');

            // $table->foreignId('tipo_id')->index()
                // ->constrained('tipos_agendas');
            $table->foreignId('estado_id')->index()
                ->constrained('estados_agendas');
            $table->foreignId('centro_id')->index()
                ->constrained('centros');
            $table->foreignId('created_by')->nullable()->index()
                ->constrained('users');
        });
    }

    // create table 'agendas' (
    //     'created_at' timestamp null,
    //     'updated_at' timestamp null,
    //     'deleted_at' timestamp null,
    //     'id' bigint unsigned not null auto_increment primary key,
    //     'habilitado' tinyint(1) not null default '1',
    //     'fecha_inicio' timestamp not null,
    //     'fecha_fin' timestamp not null,
    //     'plus_diario' double(8,2) not null default '0' comment 'Monto fijo por día trabajado para el Centro.',
    //     'comision_diaria' double(8,2) not null default '0' comment 'Porcentaje sobre la agenda del día para el Centro.',
    //     'plus_armado_agenda' double(8,2) not null default '0' comment 'Monto fijo por día trabajado para el encargado de armar la agenda.',
    //     'comision_armado_agenda' double(8,2) not null default '0' comment 'Porcentaje sobre la agenda del día para el encargado de armar la agenda.',
    //     'estado_id' bigint unsigned not null,
    //     'centro_id' bigint unsigned not null,
    //     'created_by' bigint unsigned null
    // ) default character set utf8mb4 collate 'utf8mb4_unicode_ci' engine = InnoDB

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
}
