<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->unique();
            $table->string('descricao', 40);
            $table->string('modalidade_transporte', 1);
            $table->integer('idade_limite_ingresso');
            $table->integer('idade_limite_permanencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_veiculos');
    }
}
