<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensagemDestinatarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagem_destinatario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mensagem_id')->unsigned();
            $table->integer('permissionario_id')->unsigned()->nullable();
            $table->integer('condutor_id')->unsigned()->nullable();
            $table->integer('monitor_id')->unsigned()->nullable();
            $table->integer('fiscal_id')->unsigned()->nullable();
            $table->boolean('enviado_email')->default(false);
            $table->boolean('enviado_push')->default(false);
            $table->timestamps();
            $table->foreign('mensagem_id')->references('id')->on('mensagens');
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
            $table->foreign('condutor_id')->references('id')->on('condutores');
            $table->foreign('monitor_id')->references('id')->on('monitores');
            $table->foreign('fiscal_id')->references('id')->on('fiscais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagem_destinatario');
    }
}