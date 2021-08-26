<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexosDoVeiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos_do_veiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_integracao')->nullable()->unique();
            $table->string('descricao', 60);
            $table->integer('veiculo_id')->unsigned();
            $table->timestamps();
            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anexos_do_veiculo');
    }
}