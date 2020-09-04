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
            $table->string('id_integracao', 11)->unique();
            $table->string('nome', 40);
            $table->string('situacao', 1);//A/I/C
            $table->string('cpf', 14)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('ddd', 2)->nullable();
            $table->string('telefone', 8)->nullable();
            $table->string('celular', 9)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('data_nascimento', 100)->nullable();
            $table->string('naturalidade', 15)->nullable();
            $table->string('nacionalidade', 15)->nullable();
            $table->string('cnh', 15)->nullable();
            $table->string('categoria_cnh', 2)->nullable();
            $table->date('vencimento_cnh', 100)->nullable();
            $table->integer('versao');
            $table->integer('endereco_id')->unsigned();
            $table->timestamps();
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade');
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
