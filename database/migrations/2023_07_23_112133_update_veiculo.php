<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVeiculo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->string('gnv_numero', 20)->nullable();
            $table->date('gnv_selo_validade')->nullable();
            $table->string('gnv_ano_fabricacao', 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('veiculos', function (Blueprint $table) {
            $table->dropColumn([
                'gnv_numero',
                'gnv_selo_validade',
                'gnv_ano_fabricacao'
            ]);
        });
    }
}