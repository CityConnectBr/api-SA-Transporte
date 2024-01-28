<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuadroDeInfracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quadro_de_infracoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->nullable()->unique();
            $table->string('descricao', 500);
            $table->string('acao', 500);
            $table->string('reincidencia', 60)->nullable();
            $table->integer('qtd_reincidencia')->nullable();
            $table->string('unidade_reincidencia', 5)->nullable();
            //$table->integer('modalidade_id')->unsigned()->nullable();

            $table->integer('natureza_infracao_id')->unsigned();
            $table->timestamps();
            $table->foreign('natureza_infracao_id')->references('id')->on('naturezas_da_infracao');
            //$table->foreign('modalidade_id')->references('id')->on('modalidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quadro_de_infracoes');
    }
}
