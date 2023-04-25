<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('chave_pix', 200)->nullable();
            $table->string('tipo_chave_pix', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('chave_pix');
        });
    }
}