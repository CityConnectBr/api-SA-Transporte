<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasVistoriadorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_vistoriadoras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->nullable()->unique();
            $table->string('nome', 40);
            $table->string('tipo', 1)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('inscricao_estadual', 20)->nullable();
            $table->string('inscricao_municipal', 9)->nullable();
            $table->string('nome_delegado', 40)->nullable();
            $table->string('nome_diretor', 40)->nullable();
            $table->integer('total_vistorias_dia')->nullable();
            $table->integer('endereco_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('endereco_id')->references('id')->on('enderecos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas_vistoriadoras');
    }
}
