<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 40);
            $table->date('data_nascimento')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->time('hora_entrada')->nullable();
            $table->time('hora_saida')->nullable();
            $table->string('email', 200)->nullable();

            $table->integer('permissionario_id')->unsigned();
            $table->integer('ponto_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('ponto_id')->references('id')->on('pontos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
