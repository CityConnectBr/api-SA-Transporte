<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVistoriaPontoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistoria_ponto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->nullable()->unique();
            $table->date('data_vistoria');
            $table->integer('condicoes_de_pintura');
            $table->integer('condicoes_de_cobertura');
            $table->integer('condicoes_de_emplacamento');
            $table->integer('condicoes_de_sanitario');
            $table->string('observacoes', 500);

            $table->integer('vistoriador_id')->unsigned();
            $table->integer('ponto_id')->unsigned();
            $table->timestamps();
            $table->foreign('vistoriador_id')->references('id')->on('vistoriadores');
            $table->foreign('ponto_id')->references('id')->on('pontos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vistoria_ponto');
    }
}
