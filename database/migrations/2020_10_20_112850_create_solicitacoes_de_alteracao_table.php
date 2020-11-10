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
            $table->boolean('sincronizado');
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
            // $table->string('arquivo1', 400)->nullable();
            // $table->string('arquivo2', 400)->nullable();
            // $table->string('arquivo3', 400)->nullable();
            // $table->string('arquivo4', 400)->nullable();
            // $table->string('arquivo5', 400)->nullable();
            // $table->string('arquivo6', 400)->nullable();
            $table->integer('tipo_solicitacao_id')->unsigned();
            $table->integer('permissionario_id')->unsigned()->nullable();
            $table->integer('condutor_id')->unsigned()->nullable();
            $table->integer('fiscal_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('tipo_solicitacao_id')->references('id')->on('tipos_solicitacao_de_alteracao');
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('condutor_id')->references('id')->on('condutores');
            $table->foreign('fiscal_id')->references('id')->on('fiscais');
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
