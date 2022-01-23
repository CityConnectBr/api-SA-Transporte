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
            $table->string('referencia_id', 250)->nullable();
            $table->string('motivo_recusado', 40)->nullable();
            //$table->boolean('sincronizado');
            $table->string('status', 1)->nullable();//A-ACEITO,R-RECUSADO,C-CANCELADO,NULL-AGUARDANDO
            $table->string('campo1', 250)->nullable();
            $table->string('campo2', 250)->nullable();
            $table->string('campo3', 250)->nullable();
            $table->string('campo4', 250)->nullable();
            $table->string('campo5', 250)->nullable();
            $table->string('campo6', 250)->nullable();
            $table->string('campo7', 250)->nullable();
            $table->string('campo8', 250)->nullable();
            $table->string('campo9', 250)->nullable();
            $table->string('campo10', 250)->nullable();
            $table->string('campo11', 250)->nullable();
            $table->string('campo12', 250)->nullable();
            $table->string('campo13', 250)->nullable();
            $table->string('campo14', 250)->nullable();
            $table->string('campo15', 250)->nullable();
            $table->string('campo16', 250)->nullable();
            $table->string('campo17', 250)->nullable();
            $table->string('campo18', 250)->nullable();
            $table->string('campo19', 250)->nullable();
            $table->string('campo20', 250)->nullable();
            $table->string('campo21', 250)->nullable();
            $table->string('campo22', 250)->nullable();
            $table->string('campo23', 250)->nullable();
            $table->string('campo24', 250)->nullable();
            $table->string('campo25', 250)->nullable();
            $table->string('valor_anterior_campo1', 250)->nullable();
            $table->string('valor_anterior_campo2', 250)->nullable();
            $table->string('valor_anterior_campo3', 250)->nullable();
            $table->string('valor_anterior_campo4', 250)->nullable();
            $table->string('valor_anterior_campo5', 250)->nullable();
            $table->string('valor_anterior_campo6', 250)->nullable();
            $table->string('valor_anterior_campo7', 250)->nullable();
            $table->string('valor_anterior_campo8', 250)->nullable();
            $table->string('valor_anterior_campo9', 250)->nullable();
            $table->string('valor_anterior_campo10', 250)->nullable();
            $table->string('valor_anterior_campo11', 250)->nullable();
            $table->string('valor_anterior_campo12', 250)->nullable();
            $table->string('valor_anterior_campo13', 250)->nullable();
            $table->string('valor_anterior_campo14', 250)->nullable();
            $table->string('valor_anterior_campo15', 250)->nullable();
            $table->string('valor_anterior_campo16', 250)->nullable();
            $table->string('valor_anterior_campo17', 250)->nullable();
            $table->string('valor_anterior_campo18', 250)->nullable();
            $table->string('valor_anterior_campo19', 250)->nullable();
            $table->string('valor_anterior_campo20', 250)->nullable();
            $table->string('valor_anterior_campo21', 250)->nullable();
            $table->string('valor_anterior_campo22', 250)->nullable();
            $table->string('valor_anterior_campo23', 250)->nullable();
            $table->string('valor_anterior_campo24', 250)->nullable();
            $table->string('valor_anterior_campo25', 250)->nullable();
            $table->integer('tipo_solicitacao_id')->unsigned();
            $table->integer('permissionario_id')->unsigned()->nullable();
            $table->integer('condutor_id')->unsigned()->nullable();
            $table->integer('fiscal_id')->unsigned()->nullable();
            $table->integer('referencia_fiscal_id')->unsigned()->nullable();
            $table->integer('referencia_permissionario_id')->unsigned()->nullable();
            $table->integer('referencia_monitor_id')->unsigned()->nullable();
            $table->integer('referencia_condutor_id')->unsigned()->nullable();
            $table->integer('referencia_veiculo_id')->unsigned()->nullable();
            $table->integer('endereco_id')->unsigned()->nullable();
            $table->string('arquivo1_uid')->nullable();
            $table->string('arquivo2_uid')->nullable();
            $table->string('arquivo3_uid')->nullable();
            $table->string('arquivo4_uid')->nullable();
            $table->timestamps();
            $table->foreign('tipo_solicitacao_id')->references('id')->on('tipos_solicitacao_de_alteracao');
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('condutor_id')->references('id')->on('condutores');
            $table->foreign('fiscal_id')->references('id')->on('fiscais');
            $table->foreign('referencia_fiscal_id')->references('id')->on('fiscais');
            $table->foreign('referencia_permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('referencia_monitor_id')->references('id')->on('monitores');
            $table->foreign('referencia_condutor_id')->references('id')->on('condutores');
            $table->foreign('referencia_veiculo_id')->references('id')->on('veiculos');
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->foreign('arquivo1_uid')->references('id')->on('arquivos');
            $table->foreign('arquivo2_uid')->references('id')->on('arquivos');
            $table->foreign('arquivo3_uid')->references('id')->on('arquivos');
            $table->foreign('arquivo4_uid')->references('id')->on('arquivos');
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
