<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissionarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_integracao')->nullable()->unique();
            $table->string('numero_de_cadastro_antigo', 10)->nullable();
            $table->string('nome_razao_social', 40);
            $table->string('tipo', 1)->nullable();//J/F
            //$table->string('situacao', 1);//A/I/C
            $table->string('cpf_cnpj', 14)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('estado_civil', 2)->nullable();
            $table->string('inscricao_municipal', 15)->nullable();
            $table->string('alvara_de_funcionamento', 15)->nullable();
            $table->string('responsavel', 40)->nullable();
            $table->string('procurador_responsavel', 40)->nullable();
            $table->string('telefone', 11)->nullable();
            $table->string('telefone2', 11)->nullable();
            $table->string('celular', 11)->nullable();
            $table->string('email', 200)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->string('naturalidade', 15)->nullable();
            $table->string('nacionalidade', 15)->nullable();
            $table->string('cnh', 15)->nullable();
            $table->string('categoria_cnh', 2)->nullable();
            $table->date('vencimento_cnh')->nullable();

            $table->string('inss', 15)->nullable();
            $table->string('prefixo', 10)->nullable();

            $table->boolean('atestado_de_saude')->nullable();
            $table->boolean('certidao_negativa')->nullable();
            $table->date('validade_certidao_negativa')->nullable();
            $table->boolean('comprovante_de_endereco')->nullable();
            $table->boolean('inscricao_do_cadastro_mobiliario')->nullable();
            $table->string('numero_do_cadastro_mobiliario', 10)->nullable();
            $table->boolean('crlv')->nullable();
            $table->boolean('dpvat')->nullable();
            $table->boolean('certificado_pontuacao_cnh')->nullable();

            $table->string('classificacao_do_processo', 2)->nullable();
            $table->string('numero_do_processo', 10)->nullable();
            $table->date('data_processo_seletivo')->nullable();


            $table->integer('entidade_associativa_id')->unsigned()->nullable();
            $table->integer('modalidade_id')->unsigned()->nullable();
            $table->integer('endereco_id')->unsigned()->nullable();
            $table->string('foto_uid')->nullable();
            $table->timestamps();
            $table->foreign('entidade_associativa_id')->references('id')->on('entidades_associativa');
            $table->foreign('modalidade_id')->references('id')->on('modalidades');
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
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
        Schema::dropIfExists('permissionarios');
    }
}
