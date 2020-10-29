<?php

use Composer\XdebugHandler\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacoesDeAlteracaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacoes_de_alteracao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('referencia_id', 40)->nullable();
            $table->string('motivo_recusado', 40)->nullable();
            $table->boolean('sincronizado');
            $table->string('status', 1)->nullable();//A-ACEITO,R-RECUSADO,C-CANCELADO,NULL-AGUARDANDO
            $table->string('campo1', 40)->nullable();
            $table->string('campo2', 40)->nullable();
            $table->string('campo3', 40)->nullable();
            $table->string('campo4', 40)->nullable();
            $table->string('campo5', 40)->nullable();
            $table->string('campo6', 40)->nullable();
            $table->string('campo7', 40)->nullable();
            $table->string('campo8', 40)->nullable();
            $table->string('campo9', 40)->nullable();
            $table->string('campo10', 40)->nullable();
            $table->string('campo11', 40)->nullable();
            $table->string('campo12', 40)->nullable();
            $table->string('campo13', 40)->nullable();
            $table->string('campo14', 40)->nullable();
            $table->string('campo15', 40)->nullable();
            $table->string('campo16', 40)->nullable();
            $table->string('campo17', 40)->nullable();
            $table->string('campo18', 40)->nullable();
            $table->string('campo19', 40)->nullable();
            $table->string('campo20', 40)->nullable();
            $table->string('arquivo1', 400)->nullable();
            $table->string('arquivo2', 400)->nullable();
            $table->string('arquivo3', 400)->nullable();
            $table->string('arquivo4', 400)->nullable();
            $table->integer('tipo_solicitacao_id')->unsigned();
            $table->timestamps();
            $table->foreign('tipo_solicitacao_id')->references('id')->on('tipos_solicitacao_de_alteracao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitacoes_de_alteracao');
    }
}
