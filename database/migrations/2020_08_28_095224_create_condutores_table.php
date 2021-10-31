<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondutoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condutores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao', 11)->nullable();
            $table->string('numero_de_cadastro_antigo', 10)->nullable();
            $table->string('nome', 40);
            //$table->string('situacao', 1);//A/I/C
            $table->string('cpf', 11)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('cnh', 15)->nullable();
            $table->string('categoria_cnh', 2)->nullable();
            $table->date('vencimento_cnh', 100)->nullable();
            $table->boolean('atestado_de_saude')->nullable();
            $table->boolean('certidao_negativa')->nullable();
            $table->date('validade_certidao_negativa')->nullable();
            $table->boolean('registro_ctps')->nullable();
            $table->boolean('primeiros_socorros')->nullable();
            $table->date('emissao_primeiros_socorros')->nullable();
            $table->string('motivo_afastamento', 40)->nullable();
            $table->date('data_inicio_afastamento')->nullable();
            $table->date('data_termino_afastamento')->nullable();

            $table->integer('permissionario_id')->unsigned();
            $table->integer('endereco_id')->unsigned();
            $table->string('foto_uid')->nullable();
            $table->timestamps();
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->foreign('foto_uid')->references('id')->on('arquivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condutores');
    }
}
