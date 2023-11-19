<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVeiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->integer('veiculo_substituido_id')->nullable()->unsigned();
            $table->foreign('veiculo_substituido_id')->references('id')->on('veiculos');

            $table->integer('solicitacao_substituicao_id')->nullable()->unsigned();
            $table->foreign('solicitacao_substituicao_id')->references('id')->on('solicitacoes_de_alteracao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::alter('veiculos', function (Blueprint $table) {
            $table->dropForeign('veiculos_id_veiculo_substituido_foreign');
            $table->dropForeign('veiculos_id_solicitacao_substituicao_foreign');
            $table->dropColumn('id_veiculo_substituido');
            $table->dropColumn('id_solicitacao_substituicao');
        });
    }
}