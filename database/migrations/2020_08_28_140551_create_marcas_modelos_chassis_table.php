<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcasModelosChassisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcas_modelos_chassis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->unique();
            $table->string('descricao', 40);
            $table->string('modelo', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcas_modelos_chassis');
    }
}
