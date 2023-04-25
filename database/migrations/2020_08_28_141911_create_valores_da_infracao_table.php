<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoresDaInfracaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valores_da_infracao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->nullable()->unique();
            $table->integer('modalidade_id')->unsigned()->nullable();
            $table->string('descricao', 40)->default('');
            $table->integer('quantidade');

            $table->integer('natureza_infracao_id')->unsigned();
            $table->integer('moeda_id')->unsigned();
            $table->timestamps();
            $table->foreign('natureza_infracao_id')->references('id')->on('naturezas_da_infracao');
            $table->foreign('moeda_id')->references('id')->on('moedas');
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
        Schema::dropIfExists('valores_da_infracao');
    }
}
