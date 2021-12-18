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
            $table->string('id_integracao')->nullable()->unique();
            $table->string('descricao', 60);
            $table->string('original_file_name', 200);
            $table->string('file_name', 60);
            $table->integer('veiculo_id')->unsigned();
            $table->timestamps();
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
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
