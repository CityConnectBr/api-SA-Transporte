<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiscaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiscais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_integracao')->nullable()->unique();
            $table->string('nome', 40);
            $table->string('cpf', 11)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('cargo', 40)->nullable();
            $table->string('unidade_trabalho', 40)->nullable();
            $table->string('foto_uid')->nullable();
            //$table->integer('versao');
            $table->integer('endereco_id')->unsigned();
            $table->timestamps();
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->foreign('foto_uid')->references('id')->on('arquivos');

            $table->softDeletes();
            $table->boolean('ativo')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fiscais');
    }
}
