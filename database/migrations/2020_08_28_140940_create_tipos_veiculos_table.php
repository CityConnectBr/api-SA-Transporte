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
            $table->string('id_integracao')->nullable()->unique();
            $table->string('descricao', 40);
            $table->integer('modalidade_id')->unsigned()->nullable();
            $table->integer('idade_limite_ingresso')->nullable();
            $table->integer('idade_limite_permanencia')->nullable();
            $table->timestamps();
            $table->foreign('modalidade_id')->references('id')->on('modalidades');
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
