<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFMPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fmp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_integracao')->nullable()->unique();
            $table->date('data_inicial')->nullable();
            $table->date('data_final')->nullable();
            $table->double('valor', 15)->nullable();
            $table->integer('moeda_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('moeda_id')->references('id')->on('moedas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fmp');
        Schema::dropIfExists('fpm');//nome errado comitado anteriormente
    }
}
