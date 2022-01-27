<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->nullable()->unique();
            $table->string('nome', 40);
            $table->string('telefone', 20)->nullable();
            $table->string('fax', 15)->nullable();
            $table->string('home_page', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('inscricao_estadual', 20)->nullable();
            $table->string('inscricao_municipal', 9)->nullable();
            $table->string('nome_do_diretor', 40)->nullable();
            $table->string('nome_do_gerente', 40)->nullable();
            $table->string('nome_do_encarregado_vistoriador', 40)->nullable();
            $table->string('portaria_diretor', 10)->nullable();
            $table->date('data_nomeacao_diretor')->nullable();
            $table->string('decreto_municipal_taxi', 60)->nullable();
            $table->string('decreto_municipal_escolar', 60)->nullable();
            $table->integer('endereco_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('endereco_id')->references('id')->on('enderecos');

            $table->softDeletes();
            $table->boolean('ativo')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
