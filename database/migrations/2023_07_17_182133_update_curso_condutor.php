<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCursoCondutor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cursos_do_condutor', function (Blueprint $table) {
            $table->date('data_validade')->nullable();
            $table->string('nome', 100)->nullable();
            $table->string('descricao', 150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cursos_do_condutor', function (Blueprint $table) {
            $table->dropColumn('data_validade');
            $table->dropColumn('nome');
            $table->dropColumn('descricao');
        });
    }
}