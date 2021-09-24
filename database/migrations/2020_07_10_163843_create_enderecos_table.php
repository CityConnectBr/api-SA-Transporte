<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cep', 9)->nullable();
            $table->string('endereco', 40)->nullable();
            $table->string('numero', 5)->nullable();
            $table->string('complemento', 15)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('uf', 2)->nullable();
            $table->integer('municipio_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('municipio_id')->references('id')->on('municipios');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
