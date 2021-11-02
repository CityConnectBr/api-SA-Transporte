<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao', 15)->nullable();
            $table->boolean('foto')->default(0);
            $table->string('numero_de_cadastro_antigo', 10)->nullable();
            $table->string('nome', 40);
            //$table->string('situacao', 1);//A/I/C
            $table->string('cpf', 11)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 200)->nullable();
            $table->date('data_nascimento')->nullable();
            //$table->integer('versao');
            $table->boolean('certidao_negativa')->nullable();
            $table->date('validade_da_certidao_negativa')->nullable();
            $table->boolean('curso_de_primeiro_socorros')->nullable();
            $table->date('emissao_curso_de_primeiro_socorros')->nullable();

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
        Schema::dropIfExists('monitores');
    }
}
