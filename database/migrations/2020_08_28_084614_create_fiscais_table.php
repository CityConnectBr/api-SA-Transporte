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
            $table->integer('id_integracao')->nullable()->unique();
            $table->string('nome', 40);
            $table->string('cpf', 11)->nullable();
            $table->string('telefone', 11)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('cargo', 40)->nullable();
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
        Schema::dropIfExists('fiscais');
    }
}
