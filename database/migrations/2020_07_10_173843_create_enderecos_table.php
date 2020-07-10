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
            $table->integer('permissionario_id')->unsigned();
            $table->string('CEP', 40)->nullable();
            $table->string('endereco', 40)->nullable();
            $table->string('numero', 5)->nullable();
            $table->string('complemento', 15)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('municipio', 25)->nullable();
            $table->string('UF', 2)->nullable();
            $table->timestamps();
            $table->foreign('permissionario_id')->references('id')->on('permissionarios');
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
