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
            $table->integer('id_integracao')->nullable()->unique();
            $table->string('tipo_documento', 11);
            $table->string('serie_documento', 2);
            $table->integer('numero_primeira_folha');
            $table->integer('numero_ultima_folha');
            $table->date('data_recebimento');
            $table->integer('fiscal_id')->unsigned();
            $table->timestamps();
            $table->foreign('fiscal_id')->references('id')->on('fiscais')->onDelete('cascade');
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
