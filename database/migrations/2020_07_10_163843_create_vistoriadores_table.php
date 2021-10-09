<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVistoriadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistoriadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_integracao')->nullable()->unique();
            $table->string('nome', 40);
            $table->string('cargo', 20)->nullable();

            $table->integer('empresa_vistoriadora_id')->unsigned();
            $table->timestamps();
            $table->foreign('empresa_vistoriadora_id')->references('id')->on('empresas_vistoriadoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vistoriadores');
    }
}
