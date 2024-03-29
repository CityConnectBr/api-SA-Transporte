<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaloesDoFiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taloes_do_fiscal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero')->nullable();
            $table->string('tipo_documento', 11)->nullable();
            $table->string('serie_documento', 2)->nullable();
            $table->integer('numero_primeira_folha')->nullable();
            $table->integer('numero_ultima_folha')->nullable();
            $table->date('data_recebimento')->nullable();
            $table->integer('fiscal_id')->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('taloes_do_fiscal');
    }
}
