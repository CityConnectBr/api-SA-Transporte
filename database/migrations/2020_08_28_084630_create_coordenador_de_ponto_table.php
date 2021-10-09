<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordenadorDePontoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenador_de_ponto', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_inicial')->nullable();
            $table->date('data_termino')->nullable();
            $table->string('observacao', 500)->nullable();

            $table->integer('permissionario_id')->unsigned();
            $table->integer('ponto_id')->unsigned();
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
        Schema::dropIfExists('vistoria_ponto');
    }
}
