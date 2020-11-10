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
            $table->string('nome', 40);
            $table->string('situacao', 1);//A/I/C
            $table->string('cpf', 11)->nullable();
            $table->string('rg', 15)->nullable();
            $table->string('telefone', 9)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('data_nascimento', 100)->nullable();
            $table->integer('versao');
            $table->integer('permissionario_id')->unsigned();
            $table->integer('endereco_id')->unsigned();
            $table->timestamps();
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
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
        Schema::dropIfExists('monitores');
    }
}
