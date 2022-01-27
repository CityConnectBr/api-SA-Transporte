<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infracoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao',11)->nullable()->unique();
            $table->string('num_aip',11)->unique();
            $table->date('data_infracao');
            $table->time('hora_infracao');
            $table->string('local', 60)->nullable();
            $table->string('obs_aip', 500)->nullable();
            $table->string('descricao', 500)->nullable();
            $table->string('acao_tomada', 500)->nullable();
            $table->string('num_processo', 15)->nullable();
            $table->string('num_boleto', 15)->nullable();
            $table->date('data_vendimento_boleto')->nullable();
            $table->integer('qtd_moeda')->nullable();
            $table->integer('reincidente')->default(0);

            $table->integer('moeda_id')->nullable()->unsigned();
            $table->integer('veiculo_id')->nullable()->unsigned();
            $table->integer('permissionario_id')->nullable()->unsigned();
            $table->integer('quadro_infracao_id')->nullable()->unsigned();
            $table->integer('natureza_infracao_id')->nullable()->unsigned();
            $table->string('foto_uid')->nullable();

            $table->timestamps();
            $table->foreign('moeda_id')->references('id')->on('moedas');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('quadro_infracao_id')->references('id')->on('quadro_de_infracoes');
            $table->foreign('natureza_infracao_id')->references('id')->on('naturezas_da_infracao');
            $table->foreign('foto_uid')->references('id')->on('arquivos');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infracoes');
    }
}
