<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterMarcasModelosVeiculosAddCodigoIpva extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marcas_modelos_veiculos', function (Blueprint $table) {
            $table->string('codigo_ipva')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marcas_modelos_veiculos', function (Blueprint $table) {
            //
        });
    }
}
