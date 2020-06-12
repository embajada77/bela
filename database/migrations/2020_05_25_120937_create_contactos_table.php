<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->id();

            # COLUMNS

            $table->boolean('principal')->unsigned()->default(1);
            $table->boolean('publicidad')->unsigned()->default(0)
                ->comment('Acepta o no publicidad por este medio.');

            $table->unsignedBigInteger('contactable_id')->unsigned()->index();
            $table->string('contactable_type')->index();

            $table->foreignId('persona_id')->constrained('personas')->index();

            # INDEX

            $table->unique(['persona_id','contactable_id','contactable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contactos');
    }
}
